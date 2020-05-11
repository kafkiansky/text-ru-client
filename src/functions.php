<?php

namespace Kafkiansky\TextRu;

if (!\function_exists('isJson')) {

    /**
     * @param string $json
     *
     * @return bool
     */
    function isJson(string $json): bool
    {
        $decoded = json_decode($json, true);

        if (!\is_array($decoded)) {
            return false;
        }

        return \JSON_ERROR_NONE === \json_last_error();
    }
}
