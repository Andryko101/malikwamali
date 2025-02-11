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
<pre style="text-align: center;">NOTE: This program is currently only open to DeKUT students. More institutions to come later</pre>
<!--form-->
<form id="sellerForm" action="seller.html" method="post"><h2>Become a seller</h2>
        <div id="form"><label class="label">Enter your correct name</label>
        <input class="input" type="text" name="name" required><br>
        <label class="label">Enter your student ID</label><br>
        <input class="input" type="text" name="id" required><br>
        <label class="label">Are you a student of Dedan Kimathi?</label>
        <select class="input"name="verify">
            <option name="no">No</option>
            <option name="yes">Yes</option>
        </select><br>
        <label class="label">Where do you currently reside?</label>
        <select class="input" name="home">
            <option name="bomas">Bomas</option>
            <option name="gate_a">Gate A</option>
            <option name="nyeri_view">Nyeri View</option>
            <option name="jutumar">Jutumar</option>
            <option name="embassy">Embassy</option>
            <option name="tree_tops">Tree tops</option>
            <option name="kahawa">Kahawa</option>
            <option name="kwa_nduta">Kwa Nduta</option>
            <option name="kingongo">King'ong'o</option>
        </select><br>
        </div><input class="input" type="submit" name="next" value="Next" style="height: 30px;" onclick="redirectfun()" >
    </form>
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
<script type="text/javascript">
    document.getElementById('sellerForm').addEventListener('submit', function(event) {
    // Check if the form is valid
    if (!this.checkValidity()) {
        event.preventDefault(); // Prevent form submission
        alert("Please fill in all required fields.");
    }
});
    function redirectfun(){
        window.location="become_seller_next.php"
    }
</script>
</body>
</html>