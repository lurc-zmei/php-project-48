<?php

namespace Hexlet\Code;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public static function parse(string $fileFormat, $fileContent)
    {
        return match ($fileFormat) {
            'json' => self::jsonFileParse($fileContent),
            'yml', 'yaml' => self::ymlFileParse($fileContent)
        };
    }

    public static function jsonFileParse(string $fileContent)
    {
        return json_decode($fileContent, true);
    }

    public static function ymlFileParse(string $fileContent)
    {
        return YAML::parse($fileContent);
    }
}
