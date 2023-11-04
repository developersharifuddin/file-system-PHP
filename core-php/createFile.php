<?php

// $directory = 'new/app'; // Directory path

// if (!file_exists($directory)) {
//     $dir = mkdir($directory, 0777, true);
// }
// $path = new SplFileInfo(__FILE__);
// echo 'The real path is ' . $path->getRealPath();

// $content = "some text here";
// $fp = fopen($dir . "newphpfile.php", "w");

// if (fwrite($fp, $content)) {
//     echo "file write successfully ";
//     $myfile = fopen($dir . "newphpfile.php", "r") or die("Unable to open file!");
//     echo fread($myfile, filesize($dir . "newphpfile.php"));
//     fclose($myfile);
// } else {
//     echo "error";
// }
// fclose($fp);



$directory = 'new/app'; // Directory path

// Check if the directory doesn't exist, create it
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

// File path
$file = $directory . '/index.php';

// Content for the index.php file (welcome message)
$content = <<<EOD
<?php
// Welcome message
echo "Welcome to this new app!";
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


// // Create the file if it doesn't exist and write the content (welcome message) to it
// if (!file_exists($file)) {
//     file_put_contents($file, $content);
//     echo "File created: $file";
// } else {
//     echo "File already exists: $file";
// }

// View the directory content
$dir = scandir($directory);
echo "<pre>";
print_r($dir);
echo "</pre>";
