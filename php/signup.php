<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="../css/signup.css" rel="stylesheet">
</head>
<body style="background-image:url('../images/background.jpg');
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;">
    <form action="signup.php" method="post"><h2>Sign Up</h2>
    <div>Welcome to Mali kwa Mali. Create your account</div><br>
        <div>
        <input class="input username" type="text-field" name="username" placeholder="Enter Username" required><br>
        <input class="input email" type="text-field" name="email" placeholder="Enter Email" required><br>
        <input class="input password" type="password" name="password" placeholder="Enter Password" required><br>
        <input class="input password" type="password" name="confirmpassword" placeholder="confirm Password" required><br>
        <input class="input login"type="submit" name="submit" value="Sign Up"><br>
        <a id="signup" href="index.php">Have an account already? Login</a>
</div>
    </form>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Mali kwa Mali. All Rights Reserved.</p>
        </div>
    </footer>
    <?php
    include("database.php");

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $username=$_POST['username'];
        $id=$_POST['id'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmpass=$_POST['confirmpassword'];

    $checkUsernameQuery = "SELECT username FROM user_credentials WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsernameQuery);
    $row1 = mysqli_fetch_row($result);

    $checkstudentIDQuery = "SELECT student_id FROM user_credentials WHERE student_id = '$id'";
    $result = mysqli_query($conn, $checkstudentIDQuery);
    $row2 = mysqli_fetch_row($result);

    if ($row2 > 0) {
        echo '<script>alert("Seems your student ID has already been registered.")</script>';
    } else{
    if ($row1 > 0) {
        echo '<script>alert("Username already taken, please choose a different one.")</script>';
    } else{
    if($password==$confirmpass){
        $hash= password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_credentials (name, username, student_id, email, password)
        VALUES ('$name','$username','$id','$email','$hash')";
        mysqli_query($conn, $sql);
        echo '<script>alert("Account created successfully")</script>';
        header("Location: home.php");
    }else{
        echo '<script>alert("Password does not match")</script>';
    }}}};
    mysqli_close($conn);
?>
</body>
</html>
