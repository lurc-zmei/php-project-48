<?php

namespace Differ\Differ\tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePath = __DIR__ . "/fixtures/";

    #[DataProvider('formatProvider')]
    public function testGenDiffPlain(string $format): void
    {
        $firstFile = "{$this->filePath}file1.{$format}";
        $secondFile = "{$this->filePath}file2.{$format}";
        $plain = "{$this->filePath}plain-expected";
        $expected = file_get_contents($plain);

        $this->assertEquals($expected, genDiff($firstFile, $secondFile, 'plain'));
    }

    #[DataProvider('formatProvider')]
    public function testGenDiffJson(string $format): void
    {
        $firstFile = "{$this->filePath}file1.{$format}";
        $secondFile = "{$this->filePath}file2.{$format}";
        $json = "{$this->filePath}json-expected";
        $expected = file_get_contents($json);

        $this->assertEquals($expected, genDiff($firstFile, $secondFile, 'json'));
    }

    #[DataProvider('formatProvider')]
    public function testGenDiffStylish(string $format): void
    {
        $firstFile = "{$this->filePath}file1.{$format}";
        $secondFile = "{$this->filePath}file2.{$format}";
        $stylish = "{$this->filePath}stylish-expected";
        $expected = file_get_contents($stylish);

        $this->assertEquals($expected, genDiff($firstFile, $secondFile, 'stylish'));
    }

    #[DataProvider('formatProvider')]
    public function testGenDiffDefault(string $format): void
    {
        $firstFile = "{$this->filePath}file1.{$format}";
        $secondFile = "{$this->filePath}file2.{$format}";
        $stylish = "{$this->filePath}stylish-expected";
        $expected = file_get_contents($stylish);

        $this->assertEquals($expected, genDiff($firstFile, $secondFile));
    }

    public static function formatProvider(): array
    {
        return [
            ['json'],
            ['yaml']
        ];
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
            ['plain-expected', 'file1.yaml', 'file2.yaml', 'plain'],

            ['json-expected', 'file1.json', 'file2.json', 'json'],
            ['json-expected', 'file1.yaml', 'file2.yaml', 'json'],

            ['stylish-expected', 'file1.json', 'file2.json', 'stylish'],
            ['stylish-expected', 'file1.yaml', 'file2.yaml', 'stylish'],

            ['stylish-expected', 'file1.json', 'file2.json'],
            ['stylish-expected', 'file1.yaml', 'file2.yaml'],
        ];
    }
     * */
}
