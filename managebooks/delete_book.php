<?php
include '../db.php'; // Database connection

// Check if the book ID is provided
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch the book details to get the image URL
    $query = "SELECT image_url FROM books WHERE books_id = '$book_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $image_url = $book['image_url'];

        // Delete the book from the database
        $delete_query = "DELETE FROM books WHERE books_id = '$book_id'";

        if ($conn->query($delete_query) === TRUE) {
            // Remove the image file if it exists
            if (!empty($image_url) && file_exists($image_url)) {
                unlink($image_url);
            }

            echo "Book deleted successfully.";
            header('Location: ../manage_books.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Book not found!";
    }
} else {
    echo "Invalid book ID!";
}
?>
