<?php

namespace Hexlet\Code;

class GetData
{
    public static function getContent($filePath): array|false|string
    {
        if (file_exists($filePath)) {
            $absolutePath = realpath($filePath);
            $content = file_get_contents($absolutePath);
        } else {
            $content = ['File not found'];
        }
        return $content;
    }

    public static function getExtension(string $filePath): string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }
}
