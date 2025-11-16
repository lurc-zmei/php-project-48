<?php

namespace Differ\Differ\Formatters;

class Stylish
{
    public static function stylish($data, $depth = 1): string
    {
        $iter = function ($currValue, $currDepth) use (&$iter) {
            $spacesCount = 4;
            $currentIndent = str_repeat(' ', $currDepth * $spacesCount - 2);
            $bracketIndent = str_repeat(' ', ($currDepth - 1) * $spacesCount);

            $lines = [];

            foreach ($currValue as $key => $node) {
                if (!is_array($node) || !isset($node['type'])) {
                    // Если это обычный массив (не узел diff), обрабатываем рекурсивно
                    $value = is_array($node) ? $iter($node, $currDepth + 1) : self::toString($node);
                    $lines[] = "{$currentIndent}  {$key}: {$value}";
                    continue;
                }

                $type = $node['type'];

                switch ($type) {
                    case 'added':
                        $value = self::formatValue($node['value'], $iter, $currDepth + 1);
                        $lines[] = "{$currentIndent}+ {$key}: {$value}";
                        break;

                    case 'removed':
                        $value = self::formatValue($node['value'], $iter, $currDepth + 1);
                        $lines[] = "{$currentIndent}- {$key}: {$value}";
                        break;

                    case 'unchanged':
                        $value = self::formatValue($node['value'], $iter, $currDepth + 1);
                        $lines[] = "{$currentIndent}  {$key}: {$value}";
                        break;

                    case 'changed':
                        $oldValue = self::formatValue($node['oldValue'], $iter, $currDepth + 1);
                        $newValue = self::formatValue($node['newValue'], $iter, $currDepth + 1);
                        $lines[] = "{$currentIndent}- {$key}: {$oldValue}";
                        $lines[] = "{$currentIndent}+ {$key}: {$newValue}";
                        break;

                    case 'nested':
                        $children = $iter($node['children'], $currDepth + 1);
                        $lines[] = "{$currentIndent}  {$key}: {$children}";
                        break;
                }
            }

            $result = ['{', ...$lines, "{$bracketIndent}}"];
            return implode("\n", $result);
        };

        return $iter($data, $depth);
    }

    private static function formatValue($value, callable $iter, int $depth): string
    {
        if (is_array($value) && !isset($value['type'])) {
            // Это обычный массив (не узел diff), форматируем рекурсивно
            return $iter($value, $depth);
        }
        return self::toString($value);
    }

    private static function toString($value): string
    {
        return match (true) {
            is_bool($value) => $value ? 'true' : 'false',
            is_null($value) => 'null',
            is_string($value) => "{$value}",
            default => (string)$value,
        };
    }
}
