<!DOCTYPE html>
<html>
<head>
    <title>Admin Control</title>
    <link rel="stylesheet" type="text/css" href="CSS/admin_control.css">
   
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
            // Check if the user is logged in
            session_start();
            if (!isset($_SESSION['user_id'])) {
                // User is not logged in, redirect to the login page
                header("Location: login.html");
                exit();
            }
            
            require_once 'db_config.php';

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
                echo '<button class="delete-button" onclick="showDeleteConfirmation(' . $row['Id'] . ');">Delete</button>';
                echo '<form action="update_content.php" method="POST">';
                echo '<input type="hidden" name="content_id" value="' . $row['Id'] . '">';
                echo '<button type="submit">Update</button>';
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

    <script>
        // Function to show the delete confirmation popup
        function showDeleteConfirmation(id) {
            var popupOverlay = document.createElement("div");
            popupOverlay.classList.add("popup-overlay");
            document.body.appendChild(popupOverlay);

            var popupBox = document.createElement("div");
            popupBox.classList.add("popup-box");
            popupBox.innerHTML = `
                <p class="popup-text">Warning: This data will not be recoverable after deletion. Are you sure you want to delete this content?</p>
                <button class="popup-button" onclick="closeDeleteConfirmation();">No</button>
                <form id="delete_form_${id}" action="process_delete_content.php" method="POST">
                    <input type="hidden" name="content_id" value="${id}">
                    <button type="button" class="popup-button" onclick="deleteContent(${id});">Yes</button>
                </form>
            `;
            document.body.appendChild(popupBox);
        }

        // Function to close the delete confirmation popup
        function closeDeleteConfirmation() {
            var popupOverlay = document.querySelector(".popup-overlay");
            var popupBox = document.querySelector(".popup-box");
            if (popupOverlay && popupBox) {
                popupOverlay.remove();
                popupBox.remove();
            }
        }

        // Function to submit the delete form
        function deleteContent(id) {
            document.getElementById("delete_form_" + id).submit();
        }
    </script>
</body>
</html>
