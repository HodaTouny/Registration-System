<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <form method="POST" enctype="multipart/form-data" id="registrationForm">
            <div class="row justify-content-center">
                <div class="col-md-3 mb-3 col-sm-3">
                    <div class="text-center">
                        <div>
                            <label for="imageInput" style="cursor: pointer;">
                                <div class="rounded-circle border d-flex justify-content-center align-items-center" id="imageContainer" style="width: 100px; height: 100px; overflow: hidden; border-color: #753873;">
                                    <img id="uploadedImage" src="../assets/upload.png" alt="Upload"/>
                                </div>
                                <input type="file" id="imageInput" name="image" class="form-control" style="display: none;" onchange="handleImageUpload(event)" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name"/>
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="user-name" name="user-name" placeholder="User Name"/>
                </div>

                <div class="form-group mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="phone-number" name="phone-number" placeholder="Phone Number"/>
                </div>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address"/>
                </div>

                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confrirm Password" />
                </div>

                <div class="form-group mb-3">
                    <input type="date" class="form-control" id="Birth" name="Birth" placeholder="Date of Birth" />
                </div>
                
                <div class="form-group mb-3 row align-items-center justify-content-center">
                    <button type="button" class="btn text-white col-md-5 mb-2 mb-md-0" style="background-color: #753873;">Actors With Same DBO</button>
                    <div class="col-md-1"></div>
                    <button type="submit" class="btn text-white col-md-5" style="background-color: #753873;">Sign Up</button>
                </div>
            </div>
        </form>
        <div id="alertContainer" class ="col-md-12"></div>
        
    </div>

    <script src="../javascript/form.js"></script>
</body>
</html>


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

            if (registerUser($conn, $name, $username, $birth, $email, $password, $address, $phone)) {
                $successMessage .= "User registered successfully.";
                echo "<script>showAlert('$successMessage', 'success');</script>";
            } else {
                $errorMessage = "Error registering user.";
                echo "<script>showAlert('$errorMessage', 'danger');</script>";
            }
        }
    }
    ?>
