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
            common: {
              + follow: false
                setting1: Value 1
              - setting2: 200
              - setting3: true
              + setting3: null
              + setting4: blah blah
              + setting5: {
                    key5: value5
                }
                setting6: {
                    doge: {
                      - wow: 
                      + wow: so much
                    }
                    key: value
                  + ops: vops
                }
            }
            group1: {
              - baz: bas
              + baz: bars
                foo: bar
              - nest: {
                    key: value
                }
              + nest: str
            }
          - group2: {
                abc: 12345
                deep: {
                    id: 45
                }
            }
          + group3: {
                deep: {
                    id: {
                        number: 45
                    }
                }
                fee: 100500
            }
        }
        DOC;

        $differ = new Differ();
        $this->assertEquals($result, $differ->genDiff($firstFileJson, $secondFileJson));
        $this->assertEquals($result, $differ->genDiff($firstFileYml, $secondFileYml));
    }

}