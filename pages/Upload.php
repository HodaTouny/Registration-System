<?php
include 'DB_Ops.php';

$errorMessage = $successMessage = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user-name'];
    if (checkUsername($conn, $username)) {
        $errorMessage = "Username already exists.";
        echo "<script>showAlert('$errorMessage', 'danger');</script>";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birth = $_POST['Birth'];
        $address = $_POST['address'];
        $phone = $_POST['phone-number'];


        if (!empty($_FILES["image"]["name"])) {
            $targetDirectory = "uploads/";

            if (!file_exists($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }

            $targetFile = $targetDirectory . uniqid() . '_' . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                if (registerUser($conn, $name, $username, $birth, $email, $password, $address, $phone, basename($targetFile))) {
                    $successMessage = "User registered successfully.";
                    echo "<script>showAlert('$successMessage', 'success');</script>";
                } else {
                    $errorMessage = "Error registering user.";
                }
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
            }
        } else {
            $errorMessage = "Please select an image.";
        }

        if ($errorMessage) {
            echo "<script>showAlert('$errorMessage', 'danger');</script>";
        }
    }
}
?>

