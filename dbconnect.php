<?php
    //1.connect to mysql database
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $db_name = "reward";
    $con = mysqli_connect($host, $user, $passwd, $db_name) or die("Error " . mysqli_error($con));
    mysqli_set_charset($con, "utf8");
?>
