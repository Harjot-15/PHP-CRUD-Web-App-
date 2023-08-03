<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Control</title>
    <link rel="stylesheet" type="text/css" href="CSS/admin_control.css">
</head>
<body>
    <header>
        <nav>
            <h1>Welcome to CRUD Application</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="content-section">
        <h2>Content List</h2>
        <!-- Display a table listing all the contents from the 'content' table -->
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            // Include database connection (replace 'db_config.php' with your database configuration file)
            require_once 'db_config.php';

            // Perform SQL query to fetch all contents from the 'content' table
            $sql = "SELECT * FROM content";
            $result = $conn->query($sql);

            // Loop through each row of the result and display the content data in the table
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Id'] . '</td>';
                echo '<td>' . $row['Title'] . '</td>';
                echo '<td>' . $row['Description'] . '</td>';
                echo '<td><img src="' . $row['Image_path'] . '" alt="' . $row['Title'] . '"></td>';
                echo '<td>';
                echo '<form action="process_update_delete.php" method="POST">';
                echo '<input type="hidden" name="action" value="update">';
                echo '<input type="hidden" name="content_id" value="' . $row['Id'] . '">';
                echo '<button type="submit">Update</button>';
                echo '</form>';
                echo '<form action="process_update_delete.php" method="POST">';
                echo '<input type="hidden" name="action" value="delete">';
                echo '<input type="hidden" name="content_id" value="' . $row['Id'] . '">';
                echo '<button type="submit">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            $conn->close();
            ?>
        </table>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> CRUD Application. All rights reserved.</p>
    </footer>
</body>
</html>
