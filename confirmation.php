<?php
include 'db.php';
session_start();

if (!isset($_GET['transaction_id'])) {
    header("Location: dashboard.php");
    exit();
}

$transaction_id = (int)$_GET['transaction_id'];
$query = "SELECT * FROM `transactions` WHERE `transaction_id` = $transaction_id LIMIT 1";
$result = $conn->query($query);
$transaction = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Confirmation</title>
</head>
<body>
    <div class="container">
        <h1>Transaction Confirmation</h1>
        <?php if ($transaction): ?>
            <p>Thank you, <?php echo htmlspecialchars($transaction['customer_name']); ?>!</p>
            <p>Your transaction ID is <?php echo $transaction['transaction_id']; ?>.</p>
            <p>Total Price: ₱<?php echo htmlspecialchars($transaction['total_price']); ?></p>
        <?php else: ?>
            <p>Transaction not found.</p>
        <?php endif; ?>
        <a href="dashboard.php">Return to Dashboard</a>
    </div>
</body>
</html>
