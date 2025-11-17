<?php

namespace Differ\Differ;

use Differ\Differ\Formatters\Json;
use Differ\Differ\Formatters\Plain;
use Differ\Differ\Formatters\Stylish;

class Formatter
{
    public static function format(array $data, string $format): string
    {
        return match ($format) {
            'plain' => Plain::plain($data),
            'json' => Json::json($data),
            default => Stylish::stylish($data),
        };
    }
}
