<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php
        session_start();
    ?>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body style="background-image:url('../images/background.jpeg');
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;">
    <div id="error_message"></div>
    <form action="login.php" method="post">
    <h2>Login</h2>
    <label>Welcome to Mali kwa Mali. To continue please login</label><br><hr>
        <input class="input username" type="text-field" name="username" placeholder="Enter Username" required><br>
        <input class="input password"  type="password" name="password" placeholder="Enter Password" required><br><hr>
        <input class="input login" type="submit" name="submit" value="Login"><br>
        <a href="signup.php">Don't have an account? Create account</a>
    </form>
</body>
<?php
    include("database.php");
    if(isset($_POST['submit'])){

    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT username, password FROM UserCredentials WHERE username='$username'";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
           echo '<script type="text/javascript">
            window.location.href = "http://localhost/mali-kwa-mali/php/home.php";
            </script>';
    }else{
        echo '<script type="text/javascript">
                    let error_message="Wrong email or password!";
                    document.getElementById("error_message").innerHTML=error_message;
             </script> <br>';
    }}else{
        echo '<script type="text/javascript">
                    let error_message="Wrong email or password!";
                    document.getElementById("error_message").innerHTML=error_message;
             </script> <br>';
    }
    }
    mysqli_close($conn);
?>
</html>