<?php
include("database.php"); 
session_start();
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
//Get the product ID from the session or query string
$product_id = $_GET['product_id'];

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

// If the product doesn't exist, redirect to the seller page
if (!$product) {
    header('Location: seller_page.php');
    exit();
}

// Handle confirmation or cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm'])) {
        // Confirm the product and add it to the listings (you might already have done that in the form)
        // For now, just a simple message (you can later update the status of the product to 'active' or 'published')
        echo "<script>alert('Product successfully listed!'); window.location='listings.php';</script>";
    } elseif (isset($_POST['cancel'])) {
        // Delete the product from the database if user cancels
        $delete_query = "DELETE FROM products WHERE id = $product_id";
        $conn->query($delete_query);
        echo "<script>alert('Product removed from the database!'); window.location='seller_page.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Confirmation</title>
    <link rel="stylesheet" href="../css/product_upload_confirmation.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <img src="../images/logo.png" alt="Logo">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="view_cart.php" class="cart-btn">
            🛒 Cart (<?php echo $cart_count; ?>)
        </a></li>
                </ul>
            </nav>
        </header>

        <div class="product-preview">
            <h1>Product Upload Confirmation</h1>
            <p>Thank you for uploading your product. Please review the details below:</p>

            <div class="product-details">
                <div class="product-image">
                    <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">

                </div>
                <div class="product-info">
                    <h2>Product Name: <span><?php echo htmlspecialchars($product['name']); ?></span></h2>
                    <p><strong>Description:</strong> <span><?php echo htmlspecialchars($product['description']); ?></span></p>
                    <p><strong>Price:</strong> <span><?php echo "Ksh" . number_format($product['price'], 2); ?></span></p>
                </div>
            </div>

            <form method="POST">
                <div class="buttons">
                    <button type="submit" name="cancel" class="cancel-button">Cancel Upload</button>
                    <button type="submit" name="confirm" class="confirm-button">Confirm Listing</button>
                </div>
            </form>
        </div>

        <footer class="footer">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
