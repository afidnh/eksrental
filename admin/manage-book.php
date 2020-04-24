<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{
  if(isset($_POST['submit']))
  {
    $eid=intval($_GET['eid']);
    $status="2";
    $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
    $query -> execute();

    $_SESSION['msg']="Booking Successfully Cancelled";
  }


  if(isset($_POST['submit']))
  {
    $aeid=intval($_GET['aeid']);
    $subharga=$_POST['subharga'];
    $hargatambahan=$_POST['hargatambahan'];
    $totalharga=$_POST['TotalHarga'];
    $status=1;

    $sql = "UPDATE tblbooking SET Status=:status, SubHarga=:subharga, HargaTambahan=:hargatambahan, TotalHarga=:totalharga WHERE  id=:aeid";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> bindParam(':subharga',$subharga, PDO::PARAM_STR);
    $query -> bindParam(':hargatambahan',$hargatambahan, PDO::PARAM_STR);
    $query -> bindParam(':totalharga',$totalharga, PDO::PARAM_STR);
    $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
    $query -> execute();

    $_SESSION['msg']="Booking Successfully Confirmed";
  }


  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <link rel="shortcut icon" href="images/profile.png">
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Utomo Rental | Manage Booking</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link type="text/css" href='datatabel/jquery.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/responsive.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/buttons.dataTables.min.css' rel='stylesheet'>


  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include('include/header.php');?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include('include/sidebar.php');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-pencil"></i> Manage Booking</h1>
        </div>
      </div>
      

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
             <?php if(isset($_GET['eid']))
             {?>
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oh Snap! </strong>   <?php echo htmlentities($_SESSION['msg']);?>
              </div>
            <?php } ?>

            <?php if(isset($_GET['aeid']))
             {?>
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Your </strong>   <?php echo htmlentities($_SESSION['msg']);?>
              </div>
            <?php } ?>

            <table id="example" class="display responsive nowrap" style="width:100%">
              <thead>
               <tr>
                <th>No</th>
                <th>Name</th>
                <th>Vehicle</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Message</th>
                <th>Status</th>
                <th>Posting date</th>
                <th>Sub Total</th>
                <th>Ongkir + Driver</th>
                <th>Total</th>
                <th>Bukti Pembayaran</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              <?php $sql = "SELECT tblusers.FullName,tblbrands.BrandName,tblvehicles.nama,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.SubHarga,tblbooking.HargaTambahan,tblbooking.TotalHarga,tblbooking.pembayaran  from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblbrands on tblvehicles.kategori=tblbrands.id  ";
              $query = $dbh -> prepare($sql);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=1;
              if($query->rowCount() > 0)
              {
                foreach($results as $result)
                  {   
                  $id=$result->id;?> 
                    <tr>
                      <td><?php echo htmlentities($cnt);?></td>
                      <td><?php echo htmlentities($result->FullName);?></td>
                      <td><a href="edit-vehicles.php?id=<?php echo htmlentities($result->vid);?>" target="_blank"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->nama);?></a></td>
                        <td><?php echo htmlentities($result->FromDate);?></td>
                        <td><?php echo htmlentities($result->ToDate);?></td>
                        <td><?php echo htmlentities($result->message);?></td>
                        <td>
                            <?php 
                          if($result->Status==0)
                          {
                            echo htmlentities('Belum di konfirmasi');
                          } else if ($result->Status==1) {
                            echo htmlentities('Menunggu Pembayaran');
                          }else if ($result->Status==3) {
                            echo htmlentities('Pembayaran Selesai');
                          }else if ($result->Status==4) {
                            echo htmlentities('Persiapan');
                          }else if ($result->Status==5) {
                            echo htmlentities('Selesai');
                          }
                          else{
                            echo htmlentities('Cancelled');
                          }
                          ?>
                          
                        </td>
                        <td><?php echo htmlentities($result->PostingDate);?></td>
                        <td>
                          : Rp. <?php echo htmlentities($result->SubHarga);?>                       
                        </td>
                        <td>
                          :Rp. <?php echo htmlentities($result->HargaTambahan);?>
                        </td>
                        <td>
                          :Rp. <?php echo htmlentities($result->HargaTambahan+$result->SubHarga);?>
                        </td>
                        <td style='text-align:right'>
                          <?php
                          if ($result->pembayaran != null) {
                            echo '<img src="img/vehicleimages/'.$result->pembayaran.'" width="300" height="200" style="border:solid 1px #000">';
                          } else{
                            echo ": Belum Ada Pembayaran";
                          }
                          ?>
                          
                        </td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo htmlentities($result->id)?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span>Edit</a>
                        </td>
                      </tr>
                 <?php $cnt=$cnt+1; }} ?>  
                              
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
           <!-- ============ MODAL EDIT =============== -->
           <?php 
           foreach($results as $result)
                  {   
                  $id=$result->id; ?> 
                <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="myModalLabel">Update Booking</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal" method="post" action="update-book.php">
                        <div class="modal-body">
                          <div class="form-group">
                                <label class="control-label col-xs-3" >Tanggal Mulai</label>
                                <div class="col-xs-9">
                                   <input name="fromdate" class="form-control" type="datetime-local" value="<?php echo $result->FromDate;?>" style="width:335px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Tanggal Akhir</label>
                                <div class="col-xs-9">
                                   <input name="todate" class="form-control" type="datetime-local" value="<?php echo $result->ToDate;?>" style="width:335px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Sub Total (Rp)</label>
                                <div class="col-xs-9">
                                   <input name="subharga" class="form-control" type="text" value="<?php echo $result->SubHarga;?>" style="width:335px;">
                                    <input name="id" class="form-control" type="hidden" value="<?php echo $id;?>" placeholder="Kode Barang..." style="width:335px;" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Ongkir + Driver (Rp)</label>
                                <div class="col-xs-9">
                                   <input name="hargatambahan" class="form-control" type="text" value="<?php echo $result->HargaTambahan;?>" style="width:335px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Konfirmasi</label>
                                <div class="col-xs-9">
                                    <select name="status" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kategori" data-width="80%" placeholder="Pilih Kategori" required>
                                    <option value='1' selected>Setuju</option>
                                    <option value='4'>Persiapan Alat</option>
                                    <option value='5'>Selesai</option>
                                    <option value='2'>Cancel</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>

<?php } ?>

        </main>
        <!-- Essential javascripts for application to work-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="js/plugins/pace.min.js"></script>
        <!-- Page specific javascripts-->
        <!-- Google analytics script-->
        <script src="datatabel/jquery.dataTables.min.js"></script>
        <script src="datatabel/dataTables.responsive.min.js"></script>
        <script src="datatabel/dataTables.buttons.min.js"></script>
        <script src="datatabel/buttons.colVis.min.js"></script>

        <script>
         $(document).ready(function() {
          $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
            'colvis'
            ]
          } );
        } );
      </script>

    </body>
    </html>
    <?php } ?>