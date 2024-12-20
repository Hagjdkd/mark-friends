<?php
include 'plugin/head.php';
include 'db.php'; // Replace with your actual database connection file

session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
  header('login.php'); // Redirect to login page if not a customer
  exit;
}



// Query to get book and transaction statistics
$query_books_count = "SELECT COUNT(*) AS total_books FROM books";
$query_transactions_count = "SELECT COUNT(*) AS total_transactions FROM transactions";
$query_sales_total = "SELECT SUM(total_price) AS total_sales FROM transactions";

$result_books_count = $conn->query($query_books_count)->fetch_assoc();
$result_transactions_count = $conn->query($query_transactions_count)->fetch_assoc();
$result_sales_total = $conn->query($query_sales_total)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="books-bg.jpg">
    
    <style>
        /* General Reset */
    
 

        /* Main Content Styling */
        .main-content {
            
            padding: 30px;
            flex-grow: 1;
            background-color: #fff;
        }

        h3.card__title {
            font-size: 32px;
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .dashboard-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-card h4 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 20px;
            color: #555;
            font-weight: 600;
        }

        .stat-card .icon {
            font-size: 50px;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .section-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #388e3c;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .dashboard-stats {
                flex-direction: column;
                align-items: center;
            }

            .stat-card {
                width: 100%;
                margin-bottom: 20px;
            }
        }

    </style>
    <title>Admin Dashboard</title>
</head>
<body>


    <!-- Main Content -->
    <div class="main-content">
        <h3 class="card__title">Admin Dashboard</h3>

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="icon">📚</div>
                <h4>Total Books</h4>
                <p><?php echo $result_books_count['total_books']; ?></p>
            </div>
            <div class="stat-card">
                <div class="icon">💳</div>
                <h4>Total Transactions</h4>
                <p><?php echo $result_transactions_count['total_transactions']; ?></p>
            </div>
            <div class="stat-card">
                <div class="icon">💰</div>
                <h4>Total Sales</h4>
                <p>₱<?php echo number_format($result_sales_total['total_sales'], 2); ?></p>
            </div>
        </div>

        <!-- Books Table -->
        <section>
            <h4 class="section-title">Latest Books</h4>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_latest_books = "SELECT * FROM books ORDER BY books_id DESC LIMIT 5";
                        $result_latest_books = $conn->query($query_latest_books);

                        if ($result_latest_books->num_rows > 0) {
                            while ($row = $result_latest_books->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['title']}</td>
                                    <td>{$row['category']}</td>
                                    <td>₱{$row['price']}</td>
                                    <td>{$row['stock']}</td>
                                    <td><a href='manage_books.php?id={$row['books_id']}' class='btn'>Edit</a></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No books found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Latest Transactions Table -->
        <section>
            <h4 class="section-title">Latest Transactions</h4>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Customer Name</th>
                            <th>Book Title</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_latest_transactions = "SELECT t.transaction_id, t.customer_name, b.title AS book_title, t.quantity, t.total_price, t.status FROM transactions t INNER JOIN books b ON t.book_id = b.books_id ORDER BY t.transaction_id DESC LIMIT 5";
                        $result_latest_transactions = $conn->query($query_latest_transactions);

                        if ($result_latest_transactions->num_rows > 0) {
                            while ($row = $result_latest_transactions->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['transaction_id']}</td>
                                    <td>{$row['customer_name']}</td>
                                    <td>{$row['book_title']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>₱{$row['total_price']}</td>
                                    <td>{$row['status']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No transactions found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    </div>

</body>
</html>
