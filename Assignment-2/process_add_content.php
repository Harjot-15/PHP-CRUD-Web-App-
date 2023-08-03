<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection (replace 'db_config.php' with your database configuration file)
    require_once 'db_config.php';

    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Perform form validation (you can add more validation checks as needed)
    if (empty($title) || empty($description)) {
        // Redirect to the add content page with an error message
        header("Location: add_content.html?error=emptyfields");
        exit();
    }

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
