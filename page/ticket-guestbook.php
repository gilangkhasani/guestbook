<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Website CSS style -->
		<link href="<?php echo url('themes/css/bootstrap.css')?>" rel="stylesheet">
		<link href="<?php echo url('themes/css/style.css')?>" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Form Guestbook Telkomsel Branch Bandung</title>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
		<script src="<?php echo url('themes/js/webcam.min.js')?>"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo url('themes/js/bootstrap.js')?>"></script>
		<style>
			body {
				padding-top: 90px;
			}
			.panel-login {
				border-color: #ccc;
				-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
				-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
				box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			}
			.panel-login>.panel-heading {
				color: #00415d;
				background-color: #fff;
				border-color: #fff;
				text-align:center;
			}
			.panel-login>.panel-heading a{
				text-decoration: none;
				color: #666;
				font-weight: bold;
				font-size: 15px;
				-webkit-transition: all 0.1s linear;
				-moz-transition: all 0.1s linear;
				transition: all 0.1s linear;
			}
			.panel-login>.panel-heading a.active{
				color: #b92525;
				font-size: 18px;
			}
			.panel-login>.panel-heading hr{
				margin-top: 10px;
				margin-bottom: 0px;
				clear: both;
				border: 0;
				height: 1px;
				background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
				background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
				background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
				background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			}
			.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
				height: 45px;
				border: 1px solid #ddd;
				font-size: 16px;
				-webkit-transition: all 0.1s linear;
				-moz-transition: all 0.1s linear;
				transition: all 0.1s linear;
			}
			.panel-login input:hover,
			.panel-login input:focus {
				outline:none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
				box-shadow: none;
				border-color: #ccc;
			}
			.btn-login {
				background-color: #59B2E0;
				outline: none;
				color: #fff;
				font-size: 14px;
				height: auto;
				font-weight: normal;
				padding: 14px 0;
				text-transform: uppercase;
				border-color: #59B2E6;
			}
			.btn-login:hover,
			.btn-login:focus {
				color: #fff;
				background-color: #53A3CD;
				border-color: #53A3CD;
			}
			.forgot-password {
				text-decoration: underline;
				color: #888;
			}
			.forgot-password:hover,
			.forgot-password:focus {
				text-decoration: underline;
				color: #666;
			}

			.btn-register {
				background-color: #1CB94E;
				outline: none;
				color: #fff;
				font-size: 14px;
				height: auto;
				font-weight: normal;
				padding: 14px 0;
				text-transform: uppercase;
				border-color: #1CB94A;
			}
			.btn-register:hover,
			.btn-register:focus {
				color: #fff;
				background-color: #1CA347;
				border-color: #1CA347;
			}
		</style>
	</head>
	<body>
		<?php
			!empty($_GET['uri']) ? $uri = $_GET['uri']: $uri = "";
			!empty($_GET['id_ticket']) ? $id_ticket = $_GET['id_ticket']: $id_ticket = "";
			$query = "
				SELECT * 
				FROM guestbook_windu a 
				JOIN karyawan_jabar b ON (a.nik_pic_telkomsel = b.nik)
				JOIN location c ON (a.id_location = c.id_location)
				WHERE token = '".$uri."'
				AND id_guestbook = '".$id_ticket."'
				AND DATE(a.created_date) = CURDATE()
			";
			$row = db_query($query);
			$count = db_num_rows($query);
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<?php
							if($count > 0){
								switch($row->type){
									case "TAMU":
						?>
								<div class="panel-heading">
									<h3>SELAMAT DATANG</h3>
									<h4>di Kantor Tsel. <?php echo $row->location_name?></h4>
									<h5>Jabotabek Jabar</h5>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<h5 style="text-align:center;">Ticket Anda : <?php echo $row->id_guestbook?></h5>
											<table class="table">
												<tbody>
													<tr>
														<td>Nama</td>
														<td><?php echo $row->nama?></td>
													</tr>
													<tr>
														<td>Vendor</td>
														<td><?php echo $row->company?></td>
													</tr>
													<tr>
														<td>PIC Tsel</td>
														<td><?php echo $row->fullname?></td>
													</tr>
												</tbody>
											</table>
											<ul>
												<li>Jangan close Windows ini</li>
												<li>Tunjukkan ini untuk menukar kartu akses</li>
											</ul>
										</div>
									</div>
								</div>
						<?php
								break;
								case "VENDOR":
						?>	
								<div class="panel-heading">
									<h3>SELAMAT BEKERJA</h3>
									<h4>di Kantor Tsel. <?php echo $row->location_name?></h4>
									<h5>Jabotabek Jabar</h5>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<h5 style="text-align:center;">Ticket Anda : <?php echo $row->id_guestbook?></h5>
											<table class="table">
												<tbody>
													<tr>
														<td>Nama</td>
														<td><?php echo $row->nama?></td>
													</tr>
													<tr>
														<td>Vendor</td>
														<td><?php echo $row->company?></td>
													</tr>
													<tr>
														<td>PIC Tsel</td>
														<td><?php echo $row->fullname?></td>
													</tr>
												</tbody>
											</table>
											<ul>
												<li>Jangan close Windows ini</li>
												<li>Tunjukkan ini untuk menukar kartu akses</li>
											</ul>
										</div>
									</div>
								</div>

						<?php
								break;
								case "PAKET":
						?>	
								<div class="panel-heading">
									Terima Kasih.
									Paket akan disampaikan <?php echo $row->fullname?>
								</div>
						<?php
									break;
									default:
										"No Access";
								}
							} else {
						?>
								<div class="panel-heading">
									No Access
								</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
