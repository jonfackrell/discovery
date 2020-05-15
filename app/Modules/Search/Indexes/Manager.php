<?php

namespace App\Modules\Search\Indexes;

class Manager
{
    public static function get($name)
    {
        $index = 'App\\Modules\\Search\\Indexes\\' . $name;
        return new $index();
    }
}
