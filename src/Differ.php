<?php

namespace Differ\Differ;

use Exception;

use function Funct\Collection\sortBy;

class Differ
{
    /**
     * @throws Exception
     */

    public function genDiff(string $firstFile, string $secondFile, string $format = 'stylish'): string
    {
        $fileData1 = new GetData($firstFile);
        $fileData2 = new GetData($secondFile);

        $data1 = Parser::parse($fileData1->content, $fileData1->extension);
        $data2 = Parser::parse($fileData2->content, $fileData2->extension);

        $diff = $this->buildDiff($data1, $data2);

        return Formatter::format($diff, $format);
    }

    private function buildDiff(array $data1, array $data2): array
    {
        $allKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));

        $sortedKeys = sortBy($allKeys, fn($key) => $key);

        $result = [];

        foreach ($sortedKeys as $key) {
            $value1 = $data1[$key] ?? null;
            $value2 = $data2[$key] ?? null;

            if (!array_key_exists($key, $data1)) {
                $result[$key] = [
                    'type' => 'added',
                    'value' => $value2
                ];
            } elseif (!array_key_exists($key, $data2)) {
                $result[$key] = [
                    'type' => 'removed',
                    'value' => $value1
                ];
            } elseif (is_array($value1) && is_array($value2)) {
                $result[$key] = [
                    'type' => 'nested',
                    'children' => $this->buildDiff($value1, $value2)
                ];
            } elseif ($value1 === $value2) {
                $result[$key] = [
                    'type' => 'unchanged',
                    'value' => $value1
                ];
            } else {
                $result[$key] = [
                    'type' => 'changed',
                    'oldValue' => $value1,
                    'newValue' => $value2
                ];
            }
        }
        return $result;
    }
}
