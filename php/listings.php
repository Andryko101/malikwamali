<?php
   include("database.php"); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listings</title>
    <link  href="../css/listings.css" rel="stylesheet">
</head>
<body>
<div class="container">
        <header class="header">
            <div class="logo"><img src="../images/logo.png" alt="Logo"></div>
            <nav class="nav">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="listing.php">All Products</a></li>
                    <li><a href="seller_registration.php">Become a Seller</a></li>
                    <li><a href="buyer_account.php">My account</a></li>
                    <li><a href="view_cart.php" class="cart-btn">
            🛒 Cart (<?php echo $cart_count; ?>)
        </a></li>
        <li><a href="index.php">Log Out</a></li>
                </ul>
            </nav>
        </header>


        <div class="listing">
            <h1>Available Products</h1>
            <div class="product-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                    <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>"
                    style="max-width: 200px; max-height: 150px;">
                        <h2><?php echo $row['name']; ?></h2>
                        <p class="category"><?php echo ucfirst($row['category']); ?></p>
                        <p class="price">Ksh.<?php echo number_format($row['price'], 2); ?></p>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
