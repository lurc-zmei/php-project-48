<?php

namespace Hexlet\Code;

use function Funct\Collection\sortBy;

class Differ
{
    public function genDiff($firstFile, $secondFile): string
    {
        $data1 = Parser::parse(GetData::getExtension($firstFile), GetData::getContent($firstFile));
        $data2 = Parser::parse(GetData::getExtension($secondFile), GetData::getContent($secondFile));

        $allKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));

        $sortedKeys = sortBy($allKeys, function ($key) {
            return $key;
        });


        $result = [];

        foreach ($sortedKeys as $key) {
            if (isset($data1[$key]) && isset($data2[$key])) {
                if ($data1[$key] === $data2[$key]) {
                    $result[] = "  $key: {$this->formatValue($data1[$key])}";
                } else {
                    $result[] = "- $key: {$this->formatValue($data1[$key])}";
                    $result[] = "+ $key: {$this->formatValue($data2[$key])}";
                }
            }
            if (isset($data1[$key]) && !isset($data2[$key])) {
                $result[] = "- $key: {$this->formatValue($data1[$key])}";
            }
            if (!isset($data1[$key]) && isset($data2[$key])) {
                $result[] = "+ $key: {$this->formatValue($data2[$key])}";
            }
        }

        return "{\n" . implode("\n", $result) . "\n}";
    }


    public function formatValue($value): string
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
