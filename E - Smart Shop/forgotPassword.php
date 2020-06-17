<?php

include('connection.php');

$username = mysqli_real_escape_string($con,$_POST['userName']);

$account_check_query1 = "SELECT * FROM customers WHERE username = '$username'";
$account_check_query2 = "SELECT * FROM merchants WHERE username = '$username'";
$execute_account_check_query1 = mysqli_query($con, $account_check_query1);
$execute_account_check_query2 = mysqli_query($con, $account_check_query2);
$count1 = mysqli_num_rows($execute_account_check_query1);
$count2 = mysqli_num_rows($execute_account_check_query2);

$otp = 0;

if(filter_var($username, FILTER_VALIDATE_EMAIL))
{
     if($count1 == 1)
     {
          $otp_query = "SELECT password FROM customers WHERE username = '$username'";
          $execute_otp_query = mysqli_query($con, $otp_query);
          $row = mysqli_fetch_assoc($execute_otp_query);
          $otp_string = $row['password'];
          $otp = substr($otp_string, 0, 5);
     }
     elseif ($count2 == 1)
     {
          $otp_query = "SELECT password FROM merchants WHERE username = '$username'";
          $execute_otp_query = mysqli_query($con, $otp_query);
          $row = mysqli_fetch_assoc($execute_otp_query);
          $otp_string = $row['password'];
          $otp = substr($otp_string, 0, 5);
     }
     else
     {
          echo "<script>alert('Account does not exists.')</script>";
          include('forgotPassword.html');
     }
}
else
{
     echo "<script>alert('Enter Correct E-Mail address')</script>";
     include('forgotPassword.html');
}


$to = $username;
$subject = "Your Recovered Password";
$message = "Please use this password to login " . $otp;
$headers = "From : sadhudamodhar12@gmail.com";

if(mail($to, $subject, $message, $headers))
{
     echo "<script>alert('OTP is send to your registered mail')</script>";
     include('resetPassword.html');
}
else
{
     echo "<script>alert('Failed to recover your password')</script>";
     include('forgotPassword.html');
}
?>
