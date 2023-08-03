<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Assuming you have a function to retrieve the user's data from the database
function getUserData($email) {
    // Include database connection (replace 'db_config.php' with your database configuration file)
    require_once 'db_config.php';

    // Perform SQL query to retrieve the user's data based on the email
    $sql = "SELECT * FROM signup WHERE EMail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }

    $stmt->close();
    $conn->close();
}

$userData = getUserData($_SESSION['user_id']);
if (!$userData) {
    // User data not found, redirect to the login page
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
</head>

<body>
    <header>
        <nav>
            <h1>Welcome to CRUD Application</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="admin_control.php">Admin Control</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="dashboard-section">
        <h2>Welcome to Your Dashboard, <?php echo $userData['Username']; ?></h2>
        <!-- Add other dashboard content here, e.g., links to add, update, delete content -->
        <div class="dashboard-links">
            <a href="add_content.html">Add New Content</a>
            <a href="admin_control.php">Manage Content</a>
            <a href="logout.php">Logout</a>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> CRUD Application. All rights reserved.</p>
    </footer>
</body>
</html>
