<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Tests;

use Kafkiansky\TextRu\TextRuCredentials;
use PHPUnit\Framework\TestCase;

final class TextRuCredentialsTest extends TestCase
{
    public function testEmptyUserKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('UserKey cannot be empty');

        new TextRuCredentials('');
    }

    public function testInvalidUserKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf('UserKey must match regex: %s', '/[A-Za-z0-9]+/'));

        new TextRuCredentials('..');
    }

    public function testCorrectUserKey()
    {
        $credentials = new TextRuCredentials($key = '5f1xxxx28xx64dxx6cfxx73ex0');
        $this->assertEquals($key, $credentials->userKey());
    }
}
