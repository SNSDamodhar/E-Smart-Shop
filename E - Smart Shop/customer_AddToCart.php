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
$quantity = mysqli_real_escape_string($con,$_POST['quantity']);

echo $productid;

$extract_merchant_details = "SELECT * FROM merchantproducts WHERE productid = '$productid'";
$execute_extract_merchant_details = mysqli_query($con, $extract_merchant_details);
$row = mysqli_fetch_array($execute_extract_merchant_details);

$merchantid = $row['merchantid'];
$merchantname = $row['merchantname'];
$productbrand = $row['productbrand'];
$productmodel = $row['productmodel'];
$price = $row['price'] * $quantity;
$feature1 = $row['feature1'];
$feature2 = $row['feature2'];
$customerid = $_SESSION['customerName'];
$customerproductid = uniqid (rand () + rand(),false);

$extract_phonenumber = "SELECT phonenumber FROM merchants WHERE mailid = '$merchantid'";
$execute_extract_phonenumber = mysqli_query($con, $extract_phonenumber);
$row2 = mysqli_fetch_array($execute_extract_phonenumber);

$phonenumber = $row2['phonenumber'];

if($quantity > $row['quantity'])
{
     echo "<script>alert('Enter quantity less than available quantity')</script>";
     include('customerHome.php');
}

$insert_into_customerproducts = "insert into customercartproducts(customerproductid,merchantid,merchantname,customerid,productid,quantity,productbrand,productmodel,feature1,feature2,price,merchantphonenumber) values ('$customerproductid','$merchantid','$merchantname','$customerid','$productid','$quantity','$productbrand','$productmodel','$feature1','$feature2','$price','$phonenumber')";
$execute_insert_into_customerproducts = mysqli_query($con, $insert_into_customerproducts);

header('location:customer_Cart.php');

?>
