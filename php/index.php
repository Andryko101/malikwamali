<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php session_start(); ?>
    <link href="../css/login.css" rel="stylesheet">
</head>
<body>
    <div id="error_message"></div>
    <main class="content form-container">
    <form class="form" action="index.php" method="post">
        <h2 class="form-title">Login</h2>
        <label class="form-label">Welcome to Mali kwa Mali. To continue, please log in</label>
        <hr class="form-divider">
        <input class="input-field" type="text" name="username" placeholder="Enter Username" required>
        <input class="input-field" type="password" name="password" placeholder="Enter Password" required>
        <select name="role" class="input-field">
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>
        <hr class="form-divider">
        <input class="submit-btn" type="submit" name="submit" value="Login">
        <a class="form-link" href="signup.php">Don't have an account? Create account</a>
    </form>
</main>



    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Mali kwa Mali. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = $_POST['role'];

    // ✅ Fixed SQL query
    $sql = "SELECT username, password, student_id, seller FROM user_credentials WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // ✅ Check if password is correct
        if (password_verify($password, $row['password'])) {
            $_SESSION['student_id'] = $row['student_id']; // ✅ Set session variable

            // ✅ Redirect based on role
            if ($role == 'seller' && $row['seller'] == 'yes') {
                header("Location: seller_dashboard.php");
                exit();
            } elseif ($role == 'buyer') {
                header("Location: home.php");
                exit();
            } else {
                echo '<script>alert("You are not registered as a seller. Please register first.");</script>';
            }
        } else {
            echo '<script>alert("Wrong password or username.");</script>';
        }
    } else {
        echo '<script>alert("Wrong password or username.");</script>';
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = $_POST['role'];
    if ($username == "admin123" && $password == "admin123") {
        $_SESSION['username'] = "Super Admin";
        $_SESSION['is_admin'] = true;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    }
}
mysqli_close($conn);
?>

</html>