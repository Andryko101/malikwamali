<?php
session_start();
include 'database.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: home.php");
    exit();
}
$sql = "SELECT seller FROM user_credentials WHERE seller='yes'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['seller'] = $row['seller'] ?? null; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css"> <!-- Link to CSS -->
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="index.php" class="logout">Logout</a>
    <h2>All Registered Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        $query = "SELECT id, username, email, status FROM user_credentials";
        $result = mysqli_query($conn, $query);

        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$user['id']}</td>
                <td>{$user['username']}</td>
                <td>{$user['email']}</td>
                <td>{$user['status']}</td>
                <td>";

            if ($user['status'] == 'blocked') {
                echo "<a href='unblock_user.php?id={$user['id']}' class='unblock'>Unblock</a> ";
            } else {
                echo "<a href='block_user.php?id={$user['id']}' class='block'>Block</a> ";
            }

            echo "<a href='admin_viewproducts.php?id={$user['id']}' class='delete'>Products</a> 
                  <a href='delete_user_admin.php?id={$user['id']}' class='delete'>Delete</a> 
                  <a href='messages_admin.php?id={$user['id']}' class='message'>Message</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>