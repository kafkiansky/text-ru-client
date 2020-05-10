<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Balance\BalanceSize;
use Kafkiansky\TextRu\Api\Result\Result;

final class BalanceDenormalizer implements Denormalizer
{
    /**
     * @inheritDoc
     */
    public function support(string $class): bool
    {
        return BalanceSize::class === $class;
    }

    /**
     * @inheritDoc
     */
    public function denormalize(array $payload): ?Result
    {
        if (isset($payload['size'])) {
            return new BalanceSize($payload['size']);
        }

        return null;
    }
}
