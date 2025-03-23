<?php
session_start();
$_SESSION['seller_id'];
$_SESSION['order_id'];
include('database.php');

if (!isset($_SESSION['student_id'])) {
    die("Access denied: User not logged in.");
}
if (!isset($_SESSION['order_id'])) {
    die("Error: Missing order details.");
}

$seller_id = $_SESSION['seller_id']; 
$order_id = $_SESSION['order_id'];
$product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
$product_id = (int) $_GET['product_id'];
$amount = (float) $_GET['amount'];

$query = "INSERT INTO sales (product_id, seller_id, order_id, sale_amount) VALUES ($product_id, $seller_id, $order_id, $amount)";
if (!mysqli_query($conn, $query)) {
    die("Database Error: " . mysqli_error($conn));
}

$seller_query = "SELECT products.user_id, user_credentials.email FROM products  INNER JOIN user_credentials on products.user_id=user_credentials.student_id  WHERE products.id = $product_id";
$seller_result = mysqli_query($conn, $seller_query);
$seller = mysqli_fetch_assoc($seller_result);

if (!$seller) {
    die("Error: Seller not found for product ID $product_id.");
}
$buyer_id=$_SESSION['student_id'];
$subject = "Your Product has been Sold!";
$message = "Hello, your product '$product_name' (ID: $product_id) has been sold to buyer $buyer_id. The total sale amount is Ksh.$amount.";
$headers = "From: no-reply@yourwebsite.com";

mail($seller['email'], $subject, $message, $headers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <div class="success-container">
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <a href="home.php" class="home-btn">Return to Home</a>
    </div>
</body>
</html>