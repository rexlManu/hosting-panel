<?php

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return array_key_exists($key, $_ENV) ? $_ENV[$key] : $default;
    }
}
