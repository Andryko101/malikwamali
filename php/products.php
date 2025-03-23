<?php
   include("database.php"); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_GET['category'])) {
    $category = $conn->real_escape_string($_GET['category']);

    // Fetch products matching the selected category
    $query = "SELECT * FROM products WHERE category = '$category'";
    $result = $conn->query($query);
} else {
    echo "<script>alert('Invalid category!'); window.location.href='listing.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(htmlspecialchars($category)); ?> - Products</title>
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo"><img src="../images/logo.png" alt="Logo"></div>
            <nav class="nav">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="listings.php">All Products</a></li>
                    <li><a href="buyer_account.php">My account</a></li>
                    <li><a href="seller_registration.php">Become a Seller</a></li>
                    <li><a href="view_cart.php" class="cart-btn">
            🛒 Cart (<?php echo $cart_count; ?>)
        </a></li>
                </ul>
            </nav>
        </header>

        <h1 class="category-title">Category: <?php echo ucfirst(htmlspecialchars($category)); ?></h1>

        <div class="product-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <a href="product_details.php?id=<?php echo $product['id']; ?>">
                            <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p class="price">Ksh.<?php echo number_format($product['price'], 2); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-products">No products found in this category.</p>
            <?php endif; ?>
        </div>

        <footer class="footer">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
