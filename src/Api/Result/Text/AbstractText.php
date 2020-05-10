<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;
use function GuzzleHttp\json_decode;

abstract class AbstractText
{
    use Parameterizable;

    /**
     * @param $payload
     */
    public function __construct($payload)
    {
        if (\is_string($payload)) {
            $payload = json_decode($payload, true);
        }

        $this->fillFromParameters($payload);
    }
}
