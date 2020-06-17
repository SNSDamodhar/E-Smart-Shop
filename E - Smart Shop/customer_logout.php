<?php
session_start();
if (isset($_SESSION['customerName']))
{
          session_destroy();
		header("location:customerLogin.html");
}
else
{
     header('location:customerlogin.html');
}


?>
