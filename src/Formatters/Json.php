<?php

namespace Differ\Differ\Formatters;

use JsonException;

class Json
{
    /**
     * @throws JsonException
     */
    public static function json(array $data): string
    {
        return json_encode($data, JSON_THROW_ON_ERROR);
    }
}
