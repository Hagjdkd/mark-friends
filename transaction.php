<?php 
include 'plugin/header.php';
include 'db.php'; // Replace with your actual database connection file

session_start();


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Customer') {
  header('login.php'); // Redirect to login page if not a customer
  exit;
}


// Fetch transactions from the database
$query_transactions = "SELECT transaction_id, customer_name, customer_email, book_id, quantity, total_price, transaction_date, status FROM transactions WHERE 1";
$result_transactions = $conn->query($query_transactions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body{
        background-color: #495057;
      }
      /* General Table Styling */
      table {
          width: 80%; /* Set table width to 80% */
          margin: 20px auto; /* Center table horizontally */
          border-collapse: collapse;
          font-family: 'Arial', sans-serif;
          background-color: #f9f9f9;
      }

      /* Table Header */
      th {
          background-color: #4CAF50;
          color: white;
          padding: 8px; /* Reduced padding */
          text-align: left;
      }

      /* Table Data Cells */
      td {
          padding: 8px; /* Reduced padding */
          text-align: left;
          border-bottom: 1px solid #ddd;
          font-size: 14px; /* Reduced font size */
      }

      /* Zebra Striping */
      tr:nth-child(even) {
          background-color: #f2f2f2;
      }

      /* Hover Effect */
      tr:hover {
          background-color: #ddd;
      }

      /* Responsive Design */
      @media (max-width: 600px) {
          table, thead, tbody, th, td, tr {
              display: block;
          }
          th {
              position: relative;
              padding-left: 50%;
          }
          th::before {
              content: attr(data-label);
              position: absolute;
              left: 10px;
              font-weight: bold;
          }
          td {
              padding-left: 50%;
          }
          td::before {
              content: attr(data-label);
              position: absolute;
              left: 10px;
              font-weight: bold;
          }
      }
    </style>
    <title>Transactions</title>
</head>
<body>
    <main class="main">
        <!--==================== TRANSACTIONS ====================-->
        <section class="transactions">
            <h3 class="card__title">Transactions</h3>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_transactions->num_rows > 0) {
                        while ($row = $result_transactions->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['transaction_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                                <td><?php echo $row['book_id']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>₱<?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['transaction_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>No transactions found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
