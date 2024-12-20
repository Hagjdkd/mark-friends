<?php
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $full_name = isset($_POST['full-name']) ? mysqli_real_escape_string($conn, $_POST['full-name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
    $role = isset($_POST['role']) ? mysqli_real_escape_string($conn, $_POST['role']) : '';
    
    // Validate that no field is empty
    if (empty($full_name) || empty($email) || empty($password) || empty($role)) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } else {
        // Check if email already exists in the database
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email_query);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<p style='color:red;'>This email is already registered.</p>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query = "INSERT INTO users (username, email, password, role) VALUES ('$full_name', '$email', '$hashed_password', '$role')";
            
            if (mysqli_query($conn, $query)) {
                echo "<p>Registration successful. <a href='login.php'>Login here</a></p>";
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }
        }
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
</head>
<body>
    <div class="container">
        <div class="form-container right">
            <h1>Register</h1>
            <form action="admin_register.php" method="POST">
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <!-- Select Role Dropdown for Admin and Customer -->
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="Admin">Admin</option>
                </select>

                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </div>
</body>
</html>
