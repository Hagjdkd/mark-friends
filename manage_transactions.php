<?php
include 'plugin/head.php';
include 'db.php'; // Database connection
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
  header('login.php'); // Redirect to login page if not a customer
  exit;
}

// Fetch transactions from the database using the provided query
$query_transactions = "SELECT transaction_id, customer_name, customer_email, book_id, quantity, total_price, transaction_date, status 
                       FROM transactions WHERE 1";
$result_transactions = $conn->query($query_transactions);

// Check if the transaction is updated
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];
    $status = $_POST['status'];

    // Check if status is "confirmed" before updating
    if ($status === 'confirmed') {
        $update_query = "UPDATE transactions SET status = '$status' WHERE transaction_id = '$transaction_id' AND status != 'confirmed'";

        if ($conn->query($update_query) === TRUE) {
            echo "Transaction confirmed successfully.";
        } else {
            echo "Error: Transaction already confirmed or an issue occurred.";
        }
    } else {
        // Update status if it's not "confirmed"
        $update_query = "UPDATE transactions SET status = '$status' WHERE transaction_id = '$transaction_id' AND status != 'confirmed'";

        if ($conn->query($update_query) === TRUE) {
            echo "Transaction status updated successfully.";
        } else {
            echo "Error: Transaction already confirmed, status cannot be changed.";
        }
    }
}

// Handle transaction deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM transactions WHERE transaction_id = '$delete_id'";

    if ($conn->query($delete_query) === TRUE) {
        echo "Transaction deleted successfully.";
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
    <title>Manage Transactions</title>
    <style>
        /* Styling for manage transactions page */
        .manage-transactions-container {
            padding: 20px;
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .status-select {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .update-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .update-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="manage-transactions-container">
    <h3>Manage Transactions</h3>

    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Book ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Transaction Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_transactions->num_rows > 0) {
                while ($row = $result_transactions->fetch_assoc()) {
                    // Display status and action buttons
                    $status = $row['status'];
                    echo "<tr>
                            <td>{$row['transaction_id']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['customer_email']}</td>
                            <td>{$row['book_id']}</td>
                            <td>{$row['quantity']}</td>
                            <td>₱{$row['total_price']}</td>
                            <td>{$row['transaction_date']}</td>
                            <td>{$status}</td>
                            <td>
                                <form action='' method='POST' style='display: inline;'>
                                    <select name='status' class='status-select' " . ($status == 'confirmed' ? 'disabled' : '') . ">
                                        <option value='pending' " . ($status == 'pending' ? 'selected' : '') . ">Pending</option>
                                        <option value='completed' " . ($status == 'completed' ? 'selected' : '') . ">Completed</option>
                                        <option value='cancelled' " . ($status == 'cancelled' ? 'selected' : '') . ">Cancelled</option>
                                        <option value='confirmed' " . ($status == 'confirmed' ? 'selected' : '') . ">Confirmed</option>
                                    </select>
                                    <input type='hidden' name='transaction_id' value='{$row['transaction_id']}'>
                                    <button type='submit' class='update-btn'>Update</button>
                                </form>
                                <a href='?delete_id={$row['transaction_id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this transaction?\");'>Delete</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No transactions available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
