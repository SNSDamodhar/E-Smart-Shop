<?php

include('connection.php');

$productbrand = strtolower(mysqli_real_escape_string($con,$_POST['productbrand']));
$productmodel = strtolower(mysqli_real_escape_string($con,$_POST['productmodel']));
$productcategory = strtolower(mysqli_real_escape_string($con,$_POST['productcategory']));
$price = mysqli_real_escape_string($con,$_POST['price']);
$feature1 = strtolower(mysqli_real_escape_string($con,$_POST['feature1']));
$feature2 = strtolower(mysqli_real_escape_string($con,$_POST['feature2']));
$feature3 = strtolower(mysqli_real_escape_string($con,$_POST['feature3']));
$feature4 = strtolower(mysqli_real_escape_string($con,$_POST['feature4']));
$quantity = mysqli_real_escape_string($con,$_POST['quantity']);
$productid = uniqid (rand (),false);

session_start();
$merchantid = $_SESSION['merchantName'];

$merchant_details_query = "SELECT * FROM merchants WHERE mailid='$merchantid' LIMIT 1";
$result = mysqli_query($con, $merchant_details_query);
$row = mysqli_fetch_array($result);
$merchantname = $row['username'];
$shopname = $row['shopname'];
$pincode = $row['pincode'];


if ($_FILES['image1']['size']==0) { die("No file selected"); }
if (exif_imagetype($_FILES['image1']['tmp_name'])===false) { die("Not an image"); }
$img1Content = addslashes(file_get_contents($_FILES['image1']['tmp_name']));

if ($_FILES['image2']['size']==0) { die("No file selected"); }
if (exif_imagetype($_FILES['image2']['tmp_name'])===false) { die("Not an image"); }
$img2Content = addslashes(file_get_contents($_FILES['image2']['tmp_name']));

if ($_FILES['image3']['size']==0) { die("No file selected"); }
if (exif_imagetype($_FILES['image3']['tmp_name'])===false) { die("Not an image"); }
$img3Content = addslashes(file_get_contents($_FILES['image3']['tmp_name']));

$list_product_query = "insert into merchantproducts(merchantid,merchantname,shopname,productid,productbrand,productmodel,productcategory,price,image1,image2,image3,feature1,feature2,feature3,feature4,quantity,pincode) values ('$merchantid','$merchantname','$shopname','$productid','$productbrand','$productmodel','$productcategory','$price','$img1Content','$img2Content','$img3Content','$feature1','$feature2','$feature3','$feature4','$quantity','$pincode')";
$execute_list_product_query = mysqli_query($con,$list_product_query) or die(mysqli_error($con));

if($execute_list_product_query)
{
     header('location:merchantHome.php');
}
else {
     echo "unsuccess";
}






















?>
