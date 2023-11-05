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
    
    <!-- resources/views/mails/bulk_email.blade.php -->
    <!DOCTYPE html>
    <html>
    <head>
    
        <title>Bulk Email</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f4f4f4;
                padding: 20px;
                margin: 0;
            }
    
            .container {
                max-width: 600px;
                margin: 0 auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .header {
                background: #4CAF50;
                color: #fff;
                text-align: center;
                padding: 10px 0;
                border-radius: 8px 8px 0 0;
            }
    
            .header h1 {
                margin: 0;
            }
    
            .content {
                padding: 20px 0;
            }
    
            table {
                width: 100%;
                border-collapse: collapse;
            }
    
            table,
            th,
            td {
                border: 1px solid #ddd;
            }
    
            th,
            td {
                padding: 10px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            .footer {
                text-align: center;
                margin-top: 20px;
                color: #666;
                font-size: 12px;
            }
    
        </style>
    </head>
    <body>
    
        <div class="container">
            <div class="header">
                <h1>Bulk Email Content</h1>
            </div>
            <div class="content">
                <p>This is a sample bulk email template. You can customize it according to your requirements.</p>
     
                <p>Regards,<br>Your Application</p>
    
                <table>
                    <thead>
                        <tr>
                            <th>Your User ID</th>
                            <th>Customer Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>user</td>
                            <td>user->email </td>
                        </tr>
                        <!-- Add more rows for additional products if applicable -->
                    </tbody>
                </table>
                <p>If you have any questions, feel free to contact us.</p>
                <p>Thank you for your order!</p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} YourCompany. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>
    

EOD
);





$fileCreator = new FileCreator($directoryPath, $fileContent);
$fileCreator->createWelcomeFile();
viewFileContent($filePath);
