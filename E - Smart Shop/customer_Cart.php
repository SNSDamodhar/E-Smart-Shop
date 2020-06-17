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

$retrive_customer_products = "SELECT * FROM customercartproducts WHERE customerid = '$username'";
$execute_retrive_customer_products = mysqli_query($con, $retrive_customer_products);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Customer Cart</title>
          <link rel="stylesheet" href="static/css/navbar.css">

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
                              <th>Merchant Mail</th>
                              <th>Merchant Name</th>
                              <th>Merchant Number</th>
                              <th>Product Title</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Response</th>
                         </tr>
                         <?php while($row = mysqli_fetch_array($execute_retrive_customer_products)) { ?>
                         <tr>
                              <td><?php echo $row['merchantid']; ?></td>
                              <td><?php echo $row['merchantname']; ?></td>
                              <td><?php echo $row['merchantphonenumber']; ?></td>
                              <?php $producttitle = $row['productbrand'] . " " . $row['productmodel'] . " " . $row['feature1']; ?>
                              <td><?php echo  $producttitle; ?></td>
                              <td><?php echo $row['quantity']; ?></td>
                              <td><?php echo $row['price']; ?></td>
                              <td>
                                   <form  action="customer_Checkout.php" method="post">
                                        <input type = "hidden" name="productid" value="<?php echo $row['productid']; ?>">
                                        <input type = "hidden" name="customerproductid" value="<?php echo $row['customerproductid']; ?>">
                                        <button align="center">Buy Now</button>
                                   </form>
                                   <form action = "customer_CartDelete.php" method = "POST">
                                        <input type = "hidden" name="productid" value="<?php echo $row['productid']; ?>">
                                        <input type = "hidden" name="customerproductid" value="<?php echo $row['customerproductid']; ?>">
                                        <button align="center" style = "margin-top : 2px;">Delete</button>
                                   </form>
                              </td>
                         </tr>
                         <?php } ?>
                    </table>
               </div>
          </div>
     </body>
</html>
