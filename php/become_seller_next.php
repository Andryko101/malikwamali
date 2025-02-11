<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a seller</title>
    <link href="../css/seller.css" rel="stylesheet">
</head>
<?php
   include("database.php"); 
   session_start();
?>
<body>
<!--Background and content-->
    <div id="logo"><img src="../images/logo.png" rel="logo"></div>
    <body style="background-image: url('../images/background.jpeg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;">
<!--Navigation Bar-->
    <nav class="navbar">
        <a href="home.php">home</a>
        <a href="become_seller.php">Become a seller</a>
        <a href="">about</a>
        <a href="">help</a>
        <a href="login.php">Log out</a>
    </nav>
<!--Text Contet-->
    <pre style="text-align:center; font-size: large; font-weight: bolder;">Welcome to mali-kwa mali seller program. Have furniture that you'd want to rehome? 
This is the place for you!<br></pre>
<!--form-->
<h2>Become a seller</h2>
<pre style="text-align:center;">
You are almost done! To ensure your saftey and those of other users, we need to verifty your identity
To verify your identity, we need an image of your student ID
</pre>
    <?php
    if(isset($_POST['next'])){
        if($_POST['verify']==yes){
        $name=$_POST['name'];
        $id=$_POST['id'];
        $home=$_POST['home'];
        $sql="INSERT INTO sellerCredentials (student_id,name,residence)
        VALUES('$id','$name',$home')";
        mysqli_query($conn, $sql);
        echo '<script type=text/javascript>
        window.location.href="http://localhost/mali-kwa-mali/php/home.php";
        </script>';
    }else{
        echo'<script type=text/javascript>
        alert("Sorry, Mali-kwa-Mali is not yet offered for other universities... Yet!");
        </script>';
    }}
?>
</body>
</html>