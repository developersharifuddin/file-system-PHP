<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>filesystem PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1>create file</h1>
    <a href="openfile.php" class="btn btn-info" target="_blank" rel="noopener noreferrer">Open file</a>

    <!-- create-new-content-ui.php -->
    <?php
    $directoryPath = 'new_content'; // Change this to the directory you want to list

    // Function to get a list of folders and files in a directory
    function listDirectoriesAndFiles($directory)
    {
        $directories = [];
        $files = [];

        $scan = array_diff(scandir($directory), array('..', '.'));

        foreach ($scan as $item) {
            if (is_dir($directory . '/' . $item)) {
                $directories[] = $item;
            } else {
                $files[] = $item;
            }
        }

        return [
            'directories' => $directories,
            'files' => $files,
        ];
    }

    $list = listDirectoriesAndFiles($directoryPath);
    ?>

    <p>Existing folders:</p>
    <ul>
        <?php foreach ($list['directories'] as $directory) : ?>
            <li><?php echo $directory; ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Existing files:</p>
    <ul>
        <?php foreach ($list['files'] as $file) : ?>
            <li><?php echo $file; ?></li>
        <?php endforeach; ?>
    </ul>




    <!-- create-new-content-ui.php -->
    <?php
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = trim($_POST['fileContentInput']);
        if (!empty($content)) {
            // Content is not empty, submit the form to create-new-content.php
            header("Location: create-new-content.php?fileContentInput=" . urlencode($content));
            exit();
        } else {
            $error = 'Please enter content.';
        }
    }
    ?>

    <form method="POST" action="">
        <textarea name="fileContentInput" rows="8" cols="50" placeholder="Enter file content here"></textarea><br>
        <input type="submit" value="Create File">
        <p style="color: red;"><?php echo $error; ?></p>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>