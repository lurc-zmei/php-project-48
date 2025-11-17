<?php

namespace Differ\Differ;

use Exception;

class GetData
{
    public function getFileData(string $file): array
    {
        $fileContent = $this->getContent($file);
        $fileExtension = $this->getExtension($file);

        return Parser::parse($fileContent, $fileExtension);
    }

    /**
     * @throws Exception
     */
    public function getContent(string $filePath): string
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
