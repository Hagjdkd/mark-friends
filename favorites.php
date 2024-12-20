<?php
session_start(); // Start the session
include 'plugin/header.php';
include 'db.php'; // Replace with your actual database connection file

// Check if there are favorites in the session
if (isset($_SESSION['favorites']) && !empty($_SESSION['favorites'])) {
    // Get the book IDs from the session
    $favoriteIds = implode(',', $_SESSION['favorites']);
    $query = "SELECT `books_id`, `title`, `category`, `price`, `stock`, `image_url`, `description` FROM `books` WHERE `books_id` IN ($favoriteIds)";
    $result = $conn->query($query);
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>Favorites</title>
</head>
<body>
    <main class="main">
        <section class="favorites">
            <h3 class="card__title">Your Favorites</h3>
            
            <?php if ($result && $result->num_rows > 0): ?>
                <div class="book__grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <article class="card__article" data-category="<?php echo htmlspecialchars($row['category']); ?>" data-title="<?php echo htmlspecialchars($row['title']); ?>">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Book" class="card__img">
                            <div class="card__data">
                                <h3 class="card__name"><?php echo htmlspecialchars($row['title']); ?></h3>
                                <span class="card__category"><?php echo htmlspecialchars($row['category']); ?></span>
                                <p class="card__price">$<?php echo htmlspecialchars($row['price']); ?></p>
                                <p class="card__description"><?php echo htmlspecialchars($row['description']); ?></p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>You have no favorites yet.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
