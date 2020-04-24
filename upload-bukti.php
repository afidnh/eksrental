<?php

include('includes/config.php');

$redirect_to = $_SERVER['HTTP_REFERER'];

 if(isset($_POST['update']))
  {
$vimage1=$_FILES["img1"]["name"];
$id=intval($_GET['bid']);
$status=3;
move_uploaded_file($_FILES["img1"]["tmp_name"],"admin/img/vehicleimages/".$_FILES["img1"]["name"]);
$sql="update tblbooking set pembayaran=:vimage1, Status=:status where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Image updated successfully";
header('Location: '.$redirect_to);

}

?>