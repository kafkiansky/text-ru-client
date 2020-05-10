<?php

declare(strict_types=1);

namespace Kafkiansky\TextRu\Api\Result\Text;

use Kafkiansky\TextRu\Denormalizer\TextMapper;

trait Parameterizable
{
    /**
     * @param array $parameters
     */
    private function fillFromParameters(array $parameters = []): void
    {
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
