<?php
session_start();
include 'database.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

$seller_query = "SELECT seller FROM user_credentials WHERE student_id = '$user_id'";
$seller_result = mysqli_query($conn, $seller_query);
$seller_row = mysqli_fetch_assoc($seller_result);
$is_seller = ($seller_row && $seller_row['seller'] === 'yes');

if ($is_seller) {
    $query = "SELECT orders.id AS order_id, orders.created_at, 
                     order_items.product_name, order_items.product_price, 
                     user_credentials.username AS buyer_username
              FROM orders
              INNER JOIN order_items ON orders.id = order_items.order_id
              INNER JOIN user_credentials ON orders.user_id = user_credentials.id
              WHERE orders.user_id = '$user_id'
              ORDER BY orders.created_at DESC";
} else {
    $query = "SELECT orders.id AS order_id, orders.created_at, 
                     order_items.product_name, order_items.product_price
              FROM orders
              INNER JOIN order_items ON orders.id = order_items.order_id
              WHERE orders.user_id = '$user_id'
              ORDER BY orders.created_at DESC";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>My Orders / Sales History</h1>

    <?php if (count($orders) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                    <?php if ($is_seller): ?>
                        <th>Buyer Username</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        <?php if ($is_seller): ?>
                            <td><?php echo htmlspecialchars($order['buyer_username']); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>

</body>
</html>
