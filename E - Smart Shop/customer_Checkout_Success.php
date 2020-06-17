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

$customerproductid = mysqli_real_escape_string($con,$_POST['customerproductid']);
$productid = mysqli_real_escape_string($con,$_POST['productid']);



$retrive_product_details = "SELECT * FROM customercartproducts WHERE customerproductid = '$customerproductid' and productid = '$productid'";
$execute_retrive_product_details = mysqli_query($con, $retrive_product_details);
$row = mysqli_fetch_array($execute_retrive_product_details);

$retrive_product_from_merchant = "SELECT * FROM merchantproducts WHERE productid = '$productid'";
$execute_retrive_product_from_merchant = mysqli_query($con, $retrive_product_from_merchant);
$row1 = mysqli_fetch_array($execute_retrive_product_from_merchant);

$update_quantity = $row1['quantity'] - $row['quantity'];

$reduce_merchant_product_count = "update merchantproducts SET quantity = '$update_quantity' WHERE productid = '$productid'";
$execute_reduce_merchant_product_count = mysqli_query($con, $reduce_merchant_product_count);



$customerid = $row['customerid'];
$merchantid = $row['merchantid'];
$productbrand = $row['productbrand'];
$productmodel = $row['productmodel'];
$quantity = $row['quantity'];
$price = $row['price'];
$address = mysqli_real_escape_string($con,$_POST['address']);
$city = mysqli_real_escape_string($con,$_POST['city']);
$state = mysqli_real_escape_string($con,$_POST['state']);
$pincode = mysqli_real_escape_string($con,$_POST['zip']);
$customerproductid = $row['customerproductid'];
$productid = $row['productid'];


$place_order_for_merchant = "insert into merchantorders(customerid, merchantid, productbrand, productmodel, quantity, price, address, city, state, pincode, customerproductid, productid) VALUES ('$customerid','$merchantid','$productbrand','$productmodel','$quantity','$price','$address','$city','$state','$pincode','$customerproductid','$productid')";
$execute_place_order_for_merchant = mysqli_query($con, $place_order_for_merchant);

$delete_customer_cart_product = "DELETE FROM `customercartproducts` WHERE customerid = '$customerid' and productid = '$productid' and customerproductid = '$customerproductid'";
$execute_delete_customer_cart_product = mysqli_query($con, $delete_customer_cart_product);

header("location:thanks.html");
?>
