<?php
session_start();
include 'database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: home.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $query = "UPDATE user_credentials SET status='blocked' WHERE id = '$user_id'";

    if (mysqli_query($conn, $query)) {
        echo "User blocked successfully.";
    } else {
        echo "Error blocking user.";
    }
}

header("Location: admin_dashboard.php");
?>