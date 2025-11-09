<?php

use Hexlet\Code\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function testGenDiff()
    {
        $filePath = __DIR__ . "/fixtures/";
        $firstFile = "{$filePath}file1.json";
        $secondFile = "{$filePath}file2.json";

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

        $this->assertEquals($result, Parser::genDiff($firstFile, $secondFile));
    }


}