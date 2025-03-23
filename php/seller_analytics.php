<?php
include("database.php");
session_start();

// Ensure user is logged in
if (!isset($_SESSION['student_id'])) {
    die("Error: Unauthorized access.");
}

$seller_id = $_SESSION['student_id'];

// Ensure database connection is valid
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch products
$query = "SELECT * FROM products WHERE user_id = '$seller_id'";
$result = mysqli_query($conn, $query);

// Check if query execution was successful
if (!$result) {
    die("Error retrieving products: " . mysqli_error($conn));
}

// Store products in an array
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Analytics</title>
    <link rel="stylesheet" href="../css/seller_sale_notification.css">
</head>
<body>
    <div class="container">
        <h1>Your Product Analytics</h1>

        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p>Views: <?php echo htmlspecialchars($product['views']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
