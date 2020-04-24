<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{ 

  if(isset($_POST['submit']))
  {
    $nama=$_POST['nama'];
    $kategori=$_POST['kategori'];
    $ketentuan=$_POST['ketentuan'];
    $harga=$_POST['harga'];
    $modelyear=$_POST['modelyear'];
    $sewa=$_POST['sewa'];
    $kapasitas=$_POST['kapasitas'];
    $vimage1=$_FILES["img1"]["name"];
    $vimage2=$_FILES["img2"]["name"];
    $vimage3=$_FILES["img3"]["name"];
    $vimage4=$_FILES["img4"]["name"];
    $vimage5=$_FILES["img5"]["name"];
    move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
    move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
    move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
    move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
    move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

    $sql="INSERT INTO tblvehicles (nama,kategori,ketentuan,harga,kapasitas,ModelYear,MinSewa,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5) VALUES (:nama,:kategori,:ketentuan,:harga,:kapasitas,:modelyear,:sewa,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':nama',$nama,PDO::PARAM_STR);
    $query->bindParam(':kategori',$kategori,PDO::PARAM_STR);
    $query->bindParam(':ketentuan',$ketentuan,PDO::PARAM_STR);
    $query->bindParam(':harga',$harga,PDO::PARAM_STR);
    $query->bindParam(':kapasitas',$kapasitas,PDO::PARAM_STR);
    $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
    $query->bindParam(':sewa',$sewa,PDO::PARAM_STR);
    $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
    $query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
    $query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
    $query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
    $query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      $_SESSION['msg']="Vehicle posted successfully";
      header("location:manage-vehicle.php");
    }
    else 
    {
      $_SESSION['error']="Something went wrong. Please try again";
    }

  }
}

  ?>