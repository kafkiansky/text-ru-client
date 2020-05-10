<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Result;
use Kafkiansky\TextRu\Api\Result\TextUid\TextUid;

final class TextUidDenormalizer implements Denormalizer
{
    /**
     * @inheritDoc
     */
    public function support(string $class): bool
    {
        return TextUid::class === $class;
    }

    /**
     * @inheritDoc
     */
    public function denormalize(array $payload): ?Result
    {
        if (isset($payload['text_uid'])) {
            return new TextUid($payload['text_uid']);
        }

        return null;
    }
}
