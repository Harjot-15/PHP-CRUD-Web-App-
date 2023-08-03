<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Check if the form is submitted and the action is either 'update' or 'delete'
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && ($_POST["action"] === "update" || $_POST["action"] === "delete")) {
    // Include database connection (replace 'db_config.php' with your database configuration file)
    require_once 'db_config.php';

    // Get the content ID from the form submission
    $contentId = $_POST['content_id'];

    if ($_POST["action"] === "update") {
        // Redirect to the update_content.php page with the content ID for updating
        header("Location: update_content.php?content_id=" . $contentId);
        exit();
        // Note: Replace "update_content.php" with the actual file where you implement the update form.
    } elseif ($_POST["action"] === "delete") {
        // Perform the delete operation (you need to implement this based on your requirements)
        // For example, you can show a confirmation prompt and then delete the content from the database.
        // Note: Add appropriate error handling and validation when deleting.
        $sql = "DELETE FROM content WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $contentId);
        if ($stmt->execute()) {
            // Content deleted successfully, you can redirect to the admin_control.php page.
            header("Location: admin_control.php");
            exit();
        } else {
            // An error occurred while deleting the content.
            // Handle the error appropriately (e.g., display an error message).
            echo "Error deleting content: " . $stmt->error;
        }
    }

    $conn->close();
} else {
    // If the form is not submitted properly or the action is invalid, redirect to the admin_control.php page.
    header("Location: admin_control.php");
    exit();
}
?>
