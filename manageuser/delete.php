<?php
include 'db.php'; // Include the database connection file

// Start session to check if user is logged in
session_start();

// Check if the user is logged in and has the "Admin" role
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    header('Location: login.php'); // Redirect to login if not an admin
    exit();
}

// Get the user ID from the URL parameter
if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];

    // Delete the user from the database
    $delete_query = "DELETE FROM users WHERE user_id = $user_id";
    
    if ($conn->query($delete_query)) {
        echo "<p>User deleted successfully. <a href='masterlist.php'>Go back to Master List</a></p>";
    } else {
        echo "<p>Error deleting user: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "Invalid user ID.";
    exit();
}
?>
