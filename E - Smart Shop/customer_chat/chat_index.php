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


<!DOCTYPE html>
<html lang="en" dir="ltr">
     <head>
          <meta charset="utf-8">
          <title>Chat</title>
          <link rel="stylesheet" href="navbar.css">
          <link rel="stylesheet" href="loginStyle.css">
     </head>
     <body>
          <div class="">
               <div class="">
                    <header>
                         <img src="logo.png">
                         <nav>
                              <ul>
                                        <li>welcome!  <?php echo $username; ?></li>
                              </ul>
                         </nav>
                   </header>

               </div>
               <div style = "margin-top : 150px;">
                    <form class="form1" action = "customerLogin.php" method = "post">
                         <input class="un " type="email" align="center" placeholder="Username" name = "userName" style = "max-width : 200px;"required><br>
                         <button class="submit" align="center">Sign in</button>
                    </form>

               </div>
          </div>
     </body>
</html>
