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
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>List Product</title>
          <link rel="stylesheet" href="static/css/navbar.css">
          <link rel="stylesheet" href="static/css/merchant_ListProducts.css">
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
          <div class="main" style = "height : 900px">
               <form class="form1" action = "merchant_ListProduct_Database.php" method = "post" enctype="multipart/form-data">
                    <input class="product" type="text" align="center" name = "productbrand" placeholder="productbrand" list = "brand" required>
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
                    <input class="product" type="text" align="center" name = "productmodel" placeholder="productmodel" required>
                    <input class="product" type="text" align="center" name = "productcategory" placeholder="productcategory" list = "category" required>
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
                    <input class="product" type="number" align="center" name = "price" placeholder="price" required><br>
                    <label style = "margin-left : 40px; margin-top : 20px;">Select Image 1: </label> <input type="file" name="image1" accept=".png,.gif,.jpg,.webp"><br><br>
                    <label style = "margin-left : 40px; margin-top : 20px;">Select Image 2: </label> <input type="file" name="image2" accept=".png,.gif,.jpg,.webp"><br><br>
                    <label style = "margin-left : 40px; margin-top : 20px;">Select Image 3: </label> <input type="file" name="image3" accept=".png,.gif,.jpg,.webp"><br><br>
                    <input class="product" type="text" align="center" name = "feature1" placeholder="feature1" required>
                    <input class="product" type="text" align="center" name = "feature2" placeholder="feature2" required>
                    <input class="product" type="text" align="center" name = "feature3" placeholder="feature3" required>
                    <input class="product" type="text" align="center" name = "feature4" placeholder="feature4" required>
                    <input class="product" type="text" align="center" name = "quantity" placeholder="quantity" required>
                    <!--<a class="submit" align="center">Sign in</a>-->
                    <button class="submit" align="center">List Product</button>
               </form>
          </div>
     </body>
</html>
