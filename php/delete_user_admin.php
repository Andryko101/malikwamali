<?php
session_start();
include 'database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: home.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Delete user's products first (to avoid foreign key constraint issues)
    mysqli_query($conn, "DELETE FROM order_items WHERE order_id IN (SELECT id FROM orders WHERE user_id = '$user_id')");
    mysqli_query($conn, "DELETE FROM orders WHERE user_id = '$user_id'");

    // Delete user
    $query = "DELETE FROM user_credentials WHERE id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
}

header("Location: admin_dashboard.php");
?>