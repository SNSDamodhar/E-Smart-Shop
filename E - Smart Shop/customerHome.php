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
?>


<html>
     <head>
          <link rel="stylesheet" href="static/css/loginStyle.css">
          <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
          <meta name="viewport" content="width=device-width, initial-scale=1" />
          <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
          <link rel="stylesheet" href="static/css/navbar.css">
          <title>Customer Home</title>
     </head>

     <body style = "background-color: #F3EBF6;">
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
          <div class="main">
               <p class="sign" align="center">Enter values to Search</p>
               <form class="form1" action = "customer_SearchResult.php" method = "post">
                    <input class="un " type="text" align="center" placeholder="PinCode" name = "pincode" required>
                    <input class="un " type="text" align="center" placeholder="Category" list = "category" name = "category">
                    <datalist id = "category">
                         <option value="Mobiles"></option>
                         <option value="Washing Machines"></option>
                         <option value="Shirts"></option>
                         <option value="Watches"></option>
                         <option value="Purses"></option>
                         <option value="Laptops"></option>
                         <option value="Toys"></option>
                         <option value="Lights"></option>
                    </datalist>
                    <input class="un " type="text" align="center" placeholder="Product Brand" name = "productbrand" list = "brand">
                    <datalist id = "brand">
                         <option value="RealMe"></option>
                         <option value="RedMi"></option>
                         <option value="Samsung"></option>
                         <option value="LG"></option>
                         <option value="Levis"></option>
                         <option value="UCB"></option>
                         <option value="GoldMedal"></option>
                         <option value="Surya"></option>
                    </datalist>
                    <!--<a class="submit" align="center">Sign in</a>-->
                    <button class="submit" align="center">Search Products</button>
               </form>
          </div>

     </body>

</html>
