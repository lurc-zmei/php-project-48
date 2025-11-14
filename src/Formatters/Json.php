<?php

namespace Hexlet\Code\Formatters;

class Json
{
    public static function json($data)
    {
        return json_encode($data);
    }
}
