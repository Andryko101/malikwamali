<?php
session_start();
include 'db_connect.php'; 

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['product_id'])) {
    echo "Product ID missing.";
    exit();
}

$product_id = $_GET['product_id'];

// Delete product
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    echo "Product deleted successfully.";
} else {
    echo "Error deleting product.";
}

header("Location: admin_dashboard.php");
exit();
?>