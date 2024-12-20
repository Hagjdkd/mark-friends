<?php
include 'plugin/head.php'; // Include the header with the sidebar
include 'db.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Handle image upload
    $image_url = '';
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        // Specify the directory where images will be stored
        $upload_dir = 'uploads/';
        $image_name = $_FILES['image_url']['name'];
        $image_tmp_name = $_FILES['image_url']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Validate the file extension (optional)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_ext, $allowed_extensions)) {
            echo "Only image files (jpg, jpeg, png, gif) are allowed.";
            exit;
        }

        // Generate a new unique name for the image
        $new_image_name = uniqid('', true) . '.' . $image_ext;
        $image_path = $upload_dir . $new_image_name;

        // Move the uploaded image to the desired directory
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $image_url = $image_path; // Save the path to the image
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    // Insert the new book into the database
    $query = "INSERT INTO books (title, category, price, stock, image_url, description)
              VALUES ('$title', '$category', '$price', '$stock', '$image_url', '$description')";

    if ($conn->query($query) === TRUE) {
        echo "New book added successfully";
        // Redirect back to the manage books page
        header('Location: manage_books.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
