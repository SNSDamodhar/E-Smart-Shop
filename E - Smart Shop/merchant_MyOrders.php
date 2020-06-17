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

$retrive_merchant_orders = "SELECT * FROM merchantorders WHERE merchantid = '$username'";
$execute_retrive_merchant_orders = mysqli_query($con, $retrive_merchant_orders);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Merchant Orders</title>
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
                                        <li><a href="merchantHome.php">Home</a></li>
                                        <li><a href="merchant_logout.php">LogOut</a></li>
                              </ul>
                         </nav>
                   </header>
               </div>
               <div style="overflow-x:auto;margin-top : 150px">
                    <table>
                         <tr>
                              <th>Customer Id</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>State</th>
                              <th>Pincode</th>
                              <th>Status</th>
                              <th>Action</th>

                         </tr>
                         <?php while($row = mysqli_fetch_array($execute_retrive_merchant_orders)) { ?>
                         <tr>
                              <td><?php echo $row['customerid']; ?></td>
                              <?php $producttitle = $row['productbrand'] . " " . $row['productmodel']; ?>
                              <td><?php echo  $producttitle; ?></td>
                              <td><?php echo $row['quantity']; ?></td>
                              <td><?php echo $row['price']; ?></td>
                              <td><?php echo $row['address']; ?></td>
                              <td><?php echo $row['city']; ?></td>
                              <td><?php echo $row['state']; ?></td>
                              <td><?php echo $row['pincode']; ?></td>
                              <td><?php echo $row['status']; ?></td>
                              <td>
                                   <form  action="merchant_OrderDelevered.php" method="post">
                                        <input type = "hidden" name="productid" value="<?php echo $row['productid']; ?>">
                                        <input type = "hidden" name="customerproductid" value="<?php echo $row['customerproductid']; ?>">
                                        <button align="center">Delivered</button>
                                   </form>
                              </td>
                         </tr>
                         <?php } ?>
                    </table>
               </div>
          </div>
     </body>
</html>
