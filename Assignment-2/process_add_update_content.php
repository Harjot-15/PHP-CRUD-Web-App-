<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Include database connection (replace 'db_config.php' with your database configuration file)
require_once 'db_config.php';

// Retrieve form data
$action = $_POST['action']; // 'add' or 'update'
$contentId = $_POST['content_id']; // Assuming you have a form field named 'content_id' with the content ID
$title = $_POST['title'];
$description = $_POST['description'];

// Perform form validation (you can add more validation checks as needed)
if (empty($action) || empty($title) || empty($description)) {
    // Redirect to the admin control page with an error message
    header("Location: admin_control.php?error=invalidrequest");
    exit();
}

if ($action == 'add') {
    // Perform insert operation (Add new content)

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file name on the server
        $tmpFileName = $_FILES['image']['tmp_name'];

        // Get the original file name
        $originalFileName = $_FILES['image']['name'];

        // Move the uploaded file to the desired location
        $targetPath = "uploads/" . $originalFileName; // Replace 'uploads/' with the desired directory path
        move_uploaded_file($tmpFileName, $targetPath);

        // Perform SQL query to insert the content and image path into the database
        // (Assuming you have a table 'content' with columns 'title', 'description', and 'image_path')
        $sql = "INSERT INTO content (title, description, image_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $description, $targetPath);
        $stmt->execute();
        $stmt->close();
    } else {
        // Redirect to the admin control page with an error message (if file upload failed)
        header("Location: admin_control.php?error=fileuploaderror");
        exit();
    }
} elseif ($action == 'update') {
    // Perform update operation (Update existing content)

    // Perform SQL update query
    $sql = "UPDATE content SET title=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $contentId);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to the admin control page with a success message
header("Location: admin_control.php?success=operationcompleted");
exit();
?>
