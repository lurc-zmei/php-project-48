<?php

namespace Differ\Differ;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public static function parse($fileContent, string $fileFormat)
    {
        return match ($fileFormat) {
            'json' => self::jsonFileParse($fileContent),
            'yml', 'yaml' => self::ymlFileParse($fileContent)
        };
    }

    private static function jsonFileParse(string $fileContent)
    {
        return json_decode($fileContent, true);
    }

    private static function ymlFileParse(string $fileContent)
    {
        return YAML::parse($fileContent);
    }
}
