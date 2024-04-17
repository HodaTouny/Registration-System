<?php
include 'DB_Ops.php';

$errorMessage = $successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user-name'];
    if (checkUsername($conn, $username)) {
        $errorMessage = "Username already exists.";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birth = $_POST['Birth'];
        $address = $_POST['address'];
        $phone = $_POST['phone-number'];

        include 'Upload.php';
        if (empty($errorMessage)) {
            if (registerUser($conn, $name, $username, $birth, $email, $password, $address, $phone, $imageName)) {
                $successMessage = "User registered successfully.";
            } else {
                $errorMessage = "Error registering user.";
            }
        }
    }

    if ($errorMessage) {
        echo "<script>showAlert('$errorMessage', 'danger');</script>";
    } elseif ($successMessage) {
        echo "<script>showAlert('$successMessage', 'success');</script>";
    }
}
?>
