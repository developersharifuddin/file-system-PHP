<?php
class FileCreator
{
    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function createWelcomeFile()
    {
        // Check if the directory doesn't exist, create it
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0777, true);
        }

        // File path
        $file = $this->directory . '/index.php';

        // Content for the index.php file (welcome message)
        $content = <<<EOD
        <?php
        // Welcome message
        echo "Welcome to this new app! (Updated)";
        ?>
        EOD;

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

// Usage
$directoryPath = 'new/app';
$fileCreator = new FileCreator($directoryPath);
$fileCreator->createWelcomeFile();
