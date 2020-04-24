<?php 
session_start();
include('includes/config.php');
error_reporting(0);
$useremail=$_SESSION['login'];
$vhid=$_GET['vhid'];
$bid=$_GET['bid'];

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Utomo Rental | Vehicle Details</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">


    <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>


<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.kategori where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>  

<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560" style="height: 340px;"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="900" height="560" style="height: 340px;"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560" style="height: 340px;"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="900" height="560" style="height: 340px;"></div>
  <?php if($result->Vimage5=="")
{

} else {
  ?>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560" style="height: 340px;"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->nama);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>Rp<?php echo htmlentities($result->harga);?> </p>Per Jam
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-car" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->ModelYear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->kapasitas);?></h5>
              <p>Kapasitas (Ton)</p>
            </li>
       
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->MinSewa);?></h5>
              <p>Minimal Sewa (Jam)</p>
            </li>
          </ul>
        </div>
        <?php 
        $harga=$result->harga;
  }

$sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.nama,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.id as bid,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblbooking.SubHarga,tblbooking.HargaTambahan,tblbooking.TotalHarga,tblbooking.pembayaran  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.kategori where tblbooking.id=:bid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':bid', $bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
  $awal = strtotime($result->FromDate);
$akhir = strtotime($result->ToDate);
$diff  = $akhir - $awal;
$jam   = floor($diff / (60 * 60));
{  ?>

        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Rincian Pembayaran</a></li>
              <?php
              if ($result->Status == 1 || $result->Status == 3 || $result->Status == 4 || $result->Status == 5) { ?>
                <li role="presentation"><a href="#pembayaran" aria-controls="accessories" role="tab" data-toggle="tab">Transfer Pembayaran</a></li>
             <?php }
              ?>
              
            </ul>
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
               <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
                      <tr>
                      <td colspan = '4'><div style='text-align:right'>Biaya Rental : </div></td>
                      <td style='text-align:right'><?php echo $jam.' Jam'?></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($harga).',-';?></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($harga*$jam).',-';?></td>
                  </tr>      
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Ongkir + Driver : </div></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($result->HargaTambahan).',-';?></td>
                  </tr>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($result->TotalHarga);?></td>
                  </tr>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Dp (50%) : </div></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($result->TotalHarga*0.5).',-';?></td>
                  </tr>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Kembalian : </div></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($b['jual_kembalian']).',-';?></td>
                  </tr>
              </table>
              </div>
              <div role="tabpanel" class="tab-pane" id="pembayaran">
                <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
                      <tr>
                      <td colspan = '6'><div style='text-align:right'>Total Yang Harus Di Bayar : </div></td>
                      <td style='text-align:right'><?php echo 'Rp '.number_format($result->TotalHarga*0.5).',-';?></td>
                  </tr>      
                <?php
                $sql = "SELECT * from tblcontactusinfo";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $hasil=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($hasil as $hasil)
                    {  ?>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Atas Nama : </div></td>
                      <td style='text-align:right'><?php echo htmlentities($hasil->NamaBank);?></td>
                  </tr>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>No Rekening </div></td>
                      <td style='text-align:right'><?php echo htmlentities($hasil->NoBank); }}?></td>
                  </tr>
                  <?php 
                  if ($result->pembayaran != null) { ?>
                  <tr>
                      <td colspan = '6'><div style='text-align:right'>Bukti Pembayaran </div></td>
                      <td style='text-align:right'><img src="admin/img/vehicleimages/<?php echo htmlentities($result->pembayaran);?>" width="300" height="200" style="border:solid 1px #000"></td>
                  </tr>
              
            <?php } else{ ?>
               <form method="post" action="upload-bukti.php?bid=<?php echo $bid;?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Upload Bukti Pembayaran</label>
                   <input type="file" class="form-control" name="img1" required>
                </div>                      
                <div class="form-group">
                  <div class="form-control">
                    <button class="btn btn-primary" name="update" type="submit">Upload</button>
                  </div>
                </div>
               </form>
              <?php }?>
              </table>
              </div>
            </div>
          </div>
          
          </div>

   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="">
          <p><?php if($result->Status==1)
                { ?>
                  <a href="#" class="btn outline btn-xs active-btn">Diterima Dan Menunggu Pembayaran </a>
              <?php } else if($result->Status==2) { ?>
                <a href="#" class="btn outline btn-xs">Di Tolak</a>
              <?php } else if($result->Status==3) { ?>
                <a href="#" class="btn outline btn-xs">Pembayaran Selesai</a>
              <?php } else if($result->Status==4) { ?>
                <a href="#" class="btn outline btn-xs">Persiapan Alat</a>
              <?php } else if($result->Status==5) { ?>
                <a href="#" class="btn outline btn-xs">Selesai</a>
              <?php } else { ?> <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
                <?php } ?> </p>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Tanggal Sewa</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="fromdate" placeholder="Start Date" readonly value="<?php echo htmlentities($result->FromDate);?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="fromdate" placeholder="Start Date" readonly value="<?php echo htmlentities($result->FromDate);?>">
            </div>
            <div class="form-group">
              <p><b>Message:</b> <?php echo htmlentities($result->message);?> </p>
            </div>
            <!-- <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
              <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>
              <?php } ?> -->
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    <?php }} } ?>
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>


    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd'});
</script> 



</body>
</html>