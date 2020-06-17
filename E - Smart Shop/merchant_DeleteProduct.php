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

$delete_merchant_item = "DELETE FROM `merchantproducts` WHERE merchantid = '$username' and productid = '$productid' ";
$execute_delete_merchant_item = mysqli_query($con, $delete_merchant_item);

header('location:merchant_MyProducts.php');


?>
