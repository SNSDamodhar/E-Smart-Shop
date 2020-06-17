<?php

include('connection.php');

$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$encrypted_password = md5($password);

$account_check_query = "SELECT * FROM merchants WHERE mailid = '$username'";
$execute_account_check_query = mysqli_query($con, $account_check_query);
$count1 = mysqli_num_rows($execute_account_check_query);

$password_check_query = "SELECT * FROM merchants WHERE mailid = '$username' and password = '$encrypted_password'";
$execute_password_check_query = mysqli_query($con, $password_check_query);
$count2 = mysqli_num_rows($execute_password_check_query);

if($count1 == 1)
{
     if($count2 == 1)
     {
          header("location:merchantHome.php");
          session_start();
	     $_SESSION['merchantName'] = $username;


     }
     else
     {
          echo "<script>alert('Password Wrong')</script>";
          include('merchantLogin.html');
     }
}
else
{
     echo "<script>alert('User Account not found. Create one?')</script>";
     include('merchantSignUp.html');
}
?>
