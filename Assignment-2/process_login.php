<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection (replace 'db_config.php' with your database configuration file)
    require_once 'db_config.php';

    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform form validation (you can add more validation checks as needed)
    if (empty($email) || empty($password)) {
        // Redirect to the login page with an error message
        header("Location: login.html?error=emptyfields");
        exit();
    }

    // Perform SQL query to retrieve the user's hashed password from the database based on the email
    $sql = "SELECT Password FROM signup WHERE EMail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, user is logged in
            session_start();
            $_SESSION['user_id'] = $email; // You can store any unique identifier of the user in the session

            // Redirect to the dashboard.php page after successful login
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            // Redirect to the login page with an error message
            header("Location: login.html?error=invalidpassword");
            exit();
        }
    } else {
        // User not found in the database
        // Redirect to the login page with an error message
        header("Location: login.html?error=usernotfound");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: login.html");
    exit();
}
?>
