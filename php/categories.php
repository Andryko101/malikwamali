<<<<<<< HEAD
=======
<?php
   include("database.php"); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

// Fetch categories from the database
$categoryQuery = "SELECT DISTINCT category FROM products ORDER BY category ASC";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Fetch latest products
$productQuery = "SELECT id, name, image, price, description, category FROM products ORDER BY created_at DESC LIMIT 8";
$productResult = mysqli_query($conn, $productQuery);
?>

>>>>>>> 811d51f (PHP files for malikwamali)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Document</title>
    <link href="../css/home.css" rel="stylesheet">
</head>
<div id="logo"><img src="../images/logo.png" rel="logo"></div>
<body style="background-image: url('../images/background.jpeg'); background-attachment: 
fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">
    <h2>Welcome to mali-kwa-mali</h2>
    <nav class="navbar">
        <a href="home.php">home</a>
        <a href="become_seller.php">Become a seller</a>
        <a href="">about</a>
        <a href="seller.php">My account</a>
        <a href="login.php" style="display:inline; justify-content: right;  ">Log out</a>
    </nav>
    <!--Displaying products-->
    <div class="content">
    <div class="image" onclick="redirectfun()"><img class="img" src="../images/chair1.jpeg" alt="object"><div>Chair</div></div>
    <div class="image"><img class="img" src="../images/chair1.jpeg" alt="object"><div>Casual Chairs</div></div>
    <div class="image"><img class="img" src="../images/chair2.jpeg" alt="object"><div>Office Chairs</div></div>
    <div class="image"><img class="img" src="../images/table.jpeg" alt="object"><div>Table</div></div>
    <div class="image"><img class="img" src="../images/studyDesk.jpeg" alt="object"><div>Study desk</div></div>
</div>
</body>
<script type="text/javascript">
    function redirectfun(){
        window.location.href="login.php";
    }
</script>
</html>
=======
    <title>Categories - Mali-Kwa-Mali</title>
    <link href="../css/categories.css" rel="stylesheet">
</head>
<body style="background-image: url('../images/background.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">

    <div id="logo">
        <img src="../images/logo.png" rel="logo">
    </div>

    <h2 style="text-align: center;">Explore Our Categories</h2>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="listings.php">All products</a>
        <a href="seller_registration.php">Become a seller</a>
        <a href="buyer_account.php">My account</a>
        <li><a href="view_cart.php" class="cart-btn">
            🛒 Cart (<?php echo $cart_count; ?>)
        </a></li>
        <a href="index.php" class="logout">Log out</a>
    </nav>

    <!-- Categories Section -->
    <h2 class="section-title">Product Categories</h2>
    <div class="categories">
        <?php while ($row = mysqli_fetch_assoc($categoryResult)) { ?>
            <div class="category">
                <a href="products.php?category=<?php echo urlencode($row['category']); ?>">
                    <img src="../images/<?php echo strtolower(str_replace(' ', '_', $row['category'])); ?>.jpeg" alt="<?php echo htmlspecialchars($row['category']); ?>">
                    <p><?php echo htmlspecialchars($row['category']); ?></p>
                </a>
            </div>
        <?php } ?>
    </div>

    <!-- Latest Products -->
    <h2 class="section-title">Latest Arrivals</h2>
    <div class="products">
        <?php while ($row = mysqli_fetch_assoc($productResult)) { ?>
            <div class="product">
                <span class="stock">New</span>
                <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($rpw['name']); ?>">
                <h3>Ksh.<?php echo $row['price']; ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <script type="text/javascript">
        function redirectfun(){
            window.location.href="login.php";
        }
    </script>

</body>
</html>

<?php mysqli_close($conn); ?>
>>>>>>> 811d51f (PHP files for malikwamali)
