<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

abstract class AbstractText
{
    use Parameterizable;

    /**
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->fillFromParameters($payload);
    }
}
