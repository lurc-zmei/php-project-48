<?php

namespace Differ\Differ\tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePath = __DIR__ . "/fixtures/";

    public function testGenDiffPlain(): void
    {
        $firstFileJson = "{$this->filePath}file1.json";
        $secondFileJson = "{$this->filePath}file2.json";
        $firstFileYml = "{$this->filePath}file1.yml";
        $secondFileYml = "{$this->filePath}file2.yml";
        $plain = "{$this->filePath}plain-expected";

        $expected = file_get_contents($plain);

        $this->assertEquals($expected, genDiff($firstFileJson, $secondFileJson, 'plain'));
        $this->assertEquals($expected, genDiff($firstFileYml, $secondFileYml, 'plain'));
    }

    public function testGenDiffJson(): void
    {
        $firstFileJson = "{$this->filePath}file1.json";
        $secondFileJson = "{$this->filePath}file2.json";
        $firstFileYml = "{$this->filePath}file1.yml";
        $secondFileYml = "{$this->filePath}file2.yml";
        $plain = "{$this->filePath}json-expected";

        $expected = file_get_contents($plain);

        $this->assertEquals($expected, genDiff($firstFileJson, $secondFileJson, 'json'));
        $this->assertEquals($expected, genDiff($firstFileYml, $secondFileYml, 'json'));
    }

    public function testGenDiffStylish(): void
    {
        $firstFileJson = "{$this->filePath}file1.json";
        $secondFileJson = "{$this->filePath}file2.json";
        $firstFileYml = "{$this->filePath}file1.yml";
        $secondFileYml = "{$this->filePath}file2.yml";
        $plain = "{$this->filePath}stylish-expected";

        $expected = file_get_contents($plain);

        $this->assertEquals($expected, genDiff($firstFileJson, $secondFileJson, 'stylish'));
        $this->assertEquals($expected, genDiff($firstFileYml, $secondFileYml, 'stylish'));
    }

    public function testGenDiffDefault(): void
    {
        $firstFileJson = "{$this->filePath}file1.json";
        $secondFileJson = "{$this->filePath}file2.json";
        $firstFileYml = "{$this->filePath}file1.yml";
        $secondFileYml = "{$this->filePath}file2.yml";
        $plain = "{$this->filePath}stylish-expected";

        $expected = file_get_contents($plain);

        $this->assertEquals($expected, genDiff($firstFileJson, $secondFileJson));
        $this->assertEquals($expected, genDiff($firstFileYml, $secondFileYml));
    }
    /**
    #[DataProvider('genDiffProvider')]
    public function testGenDiff(string $expectedFile, string $firstFile, string $secondFile, string $format = 'stylish'): void
    {
        $filePath = __DIR__ . "/fixtures/";

        $firstFilePath = "{$filePath}{$firstFile}";
        $secondFilePath = "{$filePath}{$secondFile}";
        $expectedFilePath = "{$filePath}{$expectedFile}";

        $expected = file_get_contents($expectedFilePath);
        $actual = genDiff($firstFilePath, $secondFilePath, $format);

        $this->assertEquals($expected, $actual);
    }

    public static function genDiffProvider(): array
    {
        return [
            ['plain-expected', 'file1.json', 'file2.json', 'plain'],
            ['plain-expected', 'file1.yml', 'file2.yml', 'plain'],

            ['json-expected', 'file1.json', 'file2.json', 'json'],
            ['json-expected', 'file1.yml', 'file2.yml', 'json'],

            ['stylish-expected', 'file1.json', 'file2.json', 'stylish'],
            ['stylish-expected', 'file1.yml', 'file2.yml', 'stylish'],

            ['stylish-expected', 'file1.json', 'file2.json'],
            ['stylish-expected', 'file1.yml', 'file2.yml'],
        ];
    }
     * */
}
