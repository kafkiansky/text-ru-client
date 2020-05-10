<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Result;

final class ChainDenormalizer
{
    /**
     * @var array
     */
    private $denormalizers;

    public function __construct()
    {
        $this->denormalizers = [
            new TextDenormalizer(),
            new TextUidDenormalizer(),
            new BalanceDenormalizer(),
        ];
    }

    /**
     * @param array  $payload
     * @param string $class
     *
     * @return Result|null
     */
    public function denormalize(array $payload, string $class): ?Result
    {
        /** @var Denormalizer $denormalizer */
        foreach ($this->denormalizers as $denormalizer) {
            if ($denormalizer->support($class)) {
                return $denormalizer->denormalize($payload);
            }
        }

        return null;
    }
}
