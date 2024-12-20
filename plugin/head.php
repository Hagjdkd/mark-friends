<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Reset some default styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling for header */
        header.header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
        }

        /* Logo Styling */
        header.header .logo h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        /* Navigation Styling */
        header.header nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            margin: 0;
        }

        header.header nav ul li {
            margin: 0 15px;
        }

        header.header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        /* Hover effect on links */
        header.header nav ul li a:hover {
            color: #333;
            border-bottom: 2px solid white;
            padding-bottom: 5px;
        }

        /* Make the nav bar responsive */
        @media screen and (max-width: 768px) {
            header.header {
                flex-direction: column;
                text-align: center;
            }

            header.header nav ul {
                flex-direction: column;
                margin-top: 10px;
            }

            header.header nav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo">
            <h1>Bookstore Admin</h1>
        </div>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="manage_books.php">Manage Books</a></li>
                <li><a href="manage_transactions.php">Manage Transactions</a></li>
                <li><a href="masterlist.php">Masterlist</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
