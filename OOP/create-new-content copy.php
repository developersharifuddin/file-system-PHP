<?php
include 'FileContent.php';
include 'FileCreator.php';

function viewFileContent($filePath)
{
    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        echo "<pre>";
        echo htmlspecialchars($fileContent);
        echo "</pre>";
    } else {
        echo "File not found.";
    }
}

$newFileContent = new FileContent(
    <<<EOD
<?php
// New content
echo "This is the new content for the new file.";
?>
EOD
);

$directoryPath = 'new_content';
$fileCreator = new FileCreator($directoryPath, $newFileContent);
$fileCreator->createWelcomeFile();

$filePath = $fileCreator->getFilePath();
viewFileContent($filePath);
