<?php

namespace Differ\Differ\Formatters;

class Plain
{
    public static function plain(array $diff, string $path = ''): string
    {
        $lines = [];

        foreach ($diff as $key => $node) {
            $currentPath = $path === '' ? $key : "{$path}.{$key}";

            switch ($node['type']) {
                case 'added':
                    $value = self::toString($node['value']);
                    $lines[] = "Property '{$currentPath}' was added with value: {$value}";
                    break;

                case 'removed':
                    $lines[] = "Property '{$currentPath}' was removed";
                    break;

                case 'changed':
                    $oldValue = self::toString($node['oldValue']);
                    $newValue = self::toString($node['newValue']);
                    $lines[] = "Property '{$currentPath}' was updated. From {$oldValue} to {$newValue}";
                    break;

                case 'nested':
                    $nestedLines = self::plain($node['children'], $currentPath);
                    if ($nestedLines !== '') {
                        $lines[] = $nestedLines;
                    }
                    break;

                case 'unchanged': // пропускаем неизмененные
                    break;
            }
        }

        return implode("\n", $lines);
    }

    private static function toString(mixed $value): string
    {
        return match (true) {
            is_array($value) => '[complex value]',
            is_bool($value) => $value ? 'true' : 'false',
            is_null($value) => 'null',
            is_string($value) => "'{$value}'",
            default => (string)$value,
        };
    }
}
