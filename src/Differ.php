<?php

namespace Hexlet\Code;

use Exception;

use function Funct\Collection\sortBy;

class Differ
{
    /**
     * @throws Exception
     */
    public function genDiff($firstFile, $secondFile, string $format = 'stylish'): string
    {
        $data1 = Parser::parse(GetData::getExtension($firstFile), GetData::getContent($firstFile));
        $data2 = Parser::parse(GetData::getExtension($secondFile), GetData::getContent($secondFile));

        $diff = $this->buildDiff($data1, $data2);

        return Formatter::format($diff, $format);
    }

    private function buildDiff($data1, $data2): array
    {
        $allKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));

        $sortedKeys = sortBy($allKeys, function ($key) {
            return $key;
        });

        $result = [];

        foreach ($sortedKeys as $key) {
            if (!array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
                    $result[$key] = ['type' => 'added', 'value' => $data2[$key]];
            }

            if (array_key_exists($key, $data1) && !array_key_exists($key, $data2)) {
                $result[$key] = ['type' => 'removed', 'value' => $data1[$key]]; //
            }


            if (array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
                if (is_array($data1[$key]) && is_array($data2[$key])) {
                    $result[$key] = ['type' => 'nested', 'children' => $this->buildDiff($data1[$key], $data2[$key])];
                } elseif (($data1[$key] === $data2[$key])) {
                    $result[$key] = ['type' => 'unchanged', 'value' => $data1[$key]]; //
                } else {
                    $result[$key] = ['type' => 'changed', 'oldValue' => $data1[$key], 'newValue' => $data2[$key]]; //
                }
            }
        }
        return $result;
    }
}
