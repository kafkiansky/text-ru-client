<?php

namespace Kafkiansky\TextRu;

use Countable;

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

if (!\function_exists('isCountable')) {

    /**
     * @param $param
     *
     * @return bool
     */
    function isCountable($param): bool
    {
        return \is_array($param) || $param instanceof Countable;
    }
}
