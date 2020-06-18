<?php

if( ! function_exists('user') ) {
    function user() {
        return auth()->user();
    }
}

if( ! function_exists('setting') ) {
    function setting($name) {
        if(auth()->check()){
            return user()->options->get($name, env(Str::upper($name)));
        }else{
            return env(Str::upper($name));
        }
    }
}
