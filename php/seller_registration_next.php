<?php
   include("database.php"); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a seller</title>
    <link href="../css/seller_registration.css" rel="stylesheet">
</head>

<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a seller</title>
    <link href="../css/seller.css" rel="stylesheet">
</head>
<body style="background-image: url('../images/background.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">
<div class="container">

<header class="header">
    <div class="logo"><img src="../images/logo.png" alt="Logo"></div>
    <nav class="nav">
        <ul class="nav-list">
            <li><a class="nav-link" href="home.php">Home</a></li>
            <li><a class="nav-link" href="listing.php">All Products</a></li>
            <li><a class="nav-link" href="seller_registration.php">Become a Seller</a></li>
            <li><a class="nav-link cart-btn" href="view_cart.php"> 🛒 Cart (<?php echo $cart_count; ?>) </a></li>
        </ul>
    </nav>
</header>
<!--Text Contet-->
    <pre style="text-align:center; font-size: large; font-weight: bolder;">Welcome to mali-kwa mali seller program. Have furniture that you'd want to rehome? 
This is the place for you!<br></pre>
<!--form-->
<h2>Become a seller</h2>
<pre style="text-align:center;">
You are almost done! To ensure your saftey and those of other users, we need to verifty your identity
To verify your identity, we need an image of your student ID
</pre>
<form action="seller_registration_next.php" method="POST" enctype="multipart/form-data">
    <div class="input">
    <label>Upload a clear image of your School ID:</label>
    <input type="file" name="id_image" accept="image/*" required>
    <label>Upload a clear  image of your face:</label>
    <input type="file" name="face_image" accept="image/*" required>
    <button type="submit">Register as Seller</button>
    </div>
</form>
</body>
</html>
<?php
if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized access.";
    exit();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seller_id = $_SESSION['student_id'];
    $target_dir = "../verification/";
    $id_image_path = $target_dir . basename($_FILES["id_image"]["name"]);
    $face_image_path = $target_dir . basename($_FILES["face_image"]["name"]);

    move_uploaded_file($_FILES["id_image"]["tmp_name"], $id_image_path);
    move_uploaded_file($_FILES["face_image"]["tmp_name"], $face_image_path);

    // Update database
    $query = "UPDATE user_credentials SET is_seller = 'yes', WHERE student_id = '$seller_id'";
    if (mysqli_query($conn, $query)) {
        
        // Send email to admin for approval
        $admin_email = "andymakari58@gmail.com"; // Change this to your admin email
        $subject = "New Seller Verification Request";
        $message = "A user has requested seller access. Review their details:\n
                    Seller ID: $seller_id\n
                    Home Address: $home_address\n
                    ID Image: <a href='$id_image_path'>View ID</a>\n
                    Face Image: <a href='$face_image_path'>View Face Image</a>\n
                    Approve the user in the admin panel.";
        
        $headers = "From: noreply@example.com\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($admin_email, $subject, $message, $headers);

        echo "Registration submitted. An admin will review your details.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
}
?>