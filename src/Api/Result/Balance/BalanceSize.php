<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Balance;

use Kafkiansky\TextRu\Api\Result\Result;

final class BalanceSize implements Result
{
    /**
     * @var int
     */
    private $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function size(): int
    {
        return $this->size;
    }
}
