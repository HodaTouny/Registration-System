document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");

    // const loader = document.querySelector(".loading");
    // loader.classList.add("loading-hidden");

    const fieldsID = ["name", "user-name", "email", "phone-number", "address", "password", "confirm_password", "Birth"];
    fieldsID.forEach(fieldID => {
        const field = document.getElementById(fieldID);
        field.addEventListener("blur", function () {
            validation(field);
        });
    });

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        fieldsID.forEach(fieldID => {
            const field = document.getElementById(fieldID);
            validation(field);
        });

        const invalidFields = form.querySelectorAll(".error-message");
        if (invalidFields.length > 0) {
            showAlert("Invalid input.", 'danger');
            return;
        }

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
                if (xhr.status === 200 && xhr.readyState == 4) {
                    const responseText = xhr.responseText;
                    const alertRegex = /showAlert\('(.+)', '(.+)'\);/;
                    const match = alertRegex.exec(responseText);
                    if (match) {
                        const message = match[1];
                        const type = match[2];
                        showAlert(message, type);
                        if (message.trim().toLowerCase() === "user registered successfully.") {
                            form.reset();
                        }
                    } else {
                        showAlert("server error", 'danger');
                    }
                } 
        };
        xhr.open("POST", "upload.php", true);
        xhr.send(formData);
    });
    
    document.getElementById("dob-btn").addEventListener("click", function () {
        getActorsByDOB();
    })

});
function validation(inputField) {
    const fieldid = inputField.id;
    const value = inputField.value.trim();
    const parent = inputField.parentElement;
    const errorElement = parent.querySelector(".error-message");

    if (errorElement) {
        errorElement.remove();
    }
    if (value === "") {
        displayError(inputField, "This field is required.");
        return false;
    }

    switch (fieldid) {
        case "name":
            if (value.split(" ").length < 2 || !/^[a-zA-Z\s]+$/.test(value)) {
                displayError(inputField, "Write full name.");
            }
            break;
        case "email":
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                displayError(inputField, "Invalid email address.");
            }
            break;
        case "Birth":
            const today = new Date();
            const birthDateTime = new Date(value);
            if (birthDateTime >= today) {
                displayError(inputField, "Invalid Date of Birth.");
            }
            break;
        case "password":
            const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(value)) {
                displayError(inputField, "Password must be at least 8 characters long and contain at least one number and one special character.");
            }
            break;
        case "confirm_password":
            const password = document.getElementById("password").value.trim();
            if (value !== password) {
                displayError(inputField, "Passwords do not match.");
            }
            break;
        default:
            break;
    }
}
function displayError(inputField, message) {
    const parent = inputField.parentElement;
    const errorElement = parent.querySelector(".error-message");
    if (errorElement) {
        errorElement.textContent = message;
    } else {
        const errorMessage = document.createElement("span");
        errorMessage.className = "error-message";
        errorMessage.textContent = message;
        errorMessage.style.color = "red"; 
        errorMessage.style.display = "block";
        parent.appendChild(errorMessage);
    }
}
function showAlert(message, type) {
    var alertDiv = document.createElement("div");
    alertDiv.className = "alert alert-" + type;
    alertDiv.setAttribute("role", "alert");
    alertDiv.innerHTML = message;
    document.getElementById("alertContainer").appendChild(alertDiv);
    setTimeout(function () {
        alertDiv.remove();
    }, 5000);
}
function handleImageUpload(event) {
    const file = event.target.files[0];
    const validFormats = ['image/jpeg', 'image/png', 'image/gif'];
    const maxSize = 5 * 1024 * 1024;
    if (file) {
        if (!validFormats.includes(file.type)) {
            showAlert("Invalid image format. Please select a JPEG, PNG, or GIF file.", 'danger');
            return; 
        }

        if (file.size > maxSize) {
            showAlert("File size exceeds the maximum limit of 5MB.", 'danger');
            return; }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('uploadedImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

function getActorsByDOB() {
    const dateOfBirth = document.getElementById("Birth").value.substring(5);
    document.getElementById("actorsList").innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState === 4 && xhr.status === 200) {

            var response = JSON.parse(xhr.responseText);
            for (var i = 0; i < response.length; i++){
                document.getElementById("actorsList").innerHTML += `<li class='list-group-item'>${response[i]}</li>`;
            }
            // document.body.removeChild("loading");
        }
    }
    xhr.open("GET", "API_Ops.php?today=" + dateOfBirth);
    xhr.send();
}
