<?php
include '../db.php'; // Database connection

// Check if the book ID is provided
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch the book details from the database
    $query = "SELECT * FROM books WHERE books_id = '$book_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found!";
        exit;
    }
} else {
    echo "Invalid book ID!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Handle image upload (if new image is uploaded)
    $image_url = $book['image_url']; // Keep the existing image if no new one is uploaded
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
            $image_url = $image_path; // Update the image path
        } else {
            echo "Failed to upload image.";
            exit;
        }
    }

    // Update the book in the database
    $query = "UPDATE books SET 
                title = '$title', 
                category = '$category', 
                price = '$price', 
                stock = '$stock', 
                image_url = '$image_url', 
                description = '$description'
              WHERE books_id = '$book_id'";

    if ($conn->query($query) === TRUE) {
        echo "Book updated successfully.";
        header('Location: manage_books.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <style>
        .edit-book-container {
            padding: 20px;
            margin-top: 40px;
        }

        .modal-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 10px;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="edit-book-container">
    <h2>Edit Book</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" class="modal-input" placeholder="Book Title" value="<?php echo $book['title']; ?>" required>
        <input type="text" name="category" class="modal-input" placeholder="Category" value="<?php echo $book['category']; ?>" required>
        <input type="number" name="price" class="modal-input" placeholder="Price" value="<?php echo $book['price']; ?>" required>
        <input type="number" name="stock" class="modal-input" placeholder="Stock" value="<?php echo $book['stock']; ?>" required>
        <input type="file" name="image_url" class="modal-input">
        <textarea name="description" class="modal-input" placeholder="Description" required><?php echo $book['description']; ?></textarea>
        <button type="submit" class="modal-btn">Update Book</button>
        <a href="../manage_books.php"><button type="button" class="cancel-btn">Cancel</button></a>
    </form>
</div>

</body>
</html>
