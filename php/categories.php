<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/home.css" rel="stylesheet">
</head>
<div id="logo"><img src="../images/logo.png" rel="logo"></div>
<body style="background-image: url('../images/background.jpeg'); background-attachment: 
fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">
    <h2>Welcome to mali-kwa-mali</h2>
    <nav class="navbar">
        <a href="home.php">home</a>
        <a href="become_seller.php">Become a seller</a>
        <a href="">about</a>
        <a href="seller.php">My account</a>
        <a href="login.php" style="display:inline; justify-content: right;  ">Log out</a>
    </nav>
    <!--Displaying products-->
    <div class="content">
    <div class="image" onclick="redirectfun()"><img class="img" src="../images/chair1.jpeg" alt="object"><div>Chair</div></div>
    <div class="image"><img class="img" src="../images/chair1.jpeg" alt="object"><div>Casual Chairs</div></div>
    <div class="image"><img class="img" src="../images/chair2.jpeg" alt="object"><div>Office Chairs</div></div>
    <div class="image"><img class="img" src="../images/table.jpeg" alt="object"><div>Table</div></div>
    <div class="image"><img class="img" src="../images/studyDesk.jpeg" alt="object"><div>Study desk</div></div>
</div>
</body>
<script type="text/javascript">
    function redirectfun(){
        window.location.href="login.php";
    }
</script>
</html>