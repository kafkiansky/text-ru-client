<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api;

interface Method
{
    /**
     * @return string
     */
    public function method(): string;

    /**
     * @return array
     */
    public function payload(): array;

    /**
     * @return string
     */
    public function mappedClass(): string;
}
