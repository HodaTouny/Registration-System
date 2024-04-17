<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">
</head>

<body>
    <div class="container py-4">
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
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
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
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
                </div>

                <div class="form-group mb-3">
                    <input type="date" class="form-control" id="Birth" name="Birth" placeholder="Date of Birth" />
                </div>
                
                <div class="form-group mb-3 row align-items-center justify-content-center">
                    <button type="button" class="btn text-white col-md-5 mb-2 mb-md-0" style="background-color: #753873;" data-bs-toggle="modal" data-bs-target="#actorsModal" id="dob-btn">Actors With Same DBO</button>
                    <div class="col-md-1"></div>
                    <button type="submit" class="btn text-white col-md-5" style="background-color: #753873;" id="submit-btn">Sign Up</button>
                </div>
            </div>
        </form>
        <div id="alertContainer" class ="col-md-12"></div>
        
        <div class="modal" id="actorsModal" tabindex="-1" aria-labelledby="actorsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="actorsModalLabel">Actors with the same birthdate</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group" id="actorsList">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="loading" ></div>
    <script src="../Bootstrap/bootstrap.min.js"></script>
    <script src="../javascript/form.js"></script>
    <?php include 'Controller.php'; ?>

</body>
</html>
