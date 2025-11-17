<?php

namespace Differ\Differ;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public static function parse(string $fileContent, string $fileFormat): array
    {
        return match ($fileFormat) {
            'json' => self::jsonFileParse($fileContent),
            'yml', 'yaml' => self::ymlFileParse($fileContent),
            default => throw new \Exception("Unsupported file type: {$fileFormat}")
        };
    }

    private static function jsonFileParse(string $fileContent): array
    {
        return json_decode($fileContent, true);
    }

    private static function ymlFileParse(string $fileContent): array
    {
        return YAML::parse($fileContent);
    }
}
