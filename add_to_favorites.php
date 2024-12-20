<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a book ID is passed
    if (isset($_POST['book_id'])) {
        $bookId = $_POST['book_id'];

        // Initialize the favorites array if not set
        if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
        }

        // Add the book to the favorites array (avoiding duplicates)
        if (!in_array($bookId, $_SESSION['favorites'])) {
            $_SESSION['favorites'][] = $bookId;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
?>
