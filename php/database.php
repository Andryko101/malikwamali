<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "mali-kwa-mali";
    $conn = "";
    $conn=mysqli_connect($db_server, $db_user, $db_pass, $db_name,);

    if($conn){
        echo"";
    }
    else{
        echo"Could not connect";
    }
?>