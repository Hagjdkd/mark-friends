<?php
include 'plugin/header.php';
include 'db.php'; // Replace with your actual database connection file

// Query to get the best-selling books based on total quantity sold
$query_best_sellers = "
    SELECT 
        b.books_id, 
        b.title AS book_title, 
        b.category AS book_category,
        b.price AS book_price,
        b.stock AS book_stock,
        b.image_url AS book_image,
        SUM(t.quantity) AS total_sold
    FROM transactions t
    INNER JOIN books b ON t.book_id = b.books_id
    GROUP BY b.books_id
    ORDER BY total_sold DESC
    LIMIT 10"; // Show top 10 best-sellers
$result_best_sellers = $conn->query($query_best_sellers);
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

        .best_sellers {
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

        .card .info .sold {
            font-size: 14px;
            color: #FF9800;
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
    <title>Best Sellers</title>
</head>
<body>
    <main class="main">
        <!--==================== BEST SELLERS ====================-->
        <section class="best_sellers">
            <h3 class="card__title">Best Selling Books</h3>
            <?php
            if ($result_best_sellers->num_rows > 0) {
                while ($row = $result_best_sellers->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <img src="<?php echo $row['book_image']; ?>" alt="<?php echo htmlspecialchars($row['book_title']); ?>">
                        <div class="info">
                            <h4><?php echo htmlspecialchars($row['book_title']); ?></h4>
                            <p><strong>Category:</strong> <?php echo htmlspecialchars($row['book_category']); ?></p>
                            <p><strong>Stock:</strong> <?php echo $row['book_stock']; ?> items</p>
                            <p class="sold"><strong>Total Sold:</strong> <?php echo $row['total_sold']; ?> copies</p>
                            <p class="price">₱<?php echo $row['book_price']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No best-selling books found.</p>";
            }
            ?>
        </section>
    </main>
</body>
</html>
