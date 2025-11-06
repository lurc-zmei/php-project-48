<?php

namespace Hexlet\Code;

use function Funct\Collection\sortBy;

class Parser
{
//    private $filePath;
//
//    public function __construct($filePath)
//    {
//        $this->filePath = $filePath;
//    }
    public function parse($filePath) : array
    {
        if (file_exists($filePath)) {
            $absolutePath = realpath($filePath);
            $content = file_get_contents($absolutePath);
            $data = json_decode($content, true);
        } else {
            $data = 'File not found';
        }
        return $data;
    }

    public static function genDiff($filePath1, $filePath2) : string
    {
        $parser = new Parser;
        $data1 = $parser->parse($filePath1);
        $data2 = $parser->parse($filePath2);
        $allKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));

        $sortedKeys = sortBy($allKeys, function ($key) {
            return $key;
        });

        $result = [];

        foreach ($sortedKeys as $key) {
            if (isset($data1[$key]) && isset($data2[$key])) {
                if ($data1[$key] === $data2[$key]) {
                    $result[] = "  $key: {$parser->formatValue($data1[$key])}";
                } else {
                    $result[] = "- $key: {$parser->formatValue($data1[$key])}";
                    $result[] = "+ $key: {$parser->formatValue($data2[$key])}";
                }
            }
            if (isset($data1[$key]) && !isset($data2[$key])) {
                $result[] = "- $key: {$parser->formatValue($data1[$key])}";
            }
            if (!isset($data1[$key]) && isset($data2[$key])) {
                $result[] = "+ $key: {$parser->formatValue($data2[$key])}";
            }
        }
        return "{\n" . implode("\n", $result) . "\n}";
    }

    function formatValue($value)
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        return $value;
    }

}
