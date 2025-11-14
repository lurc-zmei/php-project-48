<?php

use Hexlet\Code\Differ;
use Hexlet\Code\GetData;
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

        $differ = new Differ();
        $this->assertEquals(GetData::getContent($stylishExpected), $differ->genDiff($firstFileJson, $secondFileJson));
        $this->assertEquals(GetData::getContent($stylishExpected), $differ->genDiff($firstFileYml, $secondFileYml));

        $this->assertEquals(GetData::getContent($plainExpected), $differ->genDiff($firstFileJson, $secondFileJson, 'plain'));
        $this->assertEquals(GetData::getContent($plainExpected), $differ->genDiff($firstFileYml, $secondFileYml, 'plain'));
    }

}