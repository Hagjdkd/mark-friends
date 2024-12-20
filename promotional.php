<?php 
include 'plugin/heads.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark's & Friend's Bookstore - Promotions</title>
    <link rel="icon" href="uploads/bg.jpg" type="image/jpg">
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure page takes up full height */
        }
        .promo-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9f9f9;
            flex: 1; /* This makes the promo section take up remaining space */
        }

        .promo-title {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .promo-description {
            font-size: 18px;
            color: #555;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .book-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .book-item {
    width: 200px; /* Reduced width */
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-radius: 8px;
    transition: transform 0.3s ease;
}


        .book-item:hover {
            transform: scale(1.05);
        }

        .book-cover {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .book-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin: 15px 0;
        }

        .book-category {
            color: #555;
            font-size: 16px;
        }

        .book-price {
            color: #e74c3c;
            font-size: 18px;
        }

        .book-description {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cta-btn {
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: auto; /* Push the footer to the bottom */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: center;
            }

            .nav {
                flex-direction: column;
                gap: 10px;
                margin-top: 10px;
            }

            .book-container {
                flex-direction: column;
                gap: 20px;
            }

            .book-item {
                width: 90%;
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .promo-title {
                font-size: 28px;
            }

            .promo-description {
                font-size: 16px;
            }

            .book-title {
                font-size: 18px;
            }

            .book-price {
                font-size: 16px;
            }

            .book-description {
                font-size: 12px;
            }

            .cta-btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Promotion Section -->
    <section class="promo-section">
        <h2 class="promo-title">Featured Books</h2>
        <p class="promo-description">Explore our latest collection of books available for sale. From fiction to non-fiction, we've got it all!</p>

        <div class="book-container">
            <!-- Book 1 -->
            <div class="book-item">
                <img class="book-cover" src="uploads/th.jpg" alt="Book 1 Cover">
                <div class="book-title">Book Title 1</div>
                <div class="book-category">Fiction</div>
                <div class="book-price">₱299.99</div>
                <div class="book-description">A short description of the book goes here. It provides an overview of the storyline, characters, and more.</div>
                <a href="login.php?book_id=1" class="cta-btn">Learn More</a>
            </div>

            <!-- Book 2 -->
            <div class="book-item">
                <img class="book-cover" src="uploads/th (1).jpg" alt="Book 2 Cover">
                <div class="book-title">Book Title 2</div>
                <div class="book-category">Mystery</div>
                <div class="book-price">₱450.00</div>
                <div class="book-description">An intriguing mystery novel with twists and turns. A must-read for fans of thrillers!</div>
                <a href="login.php?book_id=2" class="cta-btn">Learn More</a>
            </div>

            <!-- Book 3 -->
            <div class="book-item">
                <img class="book-cover" src="uploads/th (2).jpg" alt="Book 3 Cover">
                <div class="book-title">Book Title 3</div>
                <div class="book-category">Non-fiction</div>
                <div class="book-price">₱399.99</div>
                <div class="book-description">An inspiring book about personal growth and success. This will change your perspective on life.</div>
                <a href="login.php?book_id=3" class="cta-btn">Learn More</a>
            </div>

            <!-- Book 4 -->
            <div class="book-item">
                <img class="book-cover" src="uploads/th (3).jpg" alt="Book 4 Cover">
                <div class="book-title">Book Title 4</div>
                <div class="book-category">Science Fiction</div>
                <div class="book-price">₱499.99</div>
                <div class="book-description">A thrilling science fiction novel set in the future, filled with adventure and futuristic technology.</div>
                <a href="login.php?book_id=4" class="cta-btn">Learn More</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mark's & Friend's Bookstore | All Rights Reserved</p>
    </footer>

</body>
</html>
