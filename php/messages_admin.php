<?php
session_start();
include 'database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_id = intval($_POST['receiver_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (0, '$receiver_id', '$message')";
    mysqli_query($conn, $query);

    echo "Message sent successfully.";
}

if (isset($_GET['id'])) {
    $receiver_id = intval($_GET['id']);
    echo "<form method='post' action='message_user.php'>
        <input type='hidden' name='receiver_id' value='$receiver_id'>
        <textarea name='message' required></textarea>
        <button type='submit'>Send</button>
    </form>";
}
?>