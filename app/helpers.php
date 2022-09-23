<?php

use Illuminate\Support\Str;

if (!function_exists('convertToTitle')) {
    function convertToTitle(string $title): string
    {
        return str_replace('_', ' ', Str::title($title));
    }
}
