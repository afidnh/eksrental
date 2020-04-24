<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{
  $aeid=$_POST['id'];
    $subharga=$_POST['subharga'];
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $hargatambahan=$_POST['hargatambahan'];
    $totalharga=$_POST['hargatambahan']+$_POST['subharga'];;
    $status=$_POST['status'];;

    $sql = "UPDATE tblbooking SET Status=:status, SubHarga=:subharga, HargaTambahan=:hargatambahan, TotalHarga=:totalharga, FromDate=:fromdate,  Todate=:todate WHERE  id=:aeid";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> bindParam(':subharga',$subharga, PDO::PARAM_STR);
    $query -> bindParam(':hargatambahan',$hargatambahan, PDO::PARAM_STR);
    $query -> bindParam(':totalharga',$totalharga, PDO::PARAM_STR);
    $query -> bindParam(':fromdate',$fromdate, PDO::PARAM_STR);
    $query -> bindParam(':todate',$todate, PDO::PARAM_STR);
    $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
    $query -> execute();



    $_SESSION['msg']="Booking Successfully Updated";

    echo $fromdate.'akhir'.$todate;
  header('location:manage-book.php');
}
  ?>