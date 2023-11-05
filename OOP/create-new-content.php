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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fileContentInput'])) {
    $contentFromRequest = $_GET['fileContentInput'];

    $newFileContent = new FileContent($contentFromRequest);

    $directoryPath = 'new_content';
    $fileCreator = new FileCreator($directoryPath, $newFileContent);
    $fileCreator->createWelcomeFile();

    $filePath = $fileCreator->getFilePath();
    viewFileContent($filePath);
} else {
    echo "No content submitted.";
}
