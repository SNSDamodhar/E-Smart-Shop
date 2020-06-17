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


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Customer Checkout</title>
          <link rel="stylesheet" href="static/css/navbar.css">
          <link rel="stylesheet" href="static/css/checkout.css">
     </head>
     <body style = "background-color: #F3EBF6;">
          <div class="">
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
               <div style = "margin-top : 150px">
                    <div class="row">
                         <div class="col-75">
                              <div class="container">
                                   <form action="customer_Checkout_Success.php" method = "post">

                                        <div class="row">
                                             <div class="col-50">
                                                  <h3>Billing Address</h3>
                                                  <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                                  <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
                                                  <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                                  <input type="text" id="email" name="email" placeholder="john@example.com" required>
                                                  <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                                  <input type="text" id="adr" name="address" placeholder="1-12/1, xyx street" required>
                                                  <label for="city"><i class="fa fa-institution"></i> City/Town/Village</label>

                                                  <input type="text" id="city" name="city" placeholder="Hyderabad" required>

                                                  <div class="row">
                                                       <div class="col-50">
                                                            <label for="state">State</label>
                                                            <input type="text" id="state" name="state" placeholder="Andhra Prades" required>
                                                       </div>
                                                       <div class="col-50">
                                                            <label for="zip">Pincode</label>
                                                            <input type="text" id="zip" name="zip" placeholder="534456" required>
                                                       </div>
                                                  </div>
                                             </div>

                                             <div class="col-50">
                                                  <h3>Payment</h3>
                                                  <label for="fname">Accepted Cards</label>
                                                  <div class="icon-container">
                                                       <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                       <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                       <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                       <i class="fa fa-cc-discover" style="color:orange;"></i>
                                                  </div>
                                                  <label for="cname">Name on Card</label>
                                                  <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                                                  <label for="ccnum">Credit card number</label>
                                                  <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                                                  <label for="expmonth">Exp Month</label>
                                                  <input type="text" id="expmonth" name="expmonth" placeholder="September" required>

                                                  <div class="row">
                                                       <div class="col-50">
                                                            <label for="expyear">Exp Year</label>
                                                            <input type="text" id="expyear" name="expyear" placeholder="2018" required>
                                                       </div>
                                                       <div class="col-50">
                                                            <label for="cvv">CVV</label>
                                                            <input type="text" id="cvv" name="cvv" placeholder="352" required>
                                                       </div>
                                                  </div>
                                             </div>

                                        </div>
                                        <label>
                                             <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                                        </label>
                                        <input type="hidden" name="productid" value="<?php echo $row['productid']; ?>">
                                        <input type="hidden" name="customerproductid" value="<?php echo $row['customerproductid']; ?>">
                                        <input type="submit" value="Continue to checkout" class="btn">
                                   </form>
                              </div>
                         </div>

                         <div class="col-25">
                              <div class="container">
                                   <h4>Cart
                                        <span class="price" style="color:black">
                                             <i class="fa fa-shopping-cart"></i>
                                             <b><?php echo $row['quantity']; ?></b>
                                        </span>
                                   </h4>
                                   <?php $producttitle = $row['productbrand'] . " " . $row['productmodel']; ?>
                                   <p><?php echo $producttitle; ?> <span class="price"> <?php echo $row['price']; ?> </span></p>
                                   <hr>
                                   <p>Total <span class="price" style="color:black"><b> <?php echo $row['price']; ?> </b></span></p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </body>
</html>
