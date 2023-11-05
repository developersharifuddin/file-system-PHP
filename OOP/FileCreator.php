<?php
class FileCreator
{
    private $directory;
    private $fileContent;
    private $filePath;

    public function __construct($directory, FileContent $fileContent)
    {
        $this->directory = $directory;
        $this->fileContent = $fileContent;
    }

    public function createWelcomeFile()
    {
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0777, true);
        }

        $this->filePath = $this->directory . '/index.php';
        $content = $this->fileContent->getContent();

        if (file_exists($this->filePath)) {
            file_put_contents($this->filePath, $content);
            echo "File overwritten: $this->filePath";
        } else {
            file_put_contents($this->filePath, $content);
            echo "File created: $this->filePath";
        }
    }

    public function getFilePath()
    {
        return $this->filePath;
    }
}
