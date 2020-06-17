<?php
     $username = "";
     session_start();
     if(isset($_SESSION['merchantName']))
     {
          $username = $_SESSION['merchantName'];
     }
     else
     {
          header('location:merchantLogin.html');
     }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Merchant Home</title>
          <link rel="stylesheet" href="static/css/navbar.css">
          <link rel="stylesheet" href="static/css/merchantHome.css">
     </head>
     <body style = "background-color: #F3EBF6;">
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
         <br><br><br><br>
          <div class="main" style = "height : 250px">
               <form class="form1" action = "merchant_ListProduct.php" method = "post">
                    <button class="submit" align="center">List Product</button>
               </form>
               <form class="form1" action = "merchant_MyProducts.php" method = "post">
                    <button class="submit" align="center">My Products</button>
               </form>
               <form class="form1" action = "merchant_MyOrders.php" method = "post">
                    <button class="submit" align="center">My Orders</button>
               </form>
          </div>
     </body>
</html>
