<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user_id'])) {
        // User is not logged in, redirect to the login page
        header("Location: login.html");
        exit();
    }

    require_once 'db_config.php';

    // Get content ID from the form
    if (isset($_POST['content_id'])) {
        $content_id = $_POST['content_id'];

        // Get other form data
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Validate form data

        // Handle image update
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_path = 'uploads/' . $image_name;

            // Moves the uploaded image to the specified folder
            move_uploaded_file($image_tmp_name, $image_path);

            $sql = "UPDATE content SET Title='$title', Description='$description', Image_path='$image_path' WHERE Id='$content_id'";
        } else {
            // If no new image is provided, update without changing the Image_path column
            $sql = "UPDATE content SET Title='$title', Description='$description' WHERE Id='$content_id'";
        }

        if ($conn->query($sql) === TRUE) {
            // Redirect back to admin control page after successful update
            header("Location: admin_control.php");
        } else {
            echo "Error updating content: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
