<?php

namespace Differ\Differ\tests;

use Differ\Differ\Differ;
use Differ\Differ\GetData;
use PHPUnit\Framework\TestCase;

class DifferTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGenDiff()
    {
        $filePath = __DIR__ . "/fixtures/";
        $firstFileJson = "{$filePath}file1.json";
        $secondFileJson = "{$filePath}file2.json";
        $firstFileYml = "{$filePath}file1.yml";
        $secondFileYml = "{$filePath}file2.yml";
        $stylishExpected = "{$filePath}stylish-expected";
        $plainExpected = "{$filePath}plain-expected";
        $jsonExpected = "{$filePath}json-expected";

        $differ = new Differ();
        $data = new GetData();

        $this->assertEquals($data->getContent($stylishExpected), $differ->genDiff($firstFileJson, $secondFileJson));
        $this->assertEquals($data->getContent($stylishExpected), $differ->genDiff($firstFileYml, $secondFileYml));

        $this->assertEquals($data->getContent($plainExpected), $differ->genDiff($firstFileJson, $secondFileJson, 'plain'));
        $this->assertEquals($data->getContent($plainExpected), $differ->genDiff($firstFileYml, $secondFileYml, 'plain'));

        $this->assertEquals($data->getContent($jsonExpected), $differ->genDiff($firstFileJson, $secondFileJson, 'json'));
        $this->assertEquals($data->getContent($jsonExpected), $differ->genDiff($firstFileYml, $secondFileYml, 'json'));
    }
}
