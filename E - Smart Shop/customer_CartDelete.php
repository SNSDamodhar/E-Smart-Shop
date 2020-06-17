<?php

$username = "";
session_start();
if(isset($_SESSION['customerName']))
{
     $username = $_SESSION['customerName'];
}
else
{
     header('location:customerLogin.html');
}

include('connection.php');

$productid = mysqli_real_escape_string($con,$_POST['productid']);
$customerproductid = mysqli_real_escape_string($con,$_POST['customerproductid']);

$delete_cart_product = "DELETE FROM `customercartproducts` WHERE productid = '$productid' and customerproductid = '$customerproductid'";
$execute_delete_cart_product = mysqli_query($con, $delete_cart_product);

header('location:customer_cart.php');


?>
