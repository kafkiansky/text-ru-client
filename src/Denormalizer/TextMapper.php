<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Denormalizer;

use Kafkiansky\TextRu\Api\Result\Text\AbstractText;
use Kafkiansky\TextRu\Api\Result\Text\ResultJson;
use Kafkiansky\TextRu\Api\Result\Text\SeoCheck;
use Kafkiansky\TextRu\Api\Result\Text\SpellCheck;

final class TextMapper
{
    /**
     * @param string $property
     * @param $value
     *
     * @return AbstractText|mixed
     */
    public function map(string $property, $value)
    {
        if ('result_json' === $property) {
            return new ResultJson($value);
        }

        if ('seo_check' === $property) {
            return new SeoCheck($value);
        }

        if ('spell_check' === $property) {
            return new SpellCheck($value);
        }

        return $value;
    }
}
