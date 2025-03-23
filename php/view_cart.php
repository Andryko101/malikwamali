<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
    <div class="cart-container">
        <h1>Your Shopping Cart</h1>
        <img id="logo" src="../images/logo.png" alt="logo">
        <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="categories.php">continue Shopping</a>
        <a href="become_seller.php">Become a seller</a>
        <a href="buyer_account.php">My account</a>
        <a href="index.php" class="logout">Log out</a>
    </nav>

        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $key => $item): 
                        $total += $item['price'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>Ksh.<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Total: Ksh.<?php echo number_format($total, 2); ?></h3>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
