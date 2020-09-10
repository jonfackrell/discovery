<?php

if (! function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (! function_exists('setting')) {
    function setting($name)
    {
        if (auth()->check()) {
            return user()->options->get($name, env(Str::upper($name)));
        } else {
            return env(Str::upper($name));
        }
    }
}

if (! function_exists('emptyArray')) {
    function emptyArray($array)
    {
        return empty(array_filter($array, function ($a) { return $a !== null;}));
    }
}
