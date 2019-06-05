<?php session_start();
    include_once 'dbconnect.php';

    if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql = "UPDATE orders SET status = '3' WHERE id = " . $id;
    $result = mysqli_query($con, $sql);
    header("Location: history.php");
    }

  ?>
