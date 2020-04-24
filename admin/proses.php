<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{
// Code for change password 
  if(isset($_POST['submit']))
  {
    $address=$_POST['address'];
    $email=$_POST['email']; 
    $contactno=$_POST['contactno'];
    $norekening=$_POST['norekening'];
    $namabank=$_POST['namabank'];
    $sql="update tblcontactusinfo set Address=:address,EmailId=:email,ContactNo=:contactno,NamaBank=:namabank,NoBank=:norekening";
    $query = $dbh->prepare($sql);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
    $query->bindParam(':namabank',$namabank,PDO::PARAM_STR);
    $query->bindParam(':norekening',$norekening,PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg']="Info Updateed successfully";

    echo $address.$email.$contactno.$norekening.$namabank ;
  }
  ?>