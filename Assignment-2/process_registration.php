<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db_config.php';

    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        // Redirect to the registration page with an error message
        header("Location: register.html?error=emptyfields");
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Perform SQL query to insert the user into the database
    $sql = "INSERT INTO signup (Username, EMail, Password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Redirect to the registration success page
        header("Location: registration_success.php");
        exit();
    } else {
        // Redirect to the registration page with an error message
        header("Location: register.html?error=registrationerror");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect to the registration page
    header("Location: register.html");
    exit();
}
?>
