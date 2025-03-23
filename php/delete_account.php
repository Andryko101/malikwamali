<?php
session_start();
include 'database.php'; // Ensure correct database connection

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    // Verify password
    $query = "SELECT password FROM user_credentials WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (password_verify($password, $hashed_password)) {
        // Start transaction to ensure safe deletion
        mysqli_begin_transaction($conn);

        try {
            // Debug: Display user_id
            echo "Deleting user: $user_id <br>";

            // 1. Delete from `sales`
            $delete_sales = "DELETE FROM sales WHERE order_id IN (SELECT id FROM orders WHERE user_id = ?)";
            $stmt = mysqli_prepare($conn, $delete_sales);
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error deleting sales: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
            echo "Deleted sales <br>";

            // 2. Delete from `order_items`
            $delete_order_items = "DELETE FROM order_items WHERE order_id IN (SELECT id FROM orders WHERE user_id = ?)";
            $stmt = mysqli_prepare($conn, $delete_order_items);
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error deleting order items: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
            echo "Deleted order items <br>";

            // 3. Delete from `orders`
            $delete_orders = "DELETE FROM orders WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $delete_orders);
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error deleting orders: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
            echo "Deleted orders <br>";

            // 4. Delete user account
            $delete_user = "DELETE FROM user_credentials WHERE student_id = ?";
            $stmt = mysqli_prepare($conn, $delete_user);
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error deleting user account: " . mysqli_error($conn));
            }
            mysqli_stmt_close($stmt);
            echo "Deleted user account <br>";

            // Commit transaction if everything is successful
            mysqli_commit($conn);

            // Destroy session and redirect
            session_destroy();
            header("Location: index.php?message=Account Deleted Successfully");
            exit();
        } catch (Exception $e) {
            mysqli_rollback($conn); // Rollback transaction on error
            echo "Failed: " . $e->getMessage(); // Display exact error message
        }
    } else {
        echo "Incorrect password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; margin-top: 20px; }
        input { padding: 8px; margin: 5px; }
        button { padding: 8px 12px; background: red; color: white; border: none; cursor: pointer; }
        button:hover { background: darkred; }
    </style>
</head>
<body>

    <h1>Delete Your Account</h1>
    <p>Warning: This action is irreversible. All your orders and data will be permanently deleted.</p>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post">
        <label>Enter your password to confirm:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Delete Account</button>
    </form>

</body>
</html>
