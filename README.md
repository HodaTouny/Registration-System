# User Registration System

## Description

This project is a user registration system developed using PHP. It allows users to register by providing personal details and validates the input data both client-side and server-side. The system ensures unique usernames, handles image uploads, and integrates with the IMDb API to display actors born on the same day as the user's birthdate.

## Features

1. **User Registration Form**: Allows users to register by providing personal details including full name, username, birthdate, phone, address, password, confirm password, user image, and email.
2. **Client-side Validation**: Ensures all form fields are mandatory and have correct data types. Passwords must match, be at least 8 characters long, and contain at least one number and one special character.
3. **Server-side Validation**: Checks if the username is already registered before allowing submission.
4. **Image Upload**: Uploads user image to the server, storing the image name in the database.
5. **IMDb API Integration**: Allows users to check actors born on the same day as their birthdate using the IMDb API.

## Installation

1. **Clone the repository**:

    ```sh
    git clone https://github.com/your/repository.git
    ```

2. **Set up your database in the `DB_Ops.php` file**:

    ```php
    $dbServer = "localhost";
    $username = "root";
    $password = "";
    $dbName = "yourdbname";
    ```

3. **Run the project**:
   - Start XAMPP and MySQL admin.
   - Open the project in your browser:

    ```
    http://localhost/foldername/pages/index.php
    ```
