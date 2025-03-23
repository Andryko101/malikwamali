<?php
session_start();
include ('database.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: view_cart.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
    $student_id = $_SESSION['student_id'];

    $sql="SELECT id FROM user_credentials WHERE student_id=$student_id";
    $result=mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = (int) $row['id'];
    } else {
        die("Error: User ID not found.");
    }

    $query = "INSERT INTO orders (user_id, customer_name, customer_email, customer_address) 
              VALUES ('$user_id', '$customer_name', '$customer_email', '$customer_address')";
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);
        $_SESSION['order_id'] = $order_id; 

        foreach ($_SESSION['cart'] as $item) {
            $product_id = (int) $item['id'];
            $product_name = mysqli_real_escape_string($conn, $item['name']);
            $product_price = (float) $item['price'];

            mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, product_name, product_price) 
                                 VALUES ('$order_id', '$product_id', '$product_name', '$product_price')");
        }

        $_SESSION['cart'] = [];
        header("Location: order_success.php?product_id=$product_id&product_name=$product_name&amount=$product_price");
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <form action="checkout.php" method="POST">
            <label for="customer_name">Full Name</label>
            <input type="text" name="customer_name" required>

            <label for="customer_email">Email</label>
            <input type="email" name="customer_email" required>

            <label for="customer_address">Shipping Address</label>
            <textarea name="customer_address" required></textarea>

            <h3>Order Summary</h3>
            <ul class="order-summary">
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $total += $item['price'];
                ?>
                    <li><?php echo htmlspecialchars($item['name']) . " - Ksh." . number_format($item['price'], 2); ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Total: Ksh.<?php echo number_format($total, 2); ?></h3>
            <button type="submit" class="checkout-btn">Place Order</button>
        </form>
    </div>
</body>
</html>
