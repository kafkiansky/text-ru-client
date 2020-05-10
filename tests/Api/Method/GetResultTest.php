<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Tests\Api\Method;

use Kafkiansky\TextRu\Api\Method\GetResult;
use PHPUnit\Framework\TestCase;

final class GetResultTest extends TestCase
{
    public function testEmptyGetResult()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Text uid cannot be empty');

        new GetResult('');
    }

    public function testCorrectGetResult()
    {
        $result = new GetResult('5eb666b9d8d2f');

        $this->assertArrayHasKey('uid', $result->payload());
        $this->assertArrayNotHasKey('jsonvisible', $result->payload());

        $result->detail();

        $this->assertArrayHasKey('uid', $result->payload());
        $this->assertArrayHasKey('jsonvisible', $result->payload());
    }
}
