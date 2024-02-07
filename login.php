<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "login");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from form
    $name = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to check if user exists
    $sql = "SELECT * FROM users WHERE username='$name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, set session and redirect to YouTube
        $_SESSION["username"] = $name;
        header("Location: https://www.youtube.com");
        exit(); // Ensure that no further code is executed after redirection
    } else {
        // User not found, redirect back to login page with error message
        header("Location: login.html?error=1");
        exit(); // Ensure that no further code is executed after redirection
    }

    // Close connection
    $conn->close();
}
?>
