<?php
session_start(); // Start the session

// Checks if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Assuming you have a function to retrieve the user's data from the database
function getUserData($email) {

    require_once 'db_config.php';

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
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
</head>
<body>
  <header>
    <nav>
      <h1>CRUD SPACE</h1>
      <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="admin_control.php">Admin Control</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <div class="hero">
      <div class="hero-content">
        <div class="username">
          <h2>Welcome to Your Dashboard,
            <?php echo $userData['Username']; ?>
          </h2>
        </div>
        <h1>CRUD Application</h1>
        <p>Manage your content with ease using our CRUD application.</p>
        <div class="cta-buttons">
          <a href="admin_control.php" class="btn btn-primary">Admin Control</a>
          <a href="add_content.html" class="btn btn-primary">Add Content</a>
        </div>
        <div class="logout-button">
          <a href="logout.php" class="btn">Logout</a>
        </div>
      </div>
    </div>
  </section>
 <div class="features">
</div>
<footer>
    <p>&copy;
      <?php echo date("Y"); ?> CRUD Application. All rights reserved.
    </p>
  </footer>
</body>
</html>