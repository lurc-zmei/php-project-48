<?php

namespace Hexlet\Code;
class Parser
{
//    private $filePath;
//
//    public function __construct($filePath)
//    {
//        $this->filePath = $filePath;
//    }
    public function parse($filePath)
    {
        if (file_exists($filePath)) {
            $absolutePath = realpath($filePath);
            $content = file_get_contents($absolutePath);
            $data = json_decode($content);
        } else {
            $data = 'File not found';
        }
        return $data;
    }

}
