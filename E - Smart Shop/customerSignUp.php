<?php

//ini_set('mysql.connect_timeout', 300)
//ini_set('default_socket_timeout', 300)

$lhname="localhost:3308";
$dbuser="root";
$dbpass="";
$dbname="esmartshop";

$con = mysqli_connect($lhname,$dbuser,$dbpass,$dbname) or die(mysqli_error($con));

$username = strtolower(mysqli_real_escape_string($con,$_POST['userName']));
$password = mysqli_real_escape_string($con,$_POST['password']);
$phonenumber = mysqli_real_escape_string($con,$_POST['phone']);
$pincode = mysqli_real_escape_string($con,$_POST['pincode']);
$city = strtolower(mysqli_real_escape_string($con,$_POST['city']));
$state = mysqli_real_escape_string($con,$_POST['state']);

$password_length = strlen($password);
$phonenumber_length = strlen($phonenumber);
$pincode_length = strlen($pincode);

$encrypted_password = md5($password);

if($phonenumber_length == 10)
{
     if(preg_match("#[0-9]+#", $password) && preg_match("#[A-Z]+#", $password) && preg_match("#[a-z]+#", $password))
     {
          if($pincode_length == 6)
          {
               $user_check_query = "SELECT * FROM customers WHERE username='$username' LIMIT 1";
		     $result = mysqli_query($con, $user_check_query);
		     $count= mysqli_num_rows($result);

               if($count == 0)
               {
                    $user_registration_query = "insert into customers(username,password,phone,pincode,city,state) values ('$username','$encrypted_password','$phonenumber','$pincode','$city','$state')";

			     $user_registration_submit=mysqli_query($con,$user_registration_query) or die(mysqli_error($con));

			     header('location:customerLogin.html');
               }
               else
               {
                    echo "<script>alert('account alread exist')</script>";
			     include('customerSignUp.html');

               }
          }
          else
          {
               echo "<script>alert('pincode should have 6 characters length')</script>";
               include('customerSignUp.html');
          }
     }
     else
     {
          echo "<script>alert('password must contain atleast one special character, one capital alphabet, one digit, one smallercase')</script>";
          include('customerSignUp.html');
     }
}
else {
     echo "<script>alert('Enter correct phonenumber')</script>";
     include('customerSignUp.html');
}





?>
