<?php session_start();
    include_once '../../dbconnect.php';
//delete
if (isset($_GET['id'])) {
    $sql = "DELETE FROM product_categories WHERE id=" . $_GET['id'];
    mysqli_query($con, $sql);
    header("Location: index.php");
}
?>
