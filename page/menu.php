<?php 
	!empty($_GET['location']) ? $location = $_GET['location']: $location = "";
	!empty($_GET['token']) ? $token = $_GET['token']: $token = "";
	
	$arr_location = array("wd", "ar", "cr", "sr", "br");
	
	$q = "
		SELECT * 
		FROM token_auth
		WHERE location = '".$location."'
		AND token = '".$token."'
		AND url_expired = 0
		AND url_hit = 0
	";
	$count = db_num_rows($q);
	$row = db_query($q);
	
	if ($count == 0){
		echo "<script>alert('No Access Granted, Please rescan QR Code !!! ');</script>";
		exit;
	}
	$update = "
		UPDATE token_auth
		SET
			url_hit = 1
		WHERE 
			id_token = '".$row->id_token."'
	";
	mysqli_query($database->connection, $update);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buku Tamu Digital</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
  <link href='https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,400italic,300italic,300|Raleway:300,400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="<?php echo url('themes/css/font-awesome.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?php echo url('themes/css/bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?php echo url('themes/css/animate.css')?>">
  <link rel="stylesheet" type="text/css" href="<?php echo url('themes/css/menu-style.css')?>">
  
  <!-- =======================================================
    Theme Name: Maundy
    Theme URL: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
	
	<div class="content">
		<div class="container wow fadeInUp delay-03s">
		  <div class="row">
			<div class="logo text-center">
			  <img src="<?php echo url('themes/img/Telkomsel_2013.png')?>" alt="logo" >
			  <h2>BUKU TAMU DIGITAL TELKOMSEL</h2>
			</div>

			<div id="countdown" >
				<div class="day"><a href="<?php echo url('form?location='.$location."&token=".$token."&type=tamu")?>" style="color:white; text-decoration:none;" title="tamu">TAMU</a></div>
				<div class="day"><a href="<?php echo url('form?location='.$location."&token=".$token."&type=vendor")?>" style="color:white; text-decoration:none;" title="tamu">VENDOR</a></div>
				<div class="day"><a href="<?php echo url('form?location='.$location."&token=".$token."&type=paket")?>" style="color:white; text-decoration:none;" title="tamu">PAKET</a></div>
			</div>
			<h2 class="subs-title text-center"></h2>
			<div class="subcription-info text-center">
			
			</div>
		  </div>
		</div>
		<section>
		  <div class="container">
			<div class="row bort text-center">
				<div class="social">
					© Copyright IT SUPPORT BUSINESS JAWA BARAT.
					<div class="credits">
						<!--
						  All the links in the footer should remain intact. 
						  You can delete the links only if you purchased the pro version.
						  Licensing information: https://bootstrapmade.com/license/
						  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Maundy
						-->
						GA DEPARTMENT REGIONAL JAWA BARAT
					</div>
				</div>
			</div>
		  </div>
		</section>
	</div>
  
	<script src="<?php echo url('themes/js/jquery.min.js')?>"></script>
	<script src="<?php echo url('themes/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo url('themes/js/wow.js')?>"></script>
	<script src="<?php echo url('themes/js/custom.js')?>"></script>
	<script src="<?php echo url('themes/js/contactform.js')?>"></script>

</body>

</html>

