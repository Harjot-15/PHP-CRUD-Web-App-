<!DOCTYPE html>
<html>
<head>
    <title>Update Content</title>
    <link rel="stylesheet" type="text/css" href="CSS/update_content.css">
</head>
<body>
    <header>
        <nav>
            <h1>CRUD Application</h1>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="admin_control.php">Admin Control</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <section class="form-section">
        <div class="form-container">
            <h2>Update Content</h2>
            <?php
        
            require_once 'db_config.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['content_id'])) {
                    $content_id = $_POST['content_id'];

                    // Fetch the selected content from the database
                    $sql = "SELECT * FROM content WHERE Id = '$content_id'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $title = $row['Title'];
                        $description = $row['Description'];
                        $image_path = $row['Image_path'];
                    } else {
                        echo '<p>Content not found.</p>';
                        exit(); // Exit if the content is not found.
                    }
                } else {
                    echo '<p>Invalid request.</p>';
                    exit(); // Exit if the content ID is not provided.
                }
            } else {
                echo '<p>Invalid request method.</p>';
                exit(); // Exit if the request method is not POST.
            }
            ?>

            <form action="process_update_content.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="content_id" value="<?php echo $content_id; ?>">

                <div class="input-box">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
                </div>

                <div class="input-box">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $description; ?></textarea>
                </div>

                <div class="input-box upload-box">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <?php if (!empty($image_path)) { ?>
                        <img src="<?php echo $image_path; ?>" alt="<?php echo $title; ?>" width="100">
                    <?php } else { ?>
                        <p>No file chosen</p>
                    <?php } ?>
                </div>
                <input type="submit" value="Update Content">
            </form>
        </div>
    </section>
    <footer>
        <p>&copy; 2023 CRUD Application. All rights reserved.</p>
    </footer>
</body>
</html>
