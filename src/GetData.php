<?php

namespace Differ\Differ;

use Exception;

class GetData
{
    /**
     * @throws Exception
     */
    public static function getContent($filePath): array|false|string
    {
        if (file_exists($filePath)) {
            $absolutePath = realpath($filePath);
            $content = file_get_contents($absolutePath);
            if ($content === false) {
                throw new Exception("Cannot read file: {$filePath}");
            }
            return $content;
        } else {
            throw new Exception("File not found: {$filePath}");
        }
    }

    public static function getExtension(string $filePath): string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }
}
