<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Kafkiansky\TextRu\Api\Method\Balance;
use Kafkiansky\TextRu\Api\Method\GetResult;
use Kafkiansky\TextRu\Api\Method\Message;
use Kafkiansky\TextRu\Api\Result\Balance\BalanceSize;
use Kafkiansky\TextRu\Api\Result\Text\SpellCheck;
use Kafkiansky\TextRu\Api\Result\Text\Text;
use Kafkiansky\TextRu\Api\Result\TextUid\TextUid;
use Kafkiansky\TextRu\Exception\TextRuApiErrorException;
use Kafkiansky\TextRu\Exception\TextRuErrorResponseException;
use Kafkiansky\TextRu\TextRuClient;
use Kafkiansky\TextRu\TextRuCredentials;
use PHPUnit\Framework\TestCase;

final class TextRuClientTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $mockHandler;

    /**
     * @var TextRuClient
     */
    private $textRuClient;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();

        $this->textRuClient = new TextRuClient(
            new TextRuCredentials('xxxxxxxxxxxx'),
            new Client([
                'handler' => $this->mockHandler,
            ])
        );
    }

    public function testBadResponse()
    {
        $this->mockHandler->append(new Response(500, []));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf('Server respond with bad response code: %s', 500));
        $this->textRuClient->call(new Message('All work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy All work'));
    }

    public function testTextRuErrorResponse()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/error_response.json')));

        $this->expectException(TextRuErrorResponseException::class);
        $this->expectExceptionMessage('Текущая пара ключ-uid отсутствует в базе');
        $this->expectExceptionCode(180);
        $this->textRuClient->call(new GetResult('xxxxxx'));
    }

    public function testTextRuApiException()
    {
        $this->mockHandler->append(new RequestException('Too many requests', new Request('POST', 'http://api.text.ru/post')));

        $this->expectException(TextRuApiErrorException::class);
        $this->expectExceptionMessage('Too many requests');
        $this->textRuClient->call(new GetResult('xxxxxx'));
    }

    public function testEmptyResponse()
    {
        $this->mockHandler->append(new Response(200, [], null));

        $null = $this->textRuClient->call(new Balance());

        $this->assertEquals(null, $null);
    }

    public function testTextUidMethod()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/text_uid_method.json')));

        /** @var TextUid $textUid */
        $textUid = $this->textRuClient->call(new Message('All work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy All work'));

        $this->assertInstanceOf(TextUid::class, $textUid);
        $this->assertEquals('5eb7ba9a46181', $textUid->textUid());
    }

    public function testBalanceMethod()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/balance_method.json')));

        /** @var BalanceSize $balance */
        $balance = $this->textRuClient->call(new Balance());

        $this->assertInstanceOf(BalanceSize::class, $balance);
        $this->assertEquals(12000, $balance->size());
    }

    public function testGetResultMethod()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/get_result_method.json')));

        /** @var Text $result */
        $result = $this->textRuClient->call(new GetResult('5eb7ba9a46181'));

        $this->assertInstanceOf(Text::class, $result);
        $this->assertEquals(2.57, $result->textUnique());

        $resultJson = $result->resultJson();

        $this->assertEquals('10.05.2020 11:28:34', $resultJson->dateCheck());
        $this->assertEquals(2.57, $resultJson->unique());
        $this->assertEquals('Al work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy All work', $resultJson->clearText());
        $this->assertIsArray($resultJson->urls());

        $seoCheck = $result->seoCheck();

        $this->assertEquals(106, $seoCheck->countCharsWithSpace());
        $this->assertEquals(85, $seoCheck->countCharsWithoutSpace());
        $this->assertEquals(22, $seoCheck->countWords());
        $this->assertEquals(60, $seoCheck->waterPercent());
        $this->assertEquals(25, $seoCheck->spamPercent());
        $this->assertIsArray($seoCheck->listKeys());
        $this->assertIsArray($seoCheck->listKeysGroup());
        $this->assertIsArray($seoCheck->mixedWords());

        $spellCheck = $result->spellCheck();

        $this->assertTrue(2 === $spellCheck->count());
        $this->assertCount(2, $spellCheck->getSpells());
        $this->assertIsArray($spellCheck->getSpells());

        $firstSpell = $spellCheck->first();

        $this->assertInstanceOf(SpellCheck::class, $firstSpell);
        $this->assertEquals('Проверка орфографии', $firstSpell->errorType());
        $this->assertEquals('Al', $firstSpell->errorText());
        $this->assertEquals('Найдена орфографическая ошибка', $firstSpell->reason());
        $this->assertEquals(0, $firstSpell->start());
        $this->assertEquals(3, $firstSpell->end());
        $this->assertIsArray($firstSpell->replacements());
    }

    public function testGetResultMethodWithoutSpell()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__.'/fixtures/get_result_without_spell.json')));

        /** @var Text $result */
        $result = $this->textRuClient->call(new GetResult('5eb7ba9a46181'));

        $this->assertEmpty($result->spellCheck()->getSpells());
        $this->assertNull($result->spellCheck()->first());
        $this->assertEquals(0, $result->spellCheck()->count());
    }
}
