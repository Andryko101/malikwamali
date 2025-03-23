<?php
session_start();
include 'database.php';

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

// Fetch user details
$query = "SELECT * FROM user_credentials WHERE student_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Fetch order history
$order_query = "SELECT orders.id, orders.created_at, 
                       order_items.product_name, order_items.product_price 
                FROM orders 
                INNER JOIN order_items ON orders.id = order_items.order_id 
                WHERE orders.user_id = ?
                ORDER BY orders.created_at DESC";
$stmt = mysqli_prepare($conn, $order_query);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$order_result = mysqli_stmt_get_result($stmt);
$orders = mysqli_fetch_all($order_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            text-align: center;
            padding-left: auto;
            padding-right: auto;
            max-width: 800px;
            margin: auto;
        }
        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .home-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body style="background-image:url('../images/background.jpg'); background-size: cover; background-position: center;">

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?></h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Account Type: Buyer</p>
    <a href="delete_account.php" class="delete-btn">Delete Account</a><br>
    <a href="home.php" class="home-btn">Home</a><br>
    <a href="logout.php" class="logout-btn">Logout</a>

    <h3>My Orders</h3>
    <?php if (count($orders) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_price']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>
</div>

</body>
</html>
