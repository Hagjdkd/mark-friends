<?php 
include 'plugin/header.php';
include 'db.php'; // Replace with your actual database connection file
session_start();  // Always call session_start() at the top


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Customer') {
    header('Location: login.php'); // Redirect to login page if not a customer
    exit;
}

// Get the logged-in user's ID
$logged_in_user_id = $_SESSION['user_id'];

// Fetch books (global, visible to all users)
$query_books = "SELECT `books_id`, `title`, `category`, `price`, `stock`, `image_url`, `description` FROM `books`";
$result_books = $conn->query($query_books);

// Fetch transactions specific to the logged-in user
$query_transactions = "SELECT `transaction_id`, `customer_name`, `customer_email`, `book_id`, `quantity`, `total_price`, `transaction_date`, `status` 
                       FROM `transactions` 
                       WHERE `transaction_id` = ?";

$stmt_transactions = $conn->prepare($query_transactions);
$stmt_transactions->bind_param("i", $logged_in_user_id);
$stmt_transactions->execute();
$result_transactions = $stmt_transactions->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mark&Friends Bookstore</title>
    <link rel="icon" type="image/jpg" href="uploads/bg.jpg">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="dashboard.css">
    
</head>
<body>
    <main class="main">

        <!--==================== BOOKS ====================-->
        <section class="books">
            <div class="books-header">
                <h3 class="card__title">Books</h3>

                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Search books by title..." class="header__input">
                </div>

                <!-- Dropdown Filter -->
                <div class="dropdown">
                    <button class="dropdown-btn">Filter by Category</button>
                    <div class="dropdown-content">
                        <label><input type="checkbox" class="filter-checkbox" data-category="Fiction"> Fiction</label>
                        <label><input type="checkbox" class="filter-checkbox" data-category="Romance"> Romance</label>
                        <label><input type="checkbox" class="filter-checkbox" data-category="Science"> Science</label>
                        <label><input type="checkbox" class="filter-checkbox" data-category="Biography"> Biography</label>
                    </div>
                </div>
            </div>

            <div class="book__grid">
                <?php 
                if ($result_books->num_rows > 0) {
                    while ($row = $result_books->fetch_assoc()) {
                        ?>
                        <article class="card__article" data-category="<?php echo htmlspecialchars($row['category']); ?>" data-title="<?php echo htmlspecialchars($row['title']); ?>">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Book" class="card__img">
                            <div class="card__data">
                                <h3 class="card__name"><?php echo htmlspecialchars($row['title']); ?></h3>
                                <span class="card__category"><?php echo htmlspecialchars($row['category']); ?></span>
                                <p class="card__price">₱<?php echo htmlspecialchars($row['price']); ?></p>
                                <p class="card__description"><?php echo htmlspecialchars($row['description']); ?></p>
                                <!-- Display stock -->
                                <p class="card__stock">Stock: <?php echo htmlspecialchars($row['stock']); ?></p>
                                <i class="ri-heart-3-line card__like"></i>
                                <button class="card__buy" data-id="<?php echo $row['books_id']; ?>" data-title="<?php echo htmlspecialchars($row['title']); ?>" data-price="<?php echo $row['price']; ?>">Buy Now</button>
                                <button class="card__favorite" data-id="<?php echo $row['books_id']; ?>">Add to Favorites</button>
                            </div>
                        </article>
                        <?php
                    }
                } else {
                    echo "<p>No books available.</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Modal for Buy Now Form -->
    <div id="buyModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Buy Book</h2>
            <form id="buyForm" action="buy_book.php" method="POST">
                <input type="hidden" id="book_id" name="book_id">
                <input type="hidden" id="book_title" name="book_title">
                <input type="hidden" id="book_price" name="book_price">
                <label for="customer_name">Your Name:</label>
                <input type="text" id="customer_name" name="customer_name" required>
                
                <label for="customer_email">Your Email:</label>
                <input type="email" id="customer_email" name="customer_email" required>
                
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
                
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Dropdown toggle
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdownContent = document.querySelector('.dropdown-content');
        dropdownBtn.addEventListener('click', () => {
            dropdownContent.classList.toggle('show');
        });

        // Filter books based on selected categories
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                filterBooks();
            });
        });

        // Search books based on user input
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', () => {
            filterBooks();
        });

        function filterBooks() {
            const searchQuery = searchInput.value.toLowerCase();
            const selectedCategories = [];
            document.querySelectorAll('.filter-checkbox:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.getAttribute('data-category'));
            });

            document.querySelectorAll('.card__article').forEach(book => {
                const bookCategory = book.getAttribute('data-category');
                const bookTitle = book.getAttribute('data-title').toLowerCase();

                const matchesSearch = bookTitle.includes(searchQuery);
                const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(bookCategory);

                if (matchesSearch && matchesCategory) {
                    book.style.display = 'block';
                } else {
                    book.style.display = 'none';
                }
            });
        }

        // Close dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!dropdownContent.contains(e.target) && !dropdownBtn.contains(e.target)) {
                dropdownContent.classList.remove('show');
            }
        });

        // Add to Favorites functionality
        document.querySelectorAll('.card__favorite').forEach(button => {
            button.addEventListener('click', (e) => {
                const bookId = e.target.getAttribute('data-id');
                fetch('add_to_favorites.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'book_id': bookId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Added to Favorites!');
                    } else {
                        alert('Failed to add to favorites.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Modal functionality
        const modal = document.getElementById('buyModal');
        const closeModal = document.querySelector('.close');
        const buyButtons = document.querySelectorAll('.card__buy');

        // Open modal on "Buy Now" button click
        buyButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const bookId = e.target.getAttribute('data-id');
                const bookTitle = e.target.getAttribute('data-title');
                const bookPrice = e.target.getAttribute('data-price');

                // Set modal form values
                document.getElementById('book_id').value = bookId;
                document.getElementById('book_title').value = bookTitle;
                document.getElementById('book_price').value = bookPrice;

                // Open modal
                modal.style.display = 'block';
                setTimeout(() => {
                    modal.style.opacity = '1'; // Fade-in effect
                }, 100);
            });
        });

        // Close modal when "X" button is clicked
        closeModal.addEventListener('click', () => {
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Matches fade-out duration
        });

        // Close modal if clicked outside
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.opacity = '0';
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300); // Matches fade-out duration
            }
        });
    </script>
</body>
</html>




