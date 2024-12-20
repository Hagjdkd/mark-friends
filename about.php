<?php
include 'plugin/heads.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Mark's & Friend's Bookstore</title>
    <link rel="icon" href="uploads/bg.jpg" type="image/jpg">
    <style>
        /* Basic page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure page takes full height */
        }

        /* Content styles */
        .about-section {
            padding: 50px 20px;
            text-align: center;
            flex: 1; /* Make the about section fill the remaining space */
        }

        .about-title {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        .about-description {
            font-size: 18px;
            color: #555;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .about-image {
            width: 100%;
            max-width: 600px;
            height: auto;
            margin: 20px auto;
            display: block;
            border-radius: 10px;
        }

       
/* Footer styling */
footer {
  background-color: #333; /* Bootstrap primary color */
  color: white;
  text-align: center;
  padding: 1rem;
  margin-top: auto; /* Push the footer to the bottom */
}

/* Make sure footer links look good */
footer a {
  color: white;
  text-decoration: none;
  margin: 0 8px;
}

footer a:hover {
  text-decoration: underline;
}


        /* Styling for the 'Why Choose Us' list */
        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- About Section -->
    <section class="about-section">
        <h2 class="about-title">About Mark's & Friend's Bookstore</h2>
        <p class="about-description">
            Welcome to Mark's & Friend's Bookstore, your one-stop shop for books of all genres! We are passionate about reading and aim to bring the world of literature closer to you. Whether you’re a fiction lover, a non-fiction enthusiast, or looking for books for your kids, we have something for everyone.
        </p>
        <p class="about-description">
            Our bookstore was founded with the goal of offering a wide variety of books, competitive pricing, and excellent customer service. We pride ourselves on providing personalized recommendations and a seamless shopping experience for all book lovers.
        </p>
        <p class="about-description">
            We believe in the power of books to inspire, educate, and entertain. Our store is carefully curated with titles that are sure to enrich your life, and we’re constantly updating our collection to ensure we offer the latest bestsellers and timeless classics.
        </p>
        <img src="uploads/g.jpg" alt="Bookstore Image" class="about-image">

        <h3>Why Choose Us?</h3>
        <ul>
            <li><strong>Wide Selection:</strong> From fiction to non-fiction, we have a vast array of books to suit every taste.</li>
            <li><strong>Affordable Prices:</strong> Enjoy great discounts and deals on all our products.</li>
            <li><strong>Fast Delivery:</strong> Get your books delivered to your doorstep in no time!</li>
            <li><strong>Customer Support:</strong> We’re here to help! Our friendly support team is always available for your inquiries.</li>
        </ul>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mark's & Friend's Bookstore | All Rights Reserved</p>
    </footer>

</body>
</html>
