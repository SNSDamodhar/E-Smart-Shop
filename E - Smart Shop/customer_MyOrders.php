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

$retrive_customer_orders = "SELECT * FROM merchantorders WHERE customerid = '$username'";
$execute_retrive_customer_orders = mysqli_query($con, $retrive_customer_orders);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Customer Orders</title>
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
                              <th>merchantid Id</th>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Price</th>
                              <th>Address</th>
                              <th>Status</th>

                         </tr>
                         <?php while($row = mysqli_fetch_array($execute_retrive_customer_orders)) { ?>
                         <tr>
                              <td><?php echo $row['merchantid']; ?></td>
                              <?php $producttitle = $row['productbrand'] . " " . $row['productmodel']; ?>
                              <td><?php echo  $producttitle; ?></td>
                              <td><?php echo $row['quantity']; ?></td>
                              <td><?php echo $row['price']; ?></td>
                              <?php $address =  $row['address'] . " " . $row['city'] . " " . $row['state'] . " " . $row['pincode'];?>
                              <td><?php echo $address; ?></td>
                              <td><?php echo $row['status']; ?></td>
                         </tr>
                         <?php } ?>
                    </table>
               </div>
          </div>
     </body>
</html>
