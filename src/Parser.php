<?php

namespace Differ\Differ;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public function parse(string $fileContent, string $fileFormat): array
    {
        return match ($fileFormat) {
            'json' => json_decode($fileContent, true),
            'yml', 'yaml' => YAML::parse($fileContent),
            default => throw new \Exception("Unsupported file type: {$fileFormat}")
        };
    }
}
