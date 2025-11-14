<?php

namespace Hexlet\Code;

use Hexlet\Code\Formatters\Json;
use Hexlet\Code\Formatters\Plain;
use Hexlet\Code\Formatters\Stylish;

class Formatter
{
    public static function format($data, $format): string
    {
        return match ($format) {
            'plain' => Plain::plain($data),
            'json' => Json::json($data),
            default => Stylish::stylish($data),
        };
    }
}
