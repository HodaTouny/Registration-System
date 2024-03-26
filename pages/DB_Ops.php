<?php
$dbServer = "localhost";
$username = "root";
$password = "";
$dbName = "registerdb";
$conn = "";

try {
    $conn = mysqli_connect($dbServer, $username, $password, $dbName);
} catch (mysqli_sql_exception $e) {
    echo "Error in connection!!!";
}

function checkUsername($conn, $username)
{
    $query = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function registerUser($conn, $name, $username, $birth, $email, $password, $address, $phone)
{
    $query = "INSERT INTO users (full_name, user_name, birthdate, email, password, address, phone) VALUES ('$name', '$username', '$birth', '$email', '$password', '$address', '$phone')";
    return mysqli_query($conn, $query);
}
//  if($conn){
//     echo "yes";
//  }
//  else{
//     echo "no";
//  }
?>
