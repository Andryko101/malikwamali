<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body style="background-image:url('../images/background.jpeg');
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
        <a id="signup" href="login.php">Have an account already? Login</a>
</div>
    </form>
    <?php
    include("database.php");

    
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpass=$_POST['confirmpassword'];

    if(isset($_POST['submit'])){
    if($password==$confirmpass){
        $hash= password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO UserCredentials (username, email, password)
        VALUES ('$username','$email','$hash')";
        mysqli_query($conn, $sql);
        echo '<script>alert("Account created successfully")</script>';
        echo '<script type="text/javascript">
        window.location.href = "http://localhost/mali-kwa-mali/php/home.php";
        </script>';
    }else{
        echo '<script>alert("Password does not match")</script>';
    }};
    

    mysqli_close($conn);
?>
</body>
</html>
