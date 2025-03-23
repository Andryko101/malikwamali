<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]); // Remove item
            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
}

header("Location: view_cart.php");
exit();
?>
