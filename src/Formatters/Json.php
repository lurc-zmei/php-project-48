<?php

namespace Differ\Differ\Formatters;

class Json
{
    public static function json($data)
    {
        return json_encode($data);
    }
}
