<?php
session_start();
require_once('database.php');
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (!isset($_GET['id'])) {
    echo "Product not found.";
    exit();
}
$product_id = intval($_GET['id']);

$query = "SELECT products.*, user_credentials.name as full_name, user_credentials.email FROM products
          INNER JOIN user_credentials ON products.user_id = user_credentials.student_id
          WHERE products.id = '$product_id'";

$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
$_SESSION['seller_id'] = $product['user_id'];
if (!$product) {
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="../css/product_details.css">
</head>
<body>
    <div id="logo">
        <img src="../images/logo.png" rel="logo">
    </div>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="seller_registration.php">Become a seller</a>
        <a href="seller.php">My account</a>
        <li><a href="view_cart.php" class="cart-btn">
            🛒 Cart (<?php echo $cart_count; ?>)
        </a></li>
        <a href="index.php" class="logout">Log out</a>
    </nav>

    <div class="product-container">
        <div class="product-image">
            <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <h2>Price: Ksh.<?php echo number_format($product['price'], 2); ?></h2>

            <div class="seller-info">
                <h3>Seller: <?php echo htmlspecialchars($product['full_name']); ?></h3>
                <a href="message_seller.php?seller_id=<?php echo $product['user_id']; ?>" class="btn">Message Seller</a>

            </div>

            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                <button type="submit" class="btn add-to-cart">Add to Cart</button>
                </form>
        </div>
    </div>
</body>
</html>
