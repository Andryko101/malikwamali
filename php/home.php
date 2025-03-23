<<<<<<< HEAD
=======
<?php
   include("database.php"); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $_SESSION['student_id']; 
    if (!isset($_SESSION['student_id'])) {
        header("Location: index.php");
        exit();
    }
?>
>>>>>>> 811d51f (PHP files for malikwamali)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Homepage</title>
</head>
<body>
    <p onclick="redirectfun()">Welcome to mali-kwa-mali</p>    
</body>
<script type="text/javascript">
    function redirectfun(){
        window.location.href="categories.php";
    }
</script>
</html>
=======
    <title>Dedan Deals | Home</title>
    <link href="../css/homepage.css" rel="stylesheet">
</head>
<body style="background-image:url('../images/background.jpg'); background-size: cover; background-position: center;">
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="../images/logo.png" alt="Dedan Deals Logo">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="categories.php">Shop Now</a></li>
                    <li><a href="seller_registration.php">Become a seller</a></li>
                    <li><a href="buyer_account.php">My account</a></li>
                    <li><a href="view_cart.php" class="cart-btn">
                     🛒 Cart (<?php echo $cart_count; ?>)
                    </a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                    <li><a href="index.php">Log out</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1>Welcome to Mali kwa Mali</h1>
            <p>Your trusted destination for premium kitchen and study tables, cozy sofas, and more. Affordable home essentials just for you!</p>
            <a href="categories.php" class="btn">Start Shopping &#8594;</a>
        </div>
    </section>
    
    <section class="features">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <h3>🎓 Student-Friendly Prices</h3>
                    <p>Get amazing discounts and deals on furniture perfect for student living.</p>
                </div>
                <div class="feature-item">
                    <h3>🛋️ Wide Range of Products</h3>
                    <p>From study tables to cozy sofas, discover everything you need for your home.</p>
                </div>
                <div class="feature-item">
                    <h3>✅ Top Quality</h3>
                    <p>Only the best materials and craftsmanship for long-lasting furniture.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Mali kwa Mali. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
>>>>>>> 811d51f (PHP files for malikwamali)
