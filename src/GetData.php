<?php

namespace Differ\Differ;

use Exception;

class GetData
{
    public string $content;
    public string $extension;

    public function __construct(string $file)
    {
        $this->content = $this->getContent($file);
        $this->extension = $this->getExtension($file);
    }

    /**
     * @throws Exception
     */
    private function getContent(string $filePath): string
    {
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            if ($content === false) {
                throw new Exception("Cannot read file: {$filePath}");
            }
            return $content;
        } else {
            throw new Exception("File not found: {$filePath}");
        }
    }

    private function getExtension(string $filePath): string
    {
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }
}
