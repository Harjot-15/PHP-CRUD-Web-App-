<?php
// Checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    require_once 'db_config.php';

    // Retrieves form data
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (empty($title) || empty($description)) {
        header("Location: add_content.html?error=emptyfields");
        exit();
    }

    // Handles file upload

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
       
        $tmpFileName = $_FILES['image']['tmp_name'];
        $originalFileName = $_FILES['image']['name'];

        // Move the uploaded file to the 'uploads' folder
        $targetPath = "uploads/" . $originalFileName;
        move_uploaded_file($tmpFileName, $targetPath);

        // (I have a table 'content' with columns 'title', 'description', and 'image_path')
        $sql = "INSERT INTO content (title, description, image_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $description, $targetPath);
        $stmt->execute();
        $stmt->close();
    } else {
        // Redirect to the add content page with an error message (if file upload failed)
        header("Location: add_content.html?error=fileuploaderror");
        exit();
    }

    // Redirect to the add content page with a success message
    header("Location: add_content.html?success=contentadded");
    exit();
} else {
    // If the form is not submitted, redirect to the add content page
    header("Location: add_content.html");
    exit();
}
?>
