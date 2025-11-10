<?php

use Hexlet\Code\Differ;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{


    public function testFileJson()
    {
        $filePath = __DIR__ . "/fixtures/";
        $firstFileJson = "{$filePath}file1.json";
        $secondFileJson = "{$filePath}file2.json";
        $firstFileYml = "{$filePath}file1.yml";
        $secondFileYml = "{$filePath}file2.yml";

        $result = <<<DOC
        {
        - follow: false
          host: hexlet.io
        - proxy: 123.234.53.22
        - timeout: 50
        + timeout: 20
        + verbose: true
        }
        DOC;

        $differ = new Differ();
        $this->assertEquals($result, $differ->genDiff($firstFileJson, $secondFileJson));
        $this->assertEquals($result, $differ->genDiff($firstFileYml, $secondFileYml));
    }

}