<?php

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

if (!\function_exists('is_countable')) {

    /**
     * @param $param
     *
     * @return bool
     */
    function is_countable($param): bool
    {
        return \is_array($param) || $param instanceof \Countable;
    }
}
