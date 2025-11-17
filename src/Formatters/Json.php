<?php

namespace Differ\Differ\Formatters;

class Json
{
    public static function json($data): string
    {
        return json_encode($data);
    }
}
