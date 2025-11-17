<?php

namespace Differ\Differ\Formatters;

class Json
{
    public static function json(array $data): string|false
    {
        return json_encode($data);
    }
}
