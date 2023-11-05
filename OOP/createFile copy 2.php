<?php
class FileContent
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}

class FileCreator
{
    private $directory;
    private $fileContent;

    public function __construct($directory, FileContent $fileContent)
    {
        $this->directory = $directory;
        $this->fileContent = $fileContent;
    }

    public function createWelcomeFile()
    {
        // Check if the directory doesn't exist, create it
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0777, true);
        }

        // File path
        $file = $this->directory . '/index.php';

        // Get content from FileContent object
        $content = $this->fileContent->getContent();

        // Check if the file exists, if so, overwrite with the new content
        if (file_exists($file)) {
            file_put_contents($file, $content);
            echo "File overwritten: $file";
        } else {
            // If the file doesn't exist, create it and write the content
            file_put_contents($file, $content);
            echo "File created: $file";
        }

        // View the directory content
        $dir = scandir($this->directory);
        echo "<pre>";
        print_r($dir);
        echo "</pre>";
    }
}


function viewFileContent($filePath)
{
    // Check if the file exists
    if (file_exists($filePath)) {
        // Read the file content
        $fileContent = file_get_contents($filePath);
        // Display the file content
        echo "<pre>";
        echo htmlspecialchars($fileContent);
        echo "</pre>";
    } else {
        echo "File not found.";
    }
}



// Usage
$directoryPath = 'new/app';
$filePath = $directoryPath . '/index.php';
$fileContent = new FileContent(
    <<<EOD
<?php
// Welcome message
echo "Welcome to this new app! (Updated)";
?>
EOD
);





$fileCreator = new FileCreator($directoryPath, $fileContent);
$fileCreator->createWelcomeFile();
viewFileContent($filePath);
