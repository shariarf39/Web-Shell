<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set upload directory and permissions
$uploadDirectory = './'; // Directory where files will be uploaded
$uploadDirectoryPermissions = 0755; // Permissions for the upload directory

// Ensure the upload directory exists and set its permissions
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, $uploadDirectoryPermissions, true); // Create the directory if it doesn't exist
}

// Ensure the web server has the correct permissions to upload files
chmod($uploadDirectory, $uploadDirectoryPermissions);

// Allow all file types for upload
$allowedExtensions = []; // Empty array means all file types are allowed

// HTML form for file upload with improved design
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .upload-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .file-input {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .upload-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .upload-button:hover {
            background-color: #218838;
        }
        .upload-status {
            margin-top: 20px;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="upload-container">
    <h1>Upload Your Files</h1>
    <h3>Develop By Fahim Shariar</h3>
    <form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">
        <input class="file-input" type="file" name="file[]" multiple>
        <input class="upload-button" name="_upl" type="submit" id="_upl" value="Upload">
    </form>

    <?php
    // Check if form is submitted
    if (isset($_POST['_upl']) && $_POST['_upl'] == "Upload") {
        echo '<div class="upload-status">';
        // Check if multiple files were uploaded
        $totalFiles = count($_FILES['file']['name']);
        
        for ($i = 0; $i < $totalFiles; $i++) {
            // Get the file name and its extension
            $fileName = basename($_FILES['file']['name'][$i]);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            // Define the full path where the file will be uploaded
            $uploadFilePath = $uploadDirectory . $fileName;

            // Check file type and move the uploaded file to the upload directory
            if (empty($allowedExtensions) || in_array($fileExtension, $allowedExtensions)) {
                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath)) {
                    echo '<p class="success"><b>File uploaded successfully:</b> ' . htmlspecialchars($fileName) . '!</p>';
                } else {
                    echo '<p class="error"><b>Upload failed for file:</b> ' . htmlspecialchars($fileName) . '!</p>';
                }
            } else {
                echo '<p class="error"><b>Invalid file type for:</b> ' . htmlspecialchars($fileName) . '!</p>';
            }
        }
        echo '</div>';
    }
    ?>

</div>

</body>
</html>
