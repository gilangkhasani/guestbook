<?php 
	!empty($_GET['location']) ? $location = $_GET['location']: $location = "";
	!empty($_GET['token']) ? $token = $_GET['token']: $token = "";
	!empty($_GET['type']) ? $type = $_GET['type']: $type = "";
	
	$arr_location = array("wd", "ar", "cr", "sr", "br");
	
	$q = "
		SELECT * 
		FROM token_auth
		WHERE location = '".$location."'
		AND token = '".$token."'
		AND url_hit = 1
		AND url_expired = 0
	";
	$count = db_num_rows($q);
	$row = db_query($q);
	
	if ($count == 0){
		echo "<script>alert('No Access Granted, Please rescan QR Code !!! ');</script>";
		exit;
	}
	
	
?>
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
		
		<div class="container">
			<?php
				
				date_default_timezone_set("Asia/Jakarta");
				if (isset($_POST['submit'])){
					$pesan = array();
				
					empty($_POST['nama']) ? $nama = '' : $nama = $_POST['nama'];
					empty($_POST['email']) ? $email = '' : $email = $_POST['email'];
					empty($_POST['msisdn']) ? $msisdn = '' : $msisdn = $_POST['msisdn'];
					empty($_POST['employee']) ? $employee = '' : $employee = $_POST['employee'];
					if($nama!=''){
						$explode = explode(" ",  $nama);
						$username = $explode[0];
					}else{
						$username = '';
					}
					if($_POST['img'] !=''){
						$myimage = $_POST['img'];
						list($type, $myimage2) = explode(';', $myimage);
						list(, $myimage3) = explode(',', $myimage2);
						$myimage4 = base64_decode($myimage3);
					}
					if($_POST['img-ktp'] !=''){
						$myimage_ktp = $_POST['img-ktp'];
						list($type, $myimage_ktp2) = explode(';', $myimage_ktp);
						list(, $myimage_ktp3) = explode(',', $myimage_ktp2);
						$myimage_ktp4 = base64_decode($myimage_ktp3);
					}
					
					if($nama == '' || $email = '' || $msisdn = '' || $employee = '' ||$myimage4 ==''||$myimage_ktp4 ==''){
						$pesan['status'] = "All Field required...!!!";
						$pesan['link'] = "input";
						echo "<script>alert('".$pesan['status']."');</script>";
					}elseif(strlen($myimage) < 700|| strlen($myimage_ktp) < 700){
						$pesan['status'] = "Photo Scan not complete...!!!";
						$pesan['link'] = "input";
						echo "<script>alert('".$pesan['status']."');</script>";
					}else{
						// check guest still check in
						// upload foto dan ktp	
						$imagename = date('Y').date('m').date('d').date('his').str_replace(" ","",$_POST['nama']).'.png';
						file_put_contents('file/photo/'.$imagename, $myimage4);
						$imagename2 = date('Y').date('m').date('d').date('his')."_ktp_".str_replace(" ","",$_POST['nama']).'.png';
						file_put_contents('file/photo/'.$imagename2, $myimage_ktp4);
						// insert record to table
						$insert = "INSERT INTO guestbook_windu (nama, msisdn, company, email, nik_pic_telkomsel, agenda, pesan, foto_wajah, foto_id, type, id_location, token, created_date) VALUES
						('".$_POST['nama']."', '".$_POST['msisdn']."', '".$_POST['company']."','".$_POST['email']."','".$_POST['nik_pic_telkomsel']."', '".$_POST['agenda']."', '".$_POST['pesan']."', '".$imagename."', '".$imagename2."', '".$_POST['type']."', '".$_POST['location']."', '".$_POST['token']."', NOW())";
						$excec = mysqli_query($database->connection, $insert);
						

						if($excec){
							$id = mysqli_insert_id($database->connection);
							$update = "
								UPDATE token_auth
								SET
									url_expired = 1
								WHERE 
									token = '".$_POST['token']."'
								AND
									location = '".$_POST['location']."'
							";
							mysqli_query($database->connection, $update);
							//send_sms($_POST['nomerHP'],$id,$_POST['nama'],$_POST['msisdn'],$_POST['company']);
							$pesan['status'] = "Successfully create guestbook...$msisdn";
							echo "<script>alert('".$pesan['status']."');</script>";
							$pesan['link'] = "ticket?uri=".$_POST['token']."&id_ticket=".$id;
						}else{
							$pesan['status'] = mysqli_error($database->connection);
						}
					} 
					echo status($pesan['status']);
					echo redirect($pesan['link']);
					return;
				} 
				if (isset($_POST['vendor-submit'])){
					$pesan = array();
				
					empty($_POST['nama_vendor']) ? $nama = '' : $nama = $_POST['nama_vendor'];
					empty($_POST['email_vendor']) ? $email = '' : $email = $_POST['email_vendor'];
					empty($_POST['msisdn_vendor']) ? $msisdn = '' : $msisdn = $_POST['msisdn_vendor'];
					empty($_POST['employee_vendor']) ? $employee = '' : $employee = $_POST['employee_vendor'];
					if($nama!=''){
						$explode = explode(" ",  $nama);
						$username = $explode[0];
					}else{
						$username = '';
					}
					if($_POST['img_vendor'] !=''){
						$myimage = $_POST['img_vendor'];
						list($type, $myimage2) = explode(';', $myimage);
						list(, $myimage3) = explode(',', $myimage2);
						$myimage4 = base64_decode($myimage3);
					}
					if($_POST['img-ktp_vendor'] !=''){
						$myimage_ktp = $_POST['img-ktp_vendor'];
						list($type, $myimage_ktp2) = explode(';', $myimage_ktp);
						list(, $myimage_ktp3) = explode(',', $myimage_ktp2);
						$myimage_ktp4 = base64_decode($myimage_ktp3);
					}
					
					if($nama == '' || $email = '' || $msisdn = '' || $employee = '' ||$myimage4 ==''||$myimage_ktp4 ==''){
						$pesan['status'] = "All Field required...!!!";
						$pesan['link'] = "input";
						echo "<script>alert('".$pesan['status']."');</script>";
					}elseif(strlen($myimage) < 700|| strlen($myimage_ktp) < 700){
						$pesan['status'] = "Photo Scan not complete...!!!";
						$pesan['link'] = "input";
						echo "<script>alert('".$pesan['status']."');</script>";
					}else{
						// check guest still check in
						// upload foto dan ktp	
						$imagename = date('Y').date('m').date('d').date('his').str_replace(" ","",$_POST['nama_vendor']).'.png';
						file_put_contents('file/photo/'.$imagename, $myimage4);
						$imagename2 = date('Y').date('m').date('d').date('his')."_ktp_".str_replace(" ","",$_POST['nama_vendor']).'.png';
						file_put_contents('file/photo/'.$imagename2, $myimage_ktp4);
						// insert record to table
						$insert = "INSERT INTO guestbook_windu (nama, msisdn, company, email, nik_pic_telkomsel, agenda, pesan, foto_wajah, foto_id, type, id_location, token, created_date) VALUES
						('".$_POST['nama_vendor']."', '".$_POST['msisdn_vendor']."', '".$_POST['company_vendor']."','".$_POST['email_vendor']."','".$_POST['nik_pic_telkomsel_vendor']."', '".$_POST['agenda_vendor']."', '".$_POST['pesan_vendor']."', '".$imagename."', '".$imagename2."', '".$_POST['type_vendor']."', '".$_POST['location_vendor']."', '".$_POST['token_vendor']."', NOW())";
						$excec = mysqli_query($database->connection, $insert);
						
						if($excec){
							$id = mysqli_insert_id($database->connection);
							$update = "
								UPDATE token_auth
								SET
									url_expired = 1
								WHERE 
									token = '".$_POST['token_vendor']."'
								AND
									location = '".$_POST['location_vendor']."'
							";
							mysqli_query($database->connection, $update);
							//send_sms($_POST['nomerHP'],$id,$_POST['nama'],$_POST['msisdn'],$_POST['company']);
							$pesan['status'] = "Successfully create guestbook...$msisdn";
							echo "<script>alert('".$pesan['status']."');</script>";
							$pesan['link'] = "ticket?uri=".$_POST['token_vendor']."&id_ticket=".$id;
						}else{
							 $pesan['status'] = mysqli_error($database->connection);
						} 
					} 
					echo status($pesan['status']);
					echo redirect($pesan['link']);
					return;
					
				} 
				if (isset($_POST['paket-submit'])){
					$pesan = array();
						
					// insert record to table
					$insert = "INSERT INTO guestbook_windu (nama, company, nik_pic_telkomsel, type, id_location, token, created_date) VALUES
					('".$_POST['nama_paket']."', '".$_POST['company_paket']."', '".$_POST['nik_pic_telkomsel_paket']."', '".$_POST['type_paket']."', '".$_POST['location_paket']."', '".$_POST['token_paket']."', NOW())";
					$excec = mysqli_query($database->connection, $insert);
					
					if($excec){
						$id = mysqli_insert_id($database->connection);
						$update = "
							UPDATE token_auth
							SET
								url_expired = 1
							WHERE 
								token = '".$_POST['token_paket']."'
							AND
								location = '".$_POST['location_paket']."'
						";
						mysqli_query($database->connection, $update);
						//send_sms($_POST['nomerHP'],$id,$_POST['nama'],$_POST['msisdn'],$_POST['company']);
						$pesan['status'] = "Successfully create guestbook...";
						echo "<script>alert('".$pesan['status']."');</script>";
						$pesan['link'] = "ticket?uri=".$_POST['token_paket']."&id_ticket=".$id;
					}else{
						$pesan['status'] = mysqli_error($database->connection);
					} 
					
					echo status($pesan['status']);
					echo redirect($pesan['link']);
					return;
				} 
			?>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row" style="margin-bottom:15px;">
								<center>
									<img src="<?php echo url('themes/img/Telkomsel_2013.png')?>" style="" alt="loading" id="loading_search_ldap">
								</center>
							</div>
							<!--
							<div class="row">
								<div class="col-xs-4">
									<a href="#" class="active" id="tamu-form-link">Tamu</a>
								</div>
								<div class="col-xs-4">
									<a href="#" id="vendor-form-link">Vendor</a>
								</div>
								<div class="col-xs-4">
									<a href="#" id="paket-form-link">Paket</a>
								</div>
							</div>
							!-->
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<?php 
										switch($type){
											case "tamu" :
									?>
									
									<form id="tamu-form" method="post" role="form" style="display: block;" onsubmit="return validateForm()">
										<div class="form-group">
											<label for="name" class="cols-sm-2 control-label">Name</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="nama" id="nama" maxlength="50"  placeholder="Enter your Name (Max 50 Character)" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="cols-sm-2 control-label">Email</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
													<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="msisdn" class="cols-sm-2 control-label">Phone Number</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
													<input type="number" class="form-control" name="msisdn" id="msisdn" value="62"  placeholder="Enter your Phone Number" required  />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="company" class="cols-sm-2 control-label">Company</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="company" id="company"  placeholder="Enter your Company" required />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="confirm" class="cols-sm-2 control-label">PIC Telkomsel</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="name_pic_telkomsel" id="name_pic_telkomsel" onclick="getDataEmployee('nik_pic_telkomsel', 'name_pic_telkomsel')"  placeholder="Search PIC Telkomsel" required  />
													<input type="hidden" class="form-control" name="nik_pic_telkomsel" id="nik_pic_telkomsel"  placeholder="NIK PIC Telkomsel" />
													
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="agenda" class="cols-sm-2 control-label">Agenda </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="agenda" id="agenda"  placeholder="Enter Your Agenda" required />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Message </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="pesan" id="pesan" maxlength="50"  placeholder="Enter Your Message (Max 50 Character)" required />
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Identity Card Photo </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<div id="my_camera_identity_card" class="my_camera" style=" height:240px;"></div>
													<input type="button" class="btn btn-primary btn-xs" value="Take Snapshot" onClick="take_snapshot_identity()">
													<div id="my_result_identity_card"></div>
													<input type="hidden" class="form-control" name="img-ktp" id="img-ktp"  placeholder="Enter Your Message"/>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Input Photo </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<div id="my_camera_photo" class="my_camera" style=" height:240px;"></div>
													<input type="button" class="btn btn-primary btn-xs" value="Take Snapshot" onClick="take_snapshot_photo()">
													<div id="my_result_photo"></div>
													<input type="hidden" class="form-control" name="img" id="img"  placeholder="Enter Your Message"/>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="entercode-grid">
												<div class="enter-code" style="overflow-x:auto;">
													<div class="g-recaptcha" data-sitekey="6LcYrT4UAAAAAEmKuh04y3JUJ6n5EEW79Ue_y54h"></div>
												</div>
												
												<div class="enter-code" id="notif" style="display:none;"></div>
												<div class="clearfix"></div>               				
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="hidden" class="form-control" name="type" id="type" value="TAMU" placeholder="" required />
													<input type="hidden" class="form-control" name="location" id="location" value="<?php echo $location?>" placeholder="" required />
													<input type="hidden" class="form-control" name="token" id="token" value="<?php echo $token?>" placeholder="" required />
													<input type="submit" name="submit" id="submit" tabindex="4" class="form-control btn btn-login" value="Submit">
												</div>
											</div>
										</div>
									</form>
									<?php
										break;
										case "vendor" :
									?>
									
									<form id="vendor-form" method="post" role="form"  onsubmit="return validateFormVendor()">
										<div class="form-group">
											<label for="name" class="cols-sm-2 control-label">Name</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="nama_vendor" id="nama_vendor" maxlength="50"  placeholder="Enter your Name (Max 50 Character)" required />
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="cols-sm-2 control-label">Email</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
													<input type="email" class="form-control" name="email_vendor" id="email_vendor"  placeholder="Enter your Email" required />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="msisdn" class="cols-sm-2 control-label">Phone Number</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
													<input type="number" class="form-control" name="msisdn_vendor" id="msisdn_vendor" value="62"  placeholder="Enter your Phone Number" required  />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="company" class="cols-sm-2 control-label">Company</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<select class="form-control" name="company_vendor" id="company_vendor">
														<option value="">-- Enter Your Company--</option>
														<?php
															$query = "
																SELECT * 
																FROM vendor_company
															";
															$data = db_query2list($query);
															foreach($data as $result){
														?>
																<option value="<?php echo $result->vendor_name?>"><?php echo $result->vendor_name?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="confirm" class="cols-sm-2 control-label">PIC Telkomsel</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="name_pic_telkomsel_vendor" id="name_pic_telkomsel_vendor" onclick="getDataEmployee('nik_pic_telkomsel_vendor', 'name_pic_telkomsel_vendor')"  placeholder="Search PIC Telkomsel" required  />
													
													<input type="hidden" class="form-control" name="nik_pic_telkomsel_vendor" id="nik_pic_telkomsel_vendor"  placeholder="NIK PIC Telkomsel" />
													
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="agenda" class="cols-sm-2 control-label">Agenda </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="agenda_vendor" id="agenda_vendor"  placeholder="Enter Your Agenda" required />
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Message </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="pesan_vendor" id="pesan_vendor" maxlength="50"  placeholder="Enter Your Message (Max 50 Character)" required />
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Identity Card Photo </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<div id="my_camera_identity_card_vendor" class="my_camera" style=" height:240px;"></div>
													
													<input type="button" class="btn btn-primary btn-xs" value="Take Snapshot" onClick="take_snapshot_identity_vendor()">
													
													<div id="my_result_identity_card_vendor"></div>
													<input type="hidden" class="form-control" name="img-ktp_vendor" id="img-ktp_vendor"  placeholder="Enter Your Message"/>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="pesan" class="cols-sm-2 control-label">Input Photo </label>
											<div class="cols-sm-10">
												<div class="input-group">
													<div id="my_camera_photo_vendor" class="my_camera" style=" height:240px;"></div>
													
													<input type="button" class="btn btn-primary btn-xs" value="Take Snapshot" onClick="take_snapshot_photo_vendor()">
													
													<div id="my_result_photo_vendor"></div>
													<input type="hidden" class="form-control" name="img_vendor" id="img_vendor"  placeholder="Enter Your Message"/>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="entercode-grid">
												<div class="enter-code" style="overflow-x:auto;">
													<div class="g-recaptcha" data-sitekey="6LcYrT4UAAAAAEmKuh04y3JUJ6n5EEW79Ue_y54h"></div>
												</div>
												
												<div class="enter-code" id="notif" style="display:none;"></div>
												<div class="clearfix"></div>               				
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="hidden" class="form-control" name="type_vendor" id="type_vendor" value="VENDOR" placeholder="" required />
													<input type="hidden" class="form-control" name="location_vendor" id="location_vendor" value="<?php echo $location?>" placeholder="" required />
													<input type="hidden" class="form-control" name="token_vendor" id="token_vendor" value="<?php echo $token?>" placeholder="" required />
													<input type="submit" name="vendor-submit" id="vendor-submit" tabindex="4" class="form-control btn btn-register" value="Submit">
												</div>
											</div>
										</div>
									</form>
									
									<?php 
										break;
										case "paket" :
									?>
									
									<form id="paket-form" method="post" role="form" >
										
										<div class="form-group">
											<label for="name" class="cols-sm-2 control-label">Name</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="nama_paket" id="nama_paket" maxlength="50"  placeholder="Enter your Name (Max 50 Character)" required />
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="name" class="cols-sm-2 control-label">Company</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="company_paket" id="company_paket" maxlength="50"  placeholder="Enter Your Company" required />
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label for="confirm" class="cols-sm-2 control-label">PIC Telkomsel</label>
											<div class="cols-sm-10">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
													<input type="text" class="form-control" name="name_pic_telkomsel_paket" id="name_pic_telkomsel_paket" onclick="getDataEmployee('nik_pic_telkomsel_paket', 'name_pic_telkomsel_paket')"  placeholder="Search PIC Telkomsel" required  />
													
													<input type="hidden" class="form-control" name="nik_pic_telkomsel_paket" id="nik_pic_telkomsel_paket"  placeholder="NIK PIC Telkomsel" />
													
												</div>
											</div>
										</div>

										
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6 col-sm-offset-3">
													<input type="hidden" class="form-control" name="type_paket" id="type_paket" value="PAKET" placeholder="" required />
													<input type="hidden" class="form-control" name="location_paket" id="location_paket" value="<?php echo $location?>" placeholder="" required />
													<input type="hidden" class="form-control" name="token_paket" id="token_paket" value="<?php echo $token?>" placeholder="" required />
													<input type="submit" name="paket-submit" id="paket-submit" tabindex="4" class="form-control btn btn-register" value="Submit">
												</div>
											</div>
										</div>
									</form>
									<?php
										break;
										default : 
											echo "<script>alert('No Access Granted, Please rescan QR Code !!! ');</script>";
											echo "<p style=\"text-align:center;\">No Access Granted, Please rescan QR Code !!!</p>";
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Search Employee</h4>
					</div>
					<div class="modal-body">
						<div class="box-body">
							<div id="detail_content">
								<center>
									<input type="text" name="search_by_ldap" id="search_by_ldap" class="form-control search" placeholder="Search By Name" style="display:inline; width:45%"/>
									<input type="hidden" name="field_nik" id="field_nik" class="form-control search" placeholder="Search By Name" style="display:inline; width:45%"/>
									<input type="hidden" name="field_name" id="field_name" class="form-control search" placeholder="Search By Name" style="display:inline; width:45%"/>
									<input type="button" value="Search" id="b-search-ldap" class="btn btn-primary btn-md">
								</center>
								<center>
									<img src="<?php echo url('themes/img/loading.GIF')?>" style="width:30px; display:none;" alt="loading" id="loading_search_ldap">
									<p id="null_message_ldap"></p>
								</center>
								<table class="table table-responsive" id="table">
									<thead>
										<tr>
											<th>Select</th>
											<th>Name</th>
											<th>Phone Number</th>
										</tr>
									</thead>
									<tbody id="tableValue">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var w = $(window).width() * (65 / 100);
			browserDetection();
			Webcam.set({
				//width: 250,
				width: w,
				height: 240,
				image_format: 'jpeg',
				jpeg_quality: 65
			});
			Webcam.attach( '#my_camera_identity_card' );
			Webcam.attach( '#my_camera_photo' );
			Webcam.attach( '#my_camera_identity_card_vendor' );
			Webcam.attach( '#my_camera_photo_vendor' );
			
			function take_snapshot_identity() {
				// take snapshot and get image data
				Webcam.snap( function(data_uri) {
					// display my_result in page
					document.getElementById('my_result_identity_card').innerHTML = 
						'<img style="width:75%;" src="'+data_uri+'"/>';
					document.getElementById('img-ktp').value = data_uri;
				} );
			}
			
			function take_snapshot_photo() {
				// take snapshot and get image data
				Webcam.snap( function(data_uri) {
					// display my_result in page
					document.getElementById('my_result_photo').innerHTML = 
						'<img style="width:75%;" src="'+data_uri+'"/>';
					document.getElementById('img').value = data_uri;
				} );
			}
			
			function take_snapshot_identity_vendor() {
				// take snapshot and get image data
				Webcam.snap( function(data_uri) {
					// display my_result in page
					document.getElementById('my_result_identity_card_vendor').innerHTML = 
						'<img style="width:75%;" src="'+data_uri+'"/>';
					document.getElementById('img-ktp_vendor').value = data_uri;
				} );
			}
			
			function take_snapshot_photo_vendor() {
				// take snapshot and get image data
				Webcam.snap( function(data_uri) {
					// display my_result in page
					document.getElementById('my_result_photo_vendor').innerHTML = 
						'<img style="width:75%;" src="'+data_uri+'"/>';
					document.getElementById('img_vendor').value = data_uri;
				} );
			}
			
			function getDataEmployee(field_nik, field_name){
				$("#field_nik").val(field_nik);
				$("#field_name").val(field_name);
				
				$('#search_by_ldap').val('');
				$('#tableValue').html('');
				
				$("#myModal").modal();
			}
			
			function getNIK(nik, nama, field_nik, field_name){
				$( function() {
					$("#" + field_nik).val(nik);
					$("#" + field_name).val(nama);
					
					$('#search_by_ldap').val('');
					$('#tableValue').html('');
					
					$('#myModal').modal('hide');
				} );
			}
			
			function browserDetection() {
				// Opera 8.0+
				var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

				// Firefox 1.0+
				var isFirefox = typeof InstallTrigger !== 'undefined';

				// Safari 3.0+ "[object HTMLElementConstructor]" 
				var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

				// Internet Explorer 6-11
				var isIE = /*@cc_on!@*/false || !!document.documentMode;

				// Edge 20+
				var isEdge = !isIE && !!window.StyleMedia;

				// Chrome 1+
				var isChrome = !!window.chrome && !!window.chrome.webstore;

				// Blink engine detection
				var isBlink = (isChrome || isOpera) && !!window.CSS;
				
				if(isIE || !navigator.getUserMedia && !isFirefox && !isSafari){
					alert("This Browser is not supported for this application, please use another browser. Recommend Browser Chrome ");
				}
				
			}
			
			function validateForm(){
				var img_ktp = document.forms["myForm"]["img-ktp"].value;
				var img = document.forms["myForm"]["img"].value;
				if (img_ktp == "") {
					alert("Identity Card Photo Still empty");
					return false;
				} else if (img == "") {
					alert("Input Photo Still empty");
					return false;
				} else {
					return true;
				}
			}
			
			function validateFormVendor(){
				var img_ktp = document.forms["myForm"]["img-ktp_vendor"].value;
				var img = document.forms["myForm"]["img_vendor"].value;
				if (img_ktp == "") {
					alert("Identity Card Photo Still empty");
					return false;
				} else if (img == "") {
					alert("Input Photo Still empty");
					return false;
				} else {
					return true;
				}
			}
			
			/* function detectmob() { 
				if( navigator.userAgent.match(/Android/i)
					|| navigator.userAgent.match(/webOS/i)
					|| navigator.userAgent.match(/iPhone/i)
					|| navigator.userAgent.match(/iPad/i)
					|| navigator.userAgent.match(/iPod/i)
					|| navigator.userAgent.match(/BlackBerry/i)
					|| navigator.userAgent.match(/Windows Phone/i)
				){
					alert("asdf");
					return true;
				} else {
					alert("fdfdfd");
					return false;
				}
			}
			detectmob(); */
			
			function cekPhoneNumber(){
				var msisdn = $('#msisdn').val();
				var str = msisdn.substr(0, 5);
				var flag = false;
				var prefix = [
					"62811",
					"62812",
					"62813",
					"62821",
					"62822",
					"62823",
					"62851",
					"62852",
					"62853"
				];
				
				for(i = 0; i < prefix.length; i++){
					if( str == prefix[i] ){
						flag = true;
					}
				}
				
				if(!flag){
					alert("Harus Menggunakan No Telkomsel");
				}
			}
			
			$(document).ready(function(){
				$('#b-search-ldap').on( 'click', function () {
					
					var search_by_ldap = $('#search_by_ldap').val();
					var field_nik = $('#field_nik').val();
					var field_name = $('#field_name').val();
					
					var fdata = {search_by_ldap: search_by_ldap, field_nik: field_nik, field_name: field_name};
					
					$('#loading_search_ldap').show();
					$.ajax({
						type:"GET",
						url: "<?php echo url('page/ajax-karyawan.php')?>",
						dataType:'json',
						error: function (request,status, error) {
							console.log(request);
						},
						data:fdata
					}).done(function(data){
						console.log(data);
						var count = data.output_array.count;
						if(data.output_array.count > 0 || data.output_array.length > 0){
							//console.log(data);
							$('#loading_search_ldap').hide();
							$('#null_message_ldap').html('');
							var ftext;
						} else {
							$('#null_message_ldap').html('<b>Data Tidak Ditemukan</b>');
							$('#loading_search_ldap').hide();
						}
						
						$('#tableValue').html(data.content);
					}).fail(function(data){
						console.log(data);
						//alert("terjadi kesalahan, silahkan refresh ulang");
					});
				});
				
				$('#tamu-form-link').click(function(e) {
					$("#tamu-form").delay(100).fadeIn(100);
					$("#vendor-form").fadeOut(100);
					$("#paket-form").fadeOut(100);
					$('#vendor-form-link').removeClass('active');
					$('#paket-form-link').removeClass('active');
					$(this).addClass('active');
					e.preventDefault();
				});
				
				$('#vendor-form-link').click(function(e) {
					$("#vendor-form").delay(100).fadeIn(100);
					$("#paket-form").fadeOut(100);
					$("#tamu-form").fadeOut(100);
					$('#paket-form-link').removeClass('active');
					$('#tamu-form-link').removeClass('active');
					$(this).addClass('active');
					e.preventDefault();
				});
				
				$('#paket-form-link').click(function(e) {
					$("#paket-form").delay(100).fadeIn(100);
					$("#vendor-form").fadeOut(100);
					$("#tamu-form").fadeOut(100);
					$('#vendor-form-link').removeClass('active');
					$('#tamu-form-link').removeClass('active');
					$(this).addClass('active');
					e.preventDefault();
				});
				
			});

		</script>
	</body>
</html>