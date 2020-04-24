<?php
session_start();
include('include/config.php');
if(isset($_POST['login']))
{
  $email=$_POST['username'];
  $password=md5($_POST['password']);
  $sql ="SELECT * FROM admin WHERE UserName=:a AND Password=:b";
  $query= $dbh -> prepare("SELECT * FROM admin WHERE UserName=:a AND Password=:b");
  $query-> bindParam(':a', $email, PDO::PARAM_STR);
  $query-> bindParam(':b', $password, PDO::PARAM_STR);
  $query-> execute();
  $data = $query->fetch(); // Ambil datanya dari hasil query tadi
  // Cek apakah variabel $data ada datanya atau tidak
if( ! empty($data)){ 
    $_SESSION['alogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'dashbord.php'; </script>";
  } else{

    echo "<script>alert('Invalid Details');</script>".$email.$password;

  }

}

?>