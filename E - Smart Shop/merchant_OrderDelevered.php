<?php

$username = "";
session_start();
if(isset($_SESSION['merchantName']))
{
     $username = $_SESSION['merchantName'];
}
else
{
     include('merchantLogin.html');
}

include('connection.php');

$productid = mysqli_real_escape_string($con,$_POST['productid']);
$customerproductid = mysqli_real_escape_string($con,$_POST['customerproductid']);

$status = "Delivered";

$update_query = "UPDATE `merchantorders` SET `status`='$status' where productid = '$productid' and customerproductid = '$customerproductid'";
$execute_update_query = mysqli_query($con, $update_query);

header('location:merchant_MyOrders.php');

?>
