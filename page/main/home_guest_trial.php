<div class="row">
	<div class="col-md-4">
		<div class="panel panel-primary" style="border-color:#eb525d">
			<div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
				<h4 style="width:50%;float:left;">Input Photo</h4>
			</div>
			<div class="panel-body">
                <div class="col-md-12" style="text-align: center;">
				<!--<a class="btn btn-info btn-search" data-toggle="modal" data-target="#modalCamera">Camera</a>-->
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <a data-toggle="modal" data-target="#modalCamera"><img id="scanned-img" src="themes/img/no_avatar.jpg" width="220" height="140"></a>
                        </div>
						<div>
				
						</div>
                    </div>
                </div>
                <!-- <div id="data"></div> -->
            </div>
		</div>
		
		<div class="panel panel-primary" style="border-color:#eb525d">
			<div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
				<h4 style="width:50%;float:left;">Identity Card</h4>
			</div>
			<div class="panel-body">
                <div class="col-md-12" style="text-align: center;">
				<!--<a class="btn btn-info btn-search" data-toggle="modal" data-target="#modalCamera">Camera</a>-->
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <a data-toggle="modal" data-target="#ktpcam"><img id="ktp-img" src="themes/img/no_avatar.jpg" width="220" height="140"></a>
                        </div>
						<div>
				
						</div>
                    </div>
                </div>
                <!-- <div id="data"></div> -->
            </div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-primary" style="border-color:#eb525d">
			<div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
				<h4 style="width:50%;float:left;">Guestbook Form for <?php echo $_SESSION['guestbook_building']->building_name;?></h4>						
			</div>
			<div class="panel-body">
				<div data-example-id="basic-forms"> 
					<div class="form-body">
						<form id="form1" class="form-horizontal" method="post"> 
							<input type="hidden" name="img" class="form-control" id="img" placeholder="Name"  required> 
							<input type="hidden" name="img-ktp" class="form-control" id="img-ktp" placeholder="Name"  required> 
							<input type="hidden" name="id_building" class="form-control" id="id_building" placeholder="id_building" value="<?php echo $_SESSION['guestbook_building']->id_building;?>"> 
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Name</label> 
								<div class="col-sm-8"> 
									<input type="text" name="nama" class="form-control" id="" placeholder="Name" required> 
								</div> 
							</div>
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Email</label> 
								<div class="col-sm-8"> 
									<input type="email" name="email" class="form-control" id="" placeholder="Email" required> 
								</div> 
							</div> 
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Telephone / Hp</label> 
								<div class="col-sm-8"> 
									<input type="text" name="hp" class="form-control" id="" placeholder="Telephone / Hp" onkeypress="return isNumber(event)" required> 
								</div> 
							</div> 
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Company</label> 
								<div class="col-sm-8"> 
									<input type="text" name="company" class="form-control" id="" placeholder="Company" required> 
								</div> 
							</div>  
							<?php /*
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Room</label> 
								<div class="col-sm-8"> 
									<select name="floor" class="form-control" required>
									<?php 
									$datatuj = db_query2list("SELECT * FROM 16010754_sik.room a WHERE a.id_building='".$_SESSION['guestbook_building']->id_building."' order by a.floor_room_name");
									if(!empty($datatuj)){
									foreach($datatuj as $valtujuan){
										echo "<option value='".$valtujuan->id_room."'>".$valtujuan->floor_room_name." - ".$valtujuan->room_name."</option>";
									}
									?>
									<?php	
									}
									?>
									</select>
								</div> 
							</div> 
							*/?>
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">The Intended Person</label> 
								<div class="col-sm-8"> 
									<table width="100%">
										<tr>
											<td style="width:89%;">
												<input type="text" class="form-control readonly-input" name="person" id="pic_project_owner" value="" placeholder="Search PIC Telkomsel" readonly="readonly" required/>											
												<input type="hidden" class="form-control" name="email_project_owner" id="email_project_owner" value="<?php echo $email_project_owner ?>" />
												<input type="hidden" class="form-control" name="nik_pic_telkomsel" id="nik_pic_telkomsel" value="" />
												<input type="hidden" class="form-control" name="samaccountname" id="samaccountname" value="" />
												<input type="hidden" class="form-control" name="nomerHP" id="nomerHP" value="" />
												<input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan" value="" />
											</td>
											<td style="width:1%;">
											</td>
											<td style="width:10%;">
												<a class="btn btn-info btn-search" data-toggle="modal" data-target="#myModalSearchLdap">Search</a>
											</td>
										</tr>
									</table>
								</div> 
							</div> 
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Lantai</label> 
								<div class="col-sm-8">
									<input id="lantai" class="form-control" disabled=true>
								</div> 
							</div>
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Agenda</label> 
								<div class="col-sm-8"> 
									<textarea name="agenda" class="form-control" required></textarea>
									<!-- <input type="text" name="requirement" class="form-control" id="" placeholder="requirement"> -->
								</div> 
							</div>
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Estimasi Time Visit(Minutes)</label> 
								<div class="col-sm-4"> 
									<input type="text" name="time_esti" class="form-control" id="" placeholder="Estimasi Lama"  onkeypress="return isNumber(event)" required>
								</div>
							</div>
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Nomor KTP/SIM</label> 
								<div class="col-sm-4"> 
									<input type="text" name="ktp" class="form-control" id="" placeholder="Nomor KTP / SIM"  onkeypress="return isNumber(event)" required>
								</div>
							</div>
							<div class="col-sm-offset-2"> 
								<button name="data" type="submit" class="btn btn-default btn-xs pull-right" style="background: #e50012;margin-bottom:20px">Submit</button> 
							</div> 
						</form> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" style="margin-bottom:20px">
