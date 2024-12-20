<?php
include 'db.php'; // Include the database connection
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the user_id from the session
$user_id = $_SESSION['user_id'];  // This is the logged-in user's ID

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $book_id = (int)$_POST['book_id'];
    $quantity = (int)$_POST['quantity'];

    // Validate form data
    if (empty($customer_name) || empty($customer_email) || empty($book_id) || empty($quantity)) {
        $error_message = "All fields are required.";
    } else {
        // Fetch book details to calculate the total price and check stock
        $query_book = "SELECT `price`, `stock` FROM `books` WHERE `books_id` = $book_id LIMIT 1";
        $result_book = $conn->query($query_book);

        if ($result_book && $result_book->num_rows > 0) {
            $book = $result_book->fetch_assoc();

            // Check if the stock is sufficient
            if ($book['stock'] >= $quantity) {
                $price = $book['price'];
                $total_price = $price * $quantity;

                // Insert transaction into the `transactions` table
                $insert_query = "INSERT INTO `transactions` 
                    (`user_id`, `customer_name`, `customer_email`, `book_id`, `quantity`, `total_price`, `transaction_date`, `status`) 
                    VALUES 
                    ($user_id, '$customer_name', '$customer_email', $book_id, $quantity, $total_price, NOW(), 'Pending')";
                
                if ($conn->query($insert_query)) {
                    // Update the stock in the `books` table
                    $new_stock = $book['stock'] - $quantity;
                    $update_stock_query = "UPDATE `books` SET `stock` = $new_stock WHERE `books_id` = $book_id";
                    if ($conn->query($update_stock_query)) {
                        // Redirect to the dashboard with success
                        header("Location: dashboard.php?transaction_id=" . $conn->insert_id);
                        exit();
                    } else {
                        $error_message = "Error updating book stock.";
                    }
                } else {
                    $error_message = "Error processing your transaction. Please try again.";
                }
            } else {
                $error_message = "Insufficient stock available for this book.";
            }
        } else {
            $error_message = "Book not found.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Book</title>
</head>
<body>
    <h2>Buy Book</h2>

    <!-- Display error message if any -->
    <?php if (isset($error_message)) { ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php } ?>

    <!-- Form to buy a book -->
    <form action="buy_book.php" method="POST">
        <label for="customer_name">Name:</label>
        <input type="text" name="customer_name" id="customer_name" required><br><br>

        <label for="customer_email">Email:</label>
        <input type="email" name="customer_email" id="customer_email" required><br><br>

        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" id="book_id" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br><br>

        <button type="submit">Buy</button>
    </form>

</body>
</html>
