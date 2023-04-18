<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Check if file was uploaded without errors
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = $_FILES['file']['tmp_name'];
        $destination = 'uploads/' . $_FILES['file']['name']; // Destination folder and filename

        $uploadedFile2 = $_FILES['file2']['tmp_name'];
        $destination2 = 'uploads/' . $_FILES['file2']['name']; // Destination folder and filename

        // Move uploaded file to destination folder
        if (move_uploaded_file($uploadedFile, $destination)) {
            echo 'File was uploaded successfully.';
        } else {
            echo 'Failed to move uploaded file to destination.';
        }

        if (move_uploaded_file($uploadedFile2, $destination2)) {
            echo 'File was uploaded successfully.';
        } else {
            echo 'Failed to move uploaded file to destination.';
        }
    } else {
        echo 'File upload error: ' . $_FILES['file']['error'];
    }
}
?>
