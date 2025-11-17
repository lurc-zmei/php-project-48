<?php

namespace Differ\Differ;

/**
 * @throws \Exception
 */
function genDiff(string $firstFile, string $secondFile, string $format = 'stylish'): string
{
    $differ = new Differ();
    return $differ->genDiff($firstFile, $secondFile, $format);
}
