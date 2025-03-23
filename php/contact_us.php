<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $admin_email = "andrewmakari88@gmail.com";

    $subject = "New Contact Message from " . $name;
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8";

    $body = "<h2>New Contact Message</h2>";
    $body .= "<p><strong>Name:</strong> $name</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Message:</strong><br>$message</p>";

    if (mail($admin_email, $subject, $body, $headers)) {
        $success_message = "Thank you for reaching out! We will get back to you shortly.";
    } else {
        $error_message = "Sorry, something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact_us.css">
</head>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>

        <?php
        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        }
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>

        <form action="contact_us.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" name="name" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="message">Message</label>
            <textarea name="message" rows="6" required></textarea>

            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
session_destroy();
header("Location: home.php"); 
exit();
}
?>