<?php
include 'plugin/header.php';
include 'db.php'; // Replace with your actual database connection file

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Customer') {
  header('login.php'); // Redirect to login page if not a customer
  exit;
}


// Fetch transactions with book details from the database
$query_purchased_books = "
    SELECT 
        t.transaction_id, 
        t.customer_name, 
        t.customer_email, 
        t.quantity, 
        t.total_price, 
        t.transaction_date, 
        t.status, 
        b.title AS book_title, 
        b.category AS book_category,
        b.price AS book_price,
        b.stock AS book_stock,
        b.image_url AS book_image,
        b.description AS book_description
    FROM transactions t
    INNER JOIN books b ON t.book_id = b.books_id
    WHERE t.status = 'confirmed'"; // Filter by confirmed status
$result_purchased_books = $conn->query($query_purchased_books);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .main {
            width: 90%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3.card__title {
            text-align: center;
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .purchased_books {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            width: calc(33.333% - 20px);
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card img {
            max-width: 100%;
            border-radius: 8px;
        }

        .card .info {
            margin-top: 15px;
        }

        .card .info h4 {
            font-size: 18px;
            color: #4CAF50;
            margin: 5px 0;
        }

        .card .info p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .card .info .price {
            font-weight: bold;
            color: #e91e63;
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;
            }
        }
    </style>
    <title>Purchased Books</title>
</head>
<body>
    <main class="main">
        <!--==================== PURCHASED BOOKS ====================-->
        <section class="purchased_books">
            <h3 class="card__title">Purchased Books</h3>
            <?php
            if ($result_purchased_books->num_rows > 0) {
                while ($row = $result_purchased_books->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <img src="<?php echo $row['book_image']; ?>" alt="<?php echo htmlspecialchars($row['book_title']); ?>">
                        <div class="info">
                            <h4><?php echo htmlspecialchars($row['book_title']); ?></h4>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($row['book_category']); ?></p>
                            <p><strong>Customer:</strong> <?php echo htmlspecialchars($row['customer_name']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['customer_email']); ?></p>
                            <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
                            <p><strong>Total Price:</strong> ₱<?php echo $row['total_price']; ?></p>
                            <p><strong>Transaction Date:</strong> <?php echo $row['transaction_date']; ?></p>
                            <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                            <p class="price">₱<?php echo $row['book_price']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No purchased books found.</p>";
            }
            ?>
        </section>
    </main>
</body>
</html>
