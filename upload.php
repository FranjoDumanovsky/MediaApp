<?php
include('authentication.php');
// Check if a file has been uploaded
if (isset($_FILES['fileToUpload'])) {
    $targetDirectory = "uploads/"; // Specify the directory where you want to save the uploaded images
    $originalFileName = $_FILES['fileToUpload']['name'];
    $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    // Generate a new file name (you can customize this as needed)
    $newFileName = '_' . $_SESSION['auth_user']['name'] . '.' . "png";
    $targetFile = $targetDirectory . $newFileName;
    $uploadOk = 1;
    // ... Rest of the file upload checks ...
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    } else {
        header("Location: dashboard.php");
        // If everything is fine, try to upload the file with the new name
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            // Redirect to dashboard.php
            header("Location: dashboard.php");
            exit(); // Ensure script execution stops after the redirect
        } else {
            header("Location: dashboard.php");
        }
    }
}?>
