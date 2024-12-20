<?php
include '../db.php'; // Include the database connection file

// Start session to check if user is logged in
session_start();

// Check if the user is logged in and has the "Admin" role
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    header('Location: ../login.php'); // Redirect to login if not an admin
    exit();
}

// Get the user ID from the URL parameter
if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];

    // Fetch the user's current data
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }

} else {
    echo "Invalid user ID.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Update the user's data
    $update_query = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE user_id = $user_id";
    
    if ($conn->query($update_query)) {
        echo "<p>User updated successfully. <a href='masterlist.php'>Go back to Master List</a></p>";
    } else {
        echo "<p>Error updating user: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Customer" <?php echo ($user['role'] == 'Customer') ? 'selected' : ''; ?>>Customer</option>
            </select>

            <button type="submit">Update User</button>
            <a href="../masterlist.php"><button type="button" class="cancel-btn">Cancel</button></a>
        </form>
    </div>
</body>
</html>
