<?php
include 'db.php'; // Include the database connection

// Start session to store user data
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query the database for the user
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if password matches
        if (password_verify($password, $user['password'])) {
            // Password correct, set session data
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on user role

            if ($user['role'] === 'Customer') {
                header('Location: dashboard.php');
                exit;
            } else if ($user['role'] === 'Admin') {
                header('Location: admin_dashboard.php');
                exit;
            }
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mark&Friends Bookstore</title>
    <link rel="icon" type="image/jpg" href="uploads/bg.jpg">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }

        .modal button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #45a049;
        }

        .modal .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
        }

        .modal .close:hover,
        .modal .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="form-container right">
            <h1>Login</h1>
                <a href="promotional.php">Go to Hompage</a>
            <form action="login.php" method="POST">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Log In</button>
            </form>
            
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p>For Admin Only <a href="javascript:void(0);" onclick="document.getElementById('adminModal').style.display = 'block';">Admin Login</a></p>
        </div>
    </div>

    <!-- Modal for Admin Verification -->
    <div id="adminModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('adminModal').style.display = 'none'">&times;</span>
            <h2>Admin Verification</h2>
            <form action="admin_register.php" method="POST" id="adminForm">
                <label for="adminUsername">Admin Username:</label>
                <input type="text" id="adminUsername" name="adminUsername" required><br><br>

                <label for="adminPassword">Admin Password:</label>
                <input type="password" id="adminPassword" name="adminPassword" required><br><br>

                <button type="submit">Verify</button>
            </form>
        </div>
    </div>

    <script>
        // Close the modal if clicked outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('adminModal')) {
                document.getElementById('adminModal').style.display = 'none';
            }
        }
    </script>
</body>
</html>
