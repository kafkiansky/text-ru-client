<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

abstract class AbstractText
{
    use Parameterizable;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->fillFromParameters($payload);
    }
}
