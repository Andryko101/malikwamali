<?php
session_start();
include('database.php');
$_SESSION['seller_id'];
if(!isset($_SESSION['student_id']) || !isset($_GET['seller_id'])) {
    echo "Access denied.";
    exit();
}

$buyer_id = $_SESSION['student_id']; 
$seller_id = intval($_GET['seller_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES ('$buyer_id', '$seller_id', '$message')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Message sent successfully!'); window.location.href='listings.php'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Seller</title>
    <link rel="stylesheet" href="../css/message_seller.css">
    <style>
    body{
    background: url('../images/background.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Send a Message to the Seller</h1>
        <form action="message_seller.php?seller_id=<?php echo $seller_id; ?>" method="POST">
            <textarea name="message" required placeholder="Enter your message"></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</body>
</html>
