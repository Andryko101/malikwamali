<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link href="../css/seller_dashboard.css" rel="stylesheet">
    <style>body{
    background-image: url('../images/background.jpg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    }</style>
</head>
<body>

    <!-- Banner Section -->
    <div class="banner">
        <img src="../images/logo.png" alt="Mali-Kwa Mali Logo" class="logo" width="300px" height="100px">
        <h1>Welcome to Your Seller Dashboard</h1>
        <a href="index.php" class="logout-btn">🚪 Logout</a>
    </div>

    <div class="container">
        <h2 style="text-align: center;">Quick Access</h2>
        <div class="dashboard-links">
            <a href="product_upload.php" class="dashboard-btn">📊 Upload a Product</a>
            <a href="seller_analytics.php" class="dashboard-btn">📊 Product Analytics</a>
            <a href="seller_messages.php" class="dashboard-btn">📩 View Messages</a>
            <a href="seller_sales_notifications.php" class="dashboard-btn">📢 Sales Notifications</a>
        </div>
    </div>

</body>
</html>
