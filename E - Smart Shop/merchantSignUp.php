<?php

include('connection.php');

$username = strtolower(mysqli_real_escape_string($con,$_POST['userName']));
$mailid = strtolower(mysqli_real_escape_string($con,$_POST['mailid']));
$password = mysqli_real_escape_string($con,$_POST['password']);
$phonenumber = mysqli_real_escape_string($con,$_POST['phone']);
$shopname = strtolower(mysqli_real_escape_string($con,$_POST['shopname']));
$aadhar = mysqli_real_escape_string($con,$_POST['aadhar']);
$pan = mysqli_real_escape_string($con,$_POST['pan']);
$gstin = mysqli_real_escape_string($con,$_POST['gstin']);
$category = strtolower(mysqli_real_escape_string($con,$_POST['category']));
$pincode = mysqli_real_escape_string($con,$_POST['pincode']);
$city = strtolower(mysqli_real_escape_string($con,$_POST['city']));
$state = mysqli_real_escape_string($con,$_POST['state']);


$password_length = strlen($password);
$phonenumber_length = strlen($phonenumber);
$pincode_length = strlen($pincode);
$aadhar_length = strlen($aadhar);
$pan_length = strlen($pan);
$gstin_length = strlen($gstin);


$encrypted_password = md5($password);

if($phonenumber_length == 10)
{
     if(preg_match("#[0-9]+#", $password) && preg_match("#[A-Z]+#", $password) && preg_match("#[a-z]+#", $password))
     {
          if($pincode_length == 6)
          {
               if($aadhar_length == 12)
               {
                    if($pan_length == 10)
                    {
                         if($gstin_length == 15)
                         {
                              $merchant_check_query = "SELECT * FROM merchants WHERE mailid='$mailid' LIMIT 1";
               		     $result = mysqli_query($con, $merchant_check_query);
               		     $count= mysqli_num_rows($result);

                              if($count == 0)
                              {
                                   $merchant_registration_query = "insert into merchants(username,mailid,password,phonenumber,shopname,aadhar,pan,gstid,category,pincode,city,state) values ('$username','$mailid','$encrypted_password','$phonenumber','$shopname','$aadhar','$pan','$gstin','$category','$pincode','$city','$state')";

               			     $merchant_registration_submit=mysqli_query($con,$merchant_registration_query) or die(mysqli_error($con));

               			     header('location:merchantLogin.html');
                              }
                              else
                              {
                                   echo "<script>alert('account alread exist')</script>";
               			     include('merchantSignUp.html');
                              }
                         }
                         else
                         {
                              echo "<script>alert('Invalid GSTIN id')</script>";
                              include('merchantSignUp.html');
                         }
                    }
                    else
                    {
                         echo "<script>alert('Invalid PAN number')</script>";
                         include('merchantSignUp.html');
                    }
               }
               else
               {
                    echo "<script>alert('Invalid AADHAR number')</script>";
                    include('merchantSignUp.html');
               }
          }
          else
          {
               echo "<script>alert('Invalid PINCODE')</script>";
               include('merchantSignUp.html');
          }
     }
     else
     {
          echo "<script>alert('password must contain atleast one special character, one capital alphabet, one digit, one smallercase')</script>";
          include('merchantSignUp.html');
     }
}
else
{
     echo "<script>alert('Enter correct phonenumber')</script>";
     include('merchantSignUp.html');
}
?>
