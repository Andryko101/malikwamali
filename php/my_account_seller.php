<?php
session_start();
include 'database.php';
$_SESSION['student_id'];
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['student_id'];
$query = "SELECT * FROM user_credentials WHERE student_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$seller = ($user['seller'] == 'yes');

$sales_query = "SELECT COUNT(*) as total_sales, SUM(sale_amount) as total_revenue FROM sales WHERE seller_id = '$user_id'";
$sales_result = mysqli_query($conn, $sales_query);
$sales = mysqli_fetch_assoc($sales_result);

$products_query = "SELECT * FROM products WHERE user_id = '$user_id'";
$products_result = mysqli_query($conn, $products_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>My Account</h1>
        </header>

        <div class="profile">
            <h2><?php echo $user['name']; ?></h2>
            <p>Email: <?php echo $user['email']; ?></p>
        </div>

        <div class="account-options">
            <h3>My Orders</h3>
            <a href="order_history.php">View Purchase History</a>
            <?php
            $sql="SELECT seller FROM user_credentials where student_id=$user_id";
            $seller=mysqli_query($conn, $sql);
            ?>

            <?php if ($seller): ?>
                <h3>Seller Dashboard</h3>
                <a href="seller_dashboard.php">Manage My Products</a>
                <a href="seller_sales_notifications.php">View Sales Notifications</a>
                <a href="seller_analytics.php">View Sales Analytics</a>
                <a href="delete_account.php" class="danger">Delete Account</a>
            <?php endif; ?>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
