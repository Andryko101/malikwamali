<?php
session_start();
include("database.php");

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    die("Unauthorized access. Please log in first.");
}

$seller_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

$query = "SELECT sales.product_id, sales.sale_amount, sales.sale_date, products.name AS product_name
          FROM sales 
          JOIN products ON sales.product_id = products.id 
          WHERE products.user_id = '$seller_id'
          ORDER BY sales.sale_date DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Notifications</title>
    <link rel="stylesheet" href="../css/seller_sale_notification.css">
</head>
<body>
    <header class="banner">
        <h1>Mali-Kwa-Mali Sales Dashboard</h1>
    </header>

    <div class="container">
        <h2>Your Recent Sales</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="sale-notification">
                    <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p>Sold for <strong>$<?php echo htmlspecialchars($row['amount']); ?></strong></p>
                    <p class="date">On: <?php echo date("F j, Y, g:i A", strtotime($row['sale_date'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-sales">No recent sales notifications.</p>
        <?php endif; ?>
    </div>
</body>
</html>
