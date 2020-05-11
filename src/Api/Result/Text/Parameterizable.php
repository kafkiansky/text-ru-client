<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

use function GuzzleHttp\json_decode;
use Kafkiansky\TextRu\Denormalizer\TextMapper;
use function Kafkiansky\TextRu\isCountable;
use function Kafkiansky\TextRu\isJson;

trait Parameterizable
{
    /**
     * @param array|string $parameters
     */
    private function fillFromParameters($parameters): void
    {
        if (\is_string($parameters) && isJson($parameters)) {
            $parameters = json_decode($parameters, true);
        }

        if (!isCountable($parameters)) {
            return;
        }

        foreach ($parameters as $property => $value) {
            if (\property_exists($this, $camel = $this->toCamel($property))) {
                $this->$camel = $this->mapper()->map($property, $value);
            }
        }
    }

    /**
     * @param string $property
     *
     * @return string
     */
    private function toCamel(string $property): string
    {
        $camelCased = \preg_replace_callback(
            '/_(.?)/',
            static function (array $matches): string {
                return \ucfirst((string) $matches[1]);
            },
            $property
        );

        return \lcfirst($camelCased);
    }

    /**
     * @return TextMapper
     */
    private function mapper(): TextMapper
    {
        return new TextMapper();
    }
}
