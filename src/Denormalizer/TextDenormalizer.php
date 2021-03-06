<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Result;
use Kafkiansky\TextRu\Api\Result\Text\Text;

final class TextDenormalizer implements Denormalizer
{
    /**
     * {@inheritdoc}
     */
    public function support(string $class): bool
    {
        return Text::class === $class;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize(array $payload): ?Result
    {
        return new Text($payload);
    }
}
