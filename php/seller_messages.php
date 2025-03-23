<?php
session_start();
include("database.php");

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    die("Unauthorized access. Please log in first.");
}

// Get seller ID securely
$seller_id = mysqli_real_escape_string($conn, $_SESSION['student_id']);

// Fetch messages for the seller
$query = "SELECT * FROM messages WHERE receiver_id = '$seller_id' ORDER BY timestamp DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="../css/seller_sale_notification.css">
</head>
<body>
    <div class="container">
        <h1>Messages from Customers</h1>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
            // Fetch sender name
            $sender_id = mysqli_real_escape_string($conn, $row['sender_id']);
            $sender_query = "SELECT name FROM user_credentials WHERE id = '$sender_id'";
            $sender_result = mysqli_query($conn, $sender_query);

            if ($sender_result && mysqli_num_rows($sender_result) > 0) {
                $sender = mysqli_fetch_assoc($sender_result);
                $sender_name = $sender['name'];
            } else {
                $sender_name = "Unknown Sender";
            }
            ?>

            <div class="message">
                <strong><?php echo htmlspecialchars($sender_name); ?></strong>: 
                <?php echo htmlspecialchars($row['message_text']); ?>
                <p><em><?php echo $row['timestamp']; ?></em></p>
            </div>
        <?php endwhile; ?>

    </div>
</body>
</html>
