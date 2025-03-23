<?php
session_start();
include 'database.php'; // Include database connection

// Ensure admin is logged in
if (!isset($_SESSION['is_admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get seller ID from URL
if (!isset($_SESSION['seller']) || empty($_SESSION['seller'])) {
    echo "No seller specified.";
    exit();
}

$seller_id = intval($_SESSION['seller']);

$sql = "SELECT username, email FROM user_credentials WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $seller_id);
$stmt->execute();
$sellerResult = $stmt->get_result();
$seller = $sellerResult->fetch_assoc();

if (!$seller) {
    echo "Seller not found.";
    exit();
}

// Fetch products listed by the seller
$productQuery = $conn->prepare("SELECT id, product_name, product_price FROM products WHERE seller_id = ?");
$productQuery->bind_param("i", $seller_id);
$productQuery->execute();
$productResult = $productQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Products</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <h1>Products Listed by <?php echo htmlspecialchars($seller['username']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($seller['email']); ?></p>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $productResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                        <td>
                            <a href="delete_product.php?product_id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>
