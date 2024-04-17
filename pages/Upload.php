<?php
$errorMessage = '';

if (!empty($_FILES["image"]["name"])) {
    $targetDirectory = "uploads/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile = $targetDirectory . uniqid() . '_' . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imageName = basename($targetFile);
    } else {
        $errorMessage = "Sorry, there was an error uploading your file.";
    }
} else {
    $errorMessage = "Please select an image.";
}

if ($errorMessage) {
    echo "showAlert('$errorMessage', 'danger');";
}
?>