<form>
</form>
</div>
<?php
date_default_timezone_set("Asia/Jakarta");
    //set it to writable location, a place for temp generated PNG files
	//$url = echo url("themes/file/qrcode");
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../file/qrcode'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'file/qrcode/';

    include "themes/library/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    empty($_POST['nama']) ? $qrname = 'dummy' : $qrname = md5($_POST['nama']);
    $filename = $PNG_TEMP_DIR.$qrname .'.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_POST['data'])) { 
        $pesan = array();
    
        //it's very important!
        if (trim($qrname) == ''){
        	echo "Please completely your form";
        }else{
        	$filename = $PNG_TEMP_DIR.'img - '.md5($qrname .'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	        $filenametable = 'img - '.md5($qrname .'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

            empty($_POST['id_karyawan']) ? $id_karyawan = '' : $id_karyawan = $_POST['id_karyawan'];
            empty($_POST['nama']) ? $nama = '' : $nama = $_POST['nama'];
            empty($_POST['email']) ? $email = '' : $email = $_POST['email'];
            empty($_POST['hp']) ? $hp = '' : $hp = $_POST['hp'];
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
			
            if($nama == '' ||$id_karyawan ==0 || $email = '' || $hp = '' || $employee = '' ||$myimage4 ==''||$myimage_ktp4 ==''){
                $pesan['status'] = "All Field required...!!!";
                $pesan['link'] = "input2";
				echo "<script>alert('".$pesan['status']."');</script>";
            }elseif(strlen($myimage) < 700|| strlen($myimage_ktp) < 700){
				$pesan['status'] = "Photo Scan not complete...!!!";
				$pesan['link'] = "input2";
				echo "<script>alert('".$pesan['status']."');</script>";
			}else{
				// check guest still check in
				$hp = $_POST['hp'];
				$quyu = "select * from t_guestbook where Name = '".$_POST['nama']."' and Phonenumber = '".$hp."' and Person = '".$_POST['person']."' and Person_phonenumber = '".$_POST['nomerHP']."' and End_time is null";
				$check_ada = mysql_query($quyu);
				if(mysql_num_rows($check_ada) < 1){
					// upload foto dan ktp	
					$imagename = date('Y').date('m').date('d').date('his').str_replace(" ","",$_POST['nama']).'.png';
					file_put_contents('file/photo/'.$imagename, $myimage4);
					$imagename2 = date('Y').date('m').date('d').date('his')."_ktp_".str_replace(" ","",$_POST['nama']).'.png';
					file_put_contents('file/photo/'.$imagename2, $myimage_ktp4);
					// insert record to table
					$excec = mysql_query("INSERT INTO t_guestbook (Name,Email,Phonenumber,Company,Date,Start_time,Person_id,Person,Person_nik,Person_phonenumber,Estimate_time_visit,Building,Agenda,Photo_checkin,Number_of_ktp,Photo_ktp) values
					('".$_POST['nama']."','".$_POST['email']."','".$_POST['hp']."','".$_POST['company']."','".date('Y-m-d')."',NOW(),'".$_POST['id_karyawan']."','".$_POST['person']."','".$_POST['nik_pic_telkomsel']."','".$_POST['nomerHP']."','".$_POST['time_esti']."','".$_POST['id_building']."','".$_POST['agenda']."','".$imagename."','".$_POST['ktp']."','".$imagename2."')");
					if($excec){
						$id = mysql_insert_id();
						send_sms($_POST['nomerHP'],$id,$_POST['nama'],$_POST['hp'],$_POST['company']);
						$pesan['status'] = "Successfully create guesbook...$hp";
						echo "<script>alert('".$pesan['status']."');</script>";
						$pesan['link'] = "history-guestbook";
					}else{
						 $pesan['status'] = mysql_error();
					}
				}else{
					$pesan['status'] = "Input buku tamu gagal, anda tercatat masih terdaftar, silahkan check out terlebih dahulu";
					$pesan['link'] = "input";
					echo "<script>alert('".$pesan['status']."');</script>";
				}
            }
	        
        }  
		//print_r($pesan);
    echo status($pesan['status']);
    echo redirect($pesan['link']);
    return;
        
    } else {    
       // Create QR Code
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
		//echo "error";
        
    }  

    ?>
<div class="modal fade" id="modalCamera" tabindex="-1" role="dialog" aria-labelledby="modalCameraLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> -->
				Take Photo
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <canvas id="qr-canvas" width="320" height="240"></canvas>
                        </div>
						<div>
							<button id="play" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary" >Turn On Camera</button>
							<button id="save" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary disabled" >Take Image</button>
						</div>
                    </div>
				</div>
			</div>
			<div class="modal-footer full-right">
				<button id="stopAll" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-primary hidden" >OK</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal KTP -->
<div class="modal fade" id="ktpcam" tabindex="-1" role="dialog" aria-labelledby="modalCameraLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> -->
				Scan Identity Card
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <canvas id="qr-canvas-2" width="320" height="240"></canvas>
                        </div>
						<div>
							<button id="play-2" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary" >Turn On Camera</button>
							<button id="save-2" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary disabled" >Take Image</button>
						</div>
                    </div>
				</div>
			</div>
			<div class="modal-footer full-right">
				<button id="stopAll-2" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-primary hidden" >OK</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ktp End -->

<div class="modal fade" id="myModalSearchLdap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Search Karyawan</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div id="detail_content">
						<center>
							<input type="text" name="search_by_ldap" id="search_by_ldap" class="form-control search" placeholder="Search By Name" style="display:inline; width:45%"/>
							<input type="button" value="Search" id="b-search-ldap" class="btn btn-primary btn-md">
						</center>
						<center>
							<img src="http://10.3.5.225/permios/themes/images/loading.gif" alt="loading" id="loading_search_ldap" style="display:none;">
							<p id="null_message_ldap"></p>
						</center>
						<table class="table table-responsive" id="table">
							<thead>
								<tr>
									<th>Select</th>
									<th>NIK</th>
									<th>Name</th>
									<th>Email</th>
									<th>Title</th>
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


<script type="text/javascript" src="<?php echo url('themes/camera/js/qrcodelib.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/WebCodeCam.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/main_guest.js')?>"></script>
<script type="text/javascript" src="<?php echo url('themes/camera/js/ktp_guest.js')?>"></script>
<script>
//$(function()
    $(document).ready(function(){
		$( "#form1" ).submit(function( event ) {
			var itended =  $('#pic_project_owner').val();
			var img_guest =  $('#img').val();
			var img_ktp =  $('#img-ktp').val();
			if(itended == ''){
				alert('Intended Person not yet selected');
				return false;
			} else if (img_guest == '' || img_guest.length < 600){
				alert('Guest Photo not complete');
				return false;
			} else if (img_ktp == '' || img_ktp.length < 600){
				alert('KTP/ID not complete, please rescan');
				return false;
			} else{
				return true;
			}
			event.preventDefault();
		});
		
        $('#check_in').click(function() {
            //alert($('#scanned-QR').text());
            get_data('ajax-checkin.php',$('#scanned-QR').text(),$('#ruangan').val());
        });
		
        $('#check_out').click(function() {
            //alert($('#scanned-QR').text());
            get_data('ajax-checkout.php',$('#scanned-QR').text(),$('#ruangan').val());
        });
		
		$('#b-search-ldap').on( 'click', function () {
			var search_by_ldap = $('#search_by_ldap').val();
			var username = "<?php echo $_SESSION['user_asik']->username?>";
			var pass = "<?php echo $_SESSION['user_asik']->pass?>";
			var roles = "recepsionis";
			var fdata = {search_by_ldap: search_by_ldap, pass: pass, username: username, roles: roles};
			$('#loading_search_ldap').show();
			$.ajax({
				type:"GET",
				url: "http://10.3.5.225/guestbook/api/get-pic.php",
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
    });
	
	function getNIK(nik,lantai, mail, fullname, samaccountname,nomerHP,id_karyawan){
		$( function() {
			console.log("dos");
			$("#lantai").val(lantai);
			$("#pic_project_owner").val(fullname);
			$("#email_project_owner").val(mail);
			$("#nik_pic_telkomsel").val(nik);
			$("#nomerHP").val(nomerHP);
			$("#id_karyawan").val(id_karyawan);
			$("#samaccountname").val(samaccountname);
			$('#myModalSearchLdap').modal('hide');
			$('.modal-backdrop').remove();
		} );
	}
	
    function get_data(url,type,ruangan){
        var fdata = { ftype: type,furl :url,fruangan :ruangan}
        $.ajax({
            type:"get",
            url: "<?php echo url('page/main/ajax/"+url+"')?>",
            dataType:'json',
            error: function (request,status, error) {
                console.log(request);
            },
            data:fdata
        }).done(function(data){
            console.log(data);
            $("#data").html(data.table);
			alert(data.notif);
        }).fail(function(data){
            //console.log(data);
            //alert("terjadi kesalahan, silahkan refresh ulang");
        });
    }
	function openmodal(){
		$('#myMdalSearchLdap').modal("show");
	}
    // $('.datepicker').datepicker({
    //     onSelect: function(dateStr) {
    //         $('#view-date').html(dateStr+',');
    //         $('input:hidden[name=date]').val(dateStr);
    //     },
    //     dateFormat:'dd/mm/yy',
    //     maxDate : new Date(),
    //     showOn: "button",
    //     buttonImage: "themes/img/base/calendar.gif",
    //     buttonImageOnly: true
    // }).attr('readonly','readonly');
</script>
