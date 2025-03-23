<?php
   include('database.php'); 
    session_start();
    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a seller</title>
    <link href="../css/seller.css" rel="stylesheet">
</head>
<body style="background-image: url('../images/background.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">
<div class="container">

<header class="header">
    <div class="logo"><img src="../images/logo.png" alt="Logo"></div>
    <nav class="nav">
        <ul class="nav-list">
            <li><a class="nav-link" href="home.php">Home</a></li>
            <li><a class="nav-link" href="listing.php">All Products</a></li>
            <li><a class="nav-link" href="seller_registration.php">Become a Seller</a></li>
            <li><a class="nav-link cart-btn" href="view_cart.php"> 🛒 Cart (<?php echo $cart_count; ?>) </a></li>
        </ul>
    </nav>
</header>

<pre class="welcome-text">Welcome to Mali-Kwa Mali Seller Program. Have furniture that you'd want to rehome? 
This is the place for you!</pre>
<pre class="note-text">NOTE: This program is currently only open to DeKUT students. More institutions to come later.</pre>

<form id="sellerForm" class="form" action="seller_registration.php" method="post">
    <h2 class="form-title">Become a seller</h2>
    <div class="form-section">
        <label class="form-label">Enter your Full name</label>
        <input class="input-field" type="text" name="name" required>
        
        <label class="form-label">Enter your student ID</label>
        <input class="input-field" type="text" name="id" required>
        
        <label class="form-label">Are you a student of Dedan Kimathi?</label>
        <select class="input-field" name="verify">
            <option value="no">No</option>
            <option value="yes">Yes</option>
        </select>
        
        <label class="form-label">Where do you currently reside?</label>
        <select class="input-field" name="home">
            <option value="bomas">Bomas</option>
            <option value="gate_a">Gate A</option>
            <option value="nyeri_view">Nyeri View</option>
            <option value="jutumar">Jutumar</option>
            <option value="embassy">Embassy</option>
            <option value="tree_tops">Tree tops</option>
            <option value="kahawa">Kahawa</option>
            <option value="kwa_nduta">Kwa Nduta</option>
            <option value="kingongo">King'ong'o</option>
        </select>
    </div>
    <input class="submit-btn" type="submit" name="next" value="Next">
    </form>

    <?php
    if(isset($_POST['next'])){
        if($_POST['verify']=='yes'){
        $name=$_POST['name'];
        $id=$_POST['id'];
        $home=$_POST['home'];
        $sql = "SELECT * FROM user_credentials WHERE student_id = '$id' AND name = '$name'";
        $result=mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        $sql="INSERT INTO seller_credentials (student_id,name,home)
        VALUES('$id','$name','$home')";
        mysqli_query($conn, $sql);
        $sql="UPDATE user_credentials SET `seller` = 'yes' WHERE student_id = '$id'";
        mysqli_query($conn, $sql);
        header("Location: seller_dashboard.php");
        exit();
        }
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