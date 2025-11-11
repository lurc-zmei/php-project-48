<?php

namespace Hexlet\Code;

class Formatter
{
    public static function formatDiff($diff, $depth = 1)
    {
        $replacer = ' ';
        $spacesCount = 4;
        $currentIndent = str_repeat($replacer, $depth * $spacesCount - 2);
        $bracketIndent = str_repeat($replacer, ($depth - 1) * $spacesCount);

        $lines = array_map(function ($key, $node) use ($depth, $replacer, $spacesCount, $currentIndent) {
            $type = $node['type'];

            switch ($type) {
                case 'added':
                    $formattedValue = self::formatValue($node['value'], $depth + 1, $replacer, $spacesCount);
                    return "{$currentIndent}+ {$key}: {$formattedValue}";

                case 'removed':
                    $formattedValue = self::formatValue($node['value'], $depth + 1, $replacer, $spacesCount);
                    return "{$currentIndent}- {$key}: {$formattedValue}";

                case 'unchanged':
                    $formattedValue = self::formatValue($node['value'], $depth + 1, $replacer, $spacesCount);
                    return "{$currentIndent}  {$key}: {$formattedValue}";

                case 'changed':
                    $oldFormatted = self::formatValue($node['oldValue'], $depth + 1, $replacer, $spacesCount);
                    $newFormatted = self::formatValue($node['newValue'], $depth + 1, $replacer, $spacesCount);
                    return "{$currentIndent}- {$key}: {$oldFormatted}\n{$currentIndent}+ {$key}: {$newFormatted}";

                case 'nested':
                    $children = self::formatDiff($node['children'], $depth + 1);
                    return "{$currentIndent}  {$key}: {$children}";

                default:
                    return '';
            }
        }, array_keys($diff), $diff);

        $result = ['{', ...$lines, "{$bracketIndent}}"];
        return implode("\n", $result);
    }

    private static function formatValue($value, $depth, $replacer, $spacesCount)
    {
        $iter = function ($currentValue, $currentDepth) use (&$iter, $replacer, $spacesCount) {
            if (!is_array($currentValue)) {
                return self::toString($currentValue);
            }

            $indentSize = $currentDepth * $spacesCount;
            $currentIndent = str_repeat($replacer, $indentSize);
            $bracketIndent = str_repeat($replacer, $indentSize - $spacesCount);

            $lines = array_map(
                fn($key, $val) => "{$currentIndent}{$key}: {$iter($val, $currentDepth + 1)}",
                array_keys($currentValue),
                $currentValue
            );

            $result = ['{', ...$lines, "{$bracketIndent}}"];
            return implode("\n", $result);
        };

        return $iter($value, $depth);
    }

    private static function toString($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_null($value)) {
            return 'null';
        }
        return (string)$value;
    }
}
