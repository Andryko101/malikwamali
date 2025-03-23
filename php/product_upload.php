<?php
session_start();
include 'database.php'; // Ensure you have your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_description = $_POST['description'];
    $product_category = $_POST['category'];
    $user_id = $_SESSION['student_id']; // Assuming the user is logged in

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $image_tmp_name = $_FILES['product_image']['tmp_name'];
        $image_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

        // Generate a unique name (e.g., chair_6538dbe7d1.jpg)
        $image_new_name = strtolower(str_replace(' ', '_', $product_name)) . '_' . uniqid() . '.' . $image_extension;
        $upload_path = "../uploads/" . $image_new_name;

        if (move_uploaded_file($image_tmp_name, $upload_path)) {
            $product_unique_name = strtolower(str_replace(' ', '_', $product_name)) . '_' . uniqid();
            $query = "INSERT INTO products (user_id, name, unique_name, price, description, category, image) 
                      VALUES ('$user_id', '$product_name', '$product_unique_name', '$product_price','$product_description', '$product_category', '$image_new_name')";
            
            if (mysqli_query($conn, $query)) {
                echo '<script type="text/javascript">alert("Product uploaded successfully!")</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image selected or upload error.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page</title>
    <link rel="stylesheet" href="../css/product_upload.css">
    <style>body{
    background-image: url('../images/background.jpg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    }</style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <img src="../images/logo.png" alt="Logo">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="my_products.php">My Products</a></li>
                    <li><a href="my_account_seller.php">My Account</a></li>
                    <li><a href="categories.php">Shop Now</a></li>
                    <li><a href="index.php">Log Out</a></li>
                </ul>
            </nav>
        </header>

        <div class="seller-form">
            <h1>Sell Your Product</h1>
            <p>Fill in the details below to list your product for sale.</p>

            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <label for="price">Price (Ksh)</label>
                <input type="number" name="price" id="price" step="100" required>

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Select Category</option>
                    <option value="kitchen_table">Kitchen table</option>
                    <option value="study_desk">Study desk</option>
                    <option value="chair">Chair</option>
                    <option value="sofa">Sofa</option>
                    <option value="bed">Bed</option>
                    <option value="cooker">Cooker</option>
                    <option value="electronics">Electronics</option>
                    <option value="other">Other</option>
                </select>

                <label for="image">Product Image</label>
                <input type="file" name="product_image" id="image" accept="image/*" required>

                <button type="submit">Upload Product</button>
            </form>
        </div>

        <footer class="footer">
            <p>&copy; 2025 Dedan Deals. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
