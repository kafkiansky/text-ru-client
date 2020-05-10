<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Method;

use Kafkiansky\TextRu\Api\Method;
use Kafkiansky\TextRu\Api\Result\Balance\BalanceSize;

final class Balance implements Method
{
    /**
     * {@inheritDoc}
     */
    public function method(): string
    {
        return 'account';
    }

    /**
     * {@inheritDoc}
     */
    public function mappedClass(): string
    {
        return BalanceSize::class;
    }

    /**
     * {@inheritDoc}
     */
    public function payload(): array
    {
        return [
            'method' => 'get_packages_info'
        ];
    }
}
