<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Tests\Api\Method;

use Kafkiansky\TextRu\Api\Method\Message;
use PHPUnit\Framework\TestCase;

final class MessageTest extends TestCase
{
    public function testEmptyMessage()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Message text cannot be empty');

        new Message('');
    }

    public function testMinimumInvalidLengthMessage()
    {
        $len = 97;

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf('Text length must be between 100 and 150000 chars, now is %d', $len));
        new Message('All work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy');
    }

    public function testMaximumInvalidLengthMessage()
    {
        $message = '';

        for ($i = 0; $i < 150001; $i++) {
            $message .= \array_rand(\range('A', 'Z'));
        }

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf('Text length must be between 100 and 150000 chars, now is %d', \mb_strlen($message)));
        new Message($message);
    }

    public function testMessage()
    {
        $message = new Message('All work and no play makes Kafkiansky a dull boy All work and no play makes Kafkiansky a dull boy All work');
        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayNotHasKey('exceptdomain', $message->payload());
        $this->assertArrayNotHasKey('excepturl', $message->payload());
        $this->assertArrayNotHasKey('visible', $message->payload());
        $this->assertArrayNotHasKey('copying', $message->payload());
        $this->assertArrayNotHasKey('callback', $message->payload());

        $message
            ->withExceptDomain(['https://domain.org']);

        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayHasKey('exceptdomain', $message->payload());
        $this->assertIsString($message->payload()['exceptdomain']);

        $message
            ->withExceptUrl(['https://org.domain.com']);

        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayHasKey('exceptdomain', $message->payload());
        $this->assertArrayHasKey('excepturl', $message->payload());
        $this->assertIsString($message->payload()['excepturl']);

        $message
            ->withCallback('https://callback.org');

        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayHasKey('exceptdomain', $message->payload());
        $this->assertArrayHasKey('excepturl', $message->payload());
        $this->assertArrayHasKey('callback', $message->payload());

        $message->visible();

        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayHasKey('exceptdomain', $message->payload());
        $this->assertArrayHasKey('excepturl', $message->payload());
        $this->assertArrayHasKey('callback', $message->payload());
        $this->assertArrayHasKey('visible', $message->payload());
        $this->assertEquals('vis_on', $message->payload()['visible']);


        $message->copying();

        $this->assertArrayHasKey('text', $message->payload());
        $this->assertArrayHasKey('exceptdomain', $message->payload());
        $this->assertArrayHasKey('excepturl', $message->payload());
        $this->assertArrayHasKey('callback', $message->payload());
        $this->assertArrayHasKey('visible', $message->payload());
        $this->assertArrayHasKey('copying', $message->payload());
        $this->assertEquals('noadd', $message->payload()['copying']);
    }
}
