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
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/fixtures/error_response.json')));

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
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/fixtures/text_uid_method.json')));

        /** @var TextUid $textUid */
        $textUid = $this->textRuClient->call(new Message('All work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy All work'));

        $this->assertInstanceOf(TextUid::class, $textUid);
        $this->assertEquals('5eb7ba9a46181', $textUid->textUid());
    }

    public function testBalanceMethod()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/fixtures/balance_method.json')));

        /** @var BalanceSize $balance */
        $balance = $this->textRuClient->call(new Balance());

        $this->assertInstanceOf(BalanceSize::class, $balance);
        $this->assertEquals(12000, $balance->size());
    }
}
