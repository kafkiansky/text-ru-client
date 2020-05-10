<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Result;

interface Denormalizer
{
    /**
     * @param string $class
     *
     * @return bool
     */
    public function support(string $class): bool;

    /**
     * @param array $payload
     *
     * @return Result|null
     */
    public function denormalize(array $payload): ?Result;
}
