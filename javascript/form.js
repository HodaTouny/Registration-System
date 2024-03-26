document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); 

        const name = document.getElementById("name").value
        const userName = document.getElementById("user-name").value
        const email = document.getElementById("email").value
        const phoneNumber = document.getElementById("phone-number").value
        const address = document.getElementById("address").value
        const password = document.getElementById("password").value
        const confirmPassword = document.getElementById("confirm_password").value
        const birthDate = document.getElementById("Birth").value
        const imageInput = document.getElementById("imageInput");

        let isValid = true; 

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
            isValid = false;
        }
        
        if (!name || !userName || !email || !phoneNumber || !address || !password || !confirmPassword || !birthDate||!imageInput) {
            showAlert("All fields are required.",'danger');
        }

        if (name.split(" ").length < 2 || !/^[a-zA-Z\s]+$/.test(name)) {
            displayError(document.getElementById("name"), "write full name");
        }

        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       if (!emailRegex.test(email)) {
            displayError(document.getElementById("email"), "Invalid email address.");
        }
        const today = new Date();
        const birthDateTime = new Date(birthDate);
        if (birthDateTime >= today) {
            displayError(document.getElementById("Birth"), "inavalid Date of birth ");
        }

        const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        if (!passwordRegex.test(password)) {
            displayError(document.getElementById("password"), "Password must be at least 8 characters long and contain at least one number and one special character.");
        }

        if (confirmPassword !== password) {
            displayError(document.getElementById("confirm_password"), "Passwords do not match.");
        }

        if (isValid) {
            // const successMessage = document.createElement("div");
            // successMessage.className = "alert alert-success";
            // successMessage.textContent = "User registered successfully.";
            // form.parentNode.insertBefore(successMessage, form.nextSibling);
            form.submit();
        }
    });
});





function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('uploadedImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
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
    }, 3000);
}
