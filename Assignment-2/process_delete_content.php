<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checks if the user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // If User is not logged in, redirect to the login page
        header("Location: login.html");
        exit();
    }

    // Database connection 
    require_once 'db_config.php';

    // Get content ID from the form
    if (isset($_POST['content_id'])) {
        $content_id = $_POST['content_id'];
        
        // Delete content from the database
        $sql = "DELETE FROM content WHERE Id='$content_id'";
        if ($conn->query($sql) === TRUE) {
            // Redirect back to admin control page after successful deletion
            header("Location: admin_control.php");
        } else {
            echo "Error deleting content: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
