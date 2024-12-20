<?php
include 'plugin/head.php'; // Include the header with the sidebar
include 'db.php'; // Database connection

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
  header('login.php'); // Redirect to login page if not a customer
  exit;
}


// Fetch books from the database
$query_books = "SELECT * FROM books";
$result_books = $conn->query($query_books);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <style>
        /* Styling for manage books page */
        .manage-books-container {
            padding: 20px;
            
            margin-top: 40px;
        }

        .add-book-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .add-book-btn:hover {
            background-color: #45a049;
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

        .action-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: #4CAF50;
        }

        .delete-btn:hover, .edit-btn:hover {
            background-color: #45a049;
        }

        /* Modal Styling */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="manage-books-container">
        <h3>Manage Books</h3>
        <!-- Button to Open the Modal -->
        <button class="add-book-btn" id="openModalBtn">Add New Book</button>

        <table>
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_books->num_rows > 0) {
                    while ($row = $result_books->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['books_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['category']}</td>
                            <td>₱{$row['price']}</td>
                            <td>{$row['stock']}</td>
                            <td>
                                <a href='managebooks/edit_book.php?id={$row['books_id']}'><button class='action-btn edit-btn'>Edit</button></a>
                                <a href='managebooks/delete_book.php?id={$row['books_id']}'><button class='action-btn delete-btn'>Delete</button></a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No books available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding New Book -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Book</h2>
            <form action="add_book.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" class="modal-input" placeholder="Book Title" required>
                <input type="text" name="category" class="modal-input" placeholder="Category" required>
                <input type="number" name="price" class="modal-input" placeholder="Price" required>
                <input type="number" name="stock" class="modal-input" placeholder="Stock" required>
                <input type="file" name="image_url" class="modal-input" required>
                <textarea name="description" class="modal-input" placeholder="Description" required></textarea>
                <button type="submit" class="modal-btn">Add Book</button>
            </form>

        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModalBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
