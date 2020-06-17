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

$pincode = mysqli_real_escape_string($con,$_POST['pincode']);
$category = strtolower(mysqli_real_escape_string($con,$_POST['category']));
$productbrand = strtolower(mysqli_real_escape_string($con,$_POST['productbrand']));

$execute_retrive_products_query = 0;

if(strlen($pincode) ==6 )
{
     if(strlen($pincode) == 6 and strlen($category) > 0 and strlen($productbrand) > 0)
     {
          $retrive_products_query = "SELECT * FROM merchantproducts WHERE pincode = '$pincode' and productcategory = '$category' and productbrand = '$productbrand'";
          $execute_retrive_products_query = mysqli_query($con, $retrive_products_query);
     }
     elseif(strlen($pincode) == 6 and strlen($category) > 0)
     {
          $retrive_products_query = "SELECT * FROM merchantproducts WHERE pincode = '$pincode' and productcategory = '$category'";
          $execute_retrive_products_query = mysqli_query($con, $retrive_products_query) or die(mysqli_error($con));
     }
     elseif(strlen($pincode) == 6 and strlen($productbrand) > 0)
     {
          $retrive_products_query = "SELECT * FROM merchantproducts WHERE pincode = '$pincode' and productbrand = '$productbrand'";
          $execute_retrive_products_query = mysqli_query($con, $retrive_products_query);
     }
     elseif (strlen($pincode) == 6)
     {
          $retrive_products_query = "SELECT * FROM merchantproducts WHERE pincode = '$pincode'";
          $execute_retrive_products_query = mysqli_query($con, $retrive_products_query);
     }
     else
     {
          echo "<script>alert('No Products Available')</script>";
          include('customerHome.php');
     }

}
else
{

     header('location:customerHome.php');
     echo "<script>alert('Enter correct Pincode')</script>";
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Customer Search</title>
          <link rel="stylesheet" href="static/css/navbar.css">
          <link rel="stylesheet" href="static/css/loginStyle.css">
          <style>
               table {
                    border-collapse: collapse;
                    width: 100%;
               }

               th, td {
                    text-align: left;
                    padding: 8px;
               }

               tr:nth-child(even){background-color: #f2f2f2}

               th {
                    background-color: rgb(92, 194, 242);
                    color: white;
               }
          </style>


     </head>
     <body style = "background-color: #F3EBF6;">
          <div>
               <div class="">
                    <header>
                         <img src="static/images/logo.png">
                         <nav>
                              <ul>
                                   <li>welcome!  <?php echo $username; ?></li>
                                   <li><a href="customerHome.php">Home</a></li>
                                   <li><a href="customer_Cart.php">MyCart</a></li>
                                   <li><a href="customer_MyOrders.php">MyOrders</a></li>
                                   <li><a href="customer_logout.php">LogOut</a></li>
                              </ul>
                         </nav>
                   </header>
               </div>
               <div style="overflow-x:auto;margin-top : 150px">
                    <table>
                         <tr>
                              <th>Image1</th>
                              <th>Image2</th>
                              <th>Image3</th>
                              <th><span align = "center">ProductDetails</span></th>
                         </tr>
                         <?php while($row = mysqli_fetch_array($execute_retrive_products_query)){ ?>
                         <tr>
                              <td>

                                   <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['image1'] ) . '" style = "max-width : 250px;max-height : 250px"/>'; ?>
                              </td>
                              <td>
                                   <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['image2'] ) . '" style = "max-width : 250px;max-height : 250px"/>'; ?>
                              </td>
                              <td>
                                   <?php echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['image3'] ) . '" style = "max-width : 250px;max-height : 250px"/>'; ?>
                              </td>
                              <td>
                                   <form class="form1" action = "customer_AddToCart.php" name = "form"  onsubmit="return validate_quantity()" method = "post" enctype="multipart/form-data">
                                        <?php $producttitle = $row['productbrand'] . " " . $row['productmodel'] . " " . $row['feature1'] ?>
                                        <?php $shopkeeper = $row['shopname'] . "(" . $row['merchantname'] . ")"; ?>
                                             <label>ShopKeeper : </label><input type = "text" value = "<?php echo $shopkeeper; ?>" name = "ShopKeeper" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>ProductTitle : </label><input type = "text" value = "<?php echo $producttitle; ?>" name = "producttitle" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Product Price : Rs</label></label><input type = "text" value = "<?php echo $row['price']; ?>" name = "productprice" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Feature 1 : </label></label><input type = "text" value = "<?php echo $row['feature1']; ?>" name = "feature1" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Feature 2 : </label></label><input type = "text" value = "<?php echo $row['feature2']; ?>" name = "feature2" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Feature 3 : </label></label><input type = "text" value = "<?php echo $row['feature3']; ?>" name = "feature3" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Feature 4 : </label></label><input type = "text" value = "<?php echo $row['feature4']; ?>" name = "feature4" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <label>Available : </label></label><input type = "text" id = "quan" value = "<?php echo $row['quantity']; ?>" name = "quantity1" style = "border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;background-color: #F3EBF6;" readonly/><br>
                                             <input class="un " type="text" align="center" placeholder="enter quantity < <?php echo $row['quantity']; ?>" name = "quantity" style = "width : 200px" id = "quan1" required>
                                             <input type = "hidden" value = "<?php echo $row['productid']; ?>" name = "productid" />
                                             <!--<a class="submit" align="center">Sign in</a>-->
                                             <button class="submit" align="left">Addto Cart</button>
                                   </form
                              </td>
                         </tr>
                         <?php } ?>
                    </table>
               </div>
          </div>
     </body>
</html>
