<?php

namespace Differ\Differ;

use Exception;

/**
 * @throws Exception
 */
function genDiff(string $firstFile, string $secondFile, string $format = 'stylish'): string|false
{
    $differ = new Differ();
    return $differ->genDiff($firstFile, $secondFile, $format);
}
