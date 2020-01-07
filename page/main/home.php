<div class="row" style="margin-bottom:20px">
<form>
<button name="guest" value="guest" class="btn btn-primary" >Guestbook</button>
<button name="check" value="check" class="btn btn-danger" >Checkin / Checkout</button>
</form>
</div>
<?php 
if(empty($_GET['guest'])){
?>    
	<div id="QR-Code" class="container" style="width:70%">
            <div class="panel panel-primary" style="border-color:#eb525d">
                <div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
                    <h4 style="width:50%;float:left;">Tap Your Code</h4>
                    <div style="width:50%;float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                    <select id="cameraId" class="form-control" style="display: inline-block;width: auto;"></select>
                    <!--<button id="save" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-info btn-sm disabled"><span class="glyphicon glyphicon-picture"></span></button>
                    <button id="stop" data-toggle="tooltip" title="Stop" type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-stop"></span></button>-->
                    <button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>
                    <button id="stopAll" data-toggle="tooltip" title="Stop streams" type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-stop"></span></button>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6" style="text-align: center;">
                    <div class="well" style="position: relative;display: inline-block;">
                        <canvas id="qr-canvas" width="320" height="240"></canvas>
                        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                    </div>
                    <!-- 
                    <div class="well" style="position: relative;" >
                        <label id="zoom-value" width="100">Zoom: 2</label>
                        <input type="range" id="zoom" value="20" min="10" max="30" onchange="Page.changeZoom();"/>
                        <label id="brightness-value" width="100">Brightness: 0</label>
                        <input type="range" id="brightness" value="0" min="0" max="128" onchange="Page.changeBrightness();"/>
                        <label id="contrast-value" width="100">Contrast: 0</label>
                        <input type="range" id="contrast" value="0" min="0" max="64" onchange="Page.changeContrast();"/>
                        <label id="threshold-value" width="100">Threshold: 0</label>
                        <input type="range" id="threshold" value="0" min="0" max="512" onchange="Page.changeThreshold();"/>
                        <label id="sharpness-value" width="100">Sharpness: off</label>
                        <input type="checkbox" id="sharpness" onchange="Page.changeSharpness();"/>
                        <label id="grayscale-value" width="100">grayscale: off</label>
                        <input type="checkbox" id="grayscale" onchange="Page.changeGrayscale();"/>
                    </div> -->
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <img id="scanned-img" src="" width="320" height="240">
                        </div>
                        <div class="caption" >
						
                            <input name="ruangan" type="hidden" id="ruangan" value="<?php if(!empty($_SESSION['quick_login']->roles)) echo $_SESSION['quick_login']->roles?>">
							<!--
						<?php 
							if($_SESSION['quick_login']->roles=='ttc'){
						?>
                            <input name="ruangan" type="hidden" id="ruangan" value="<?php if(!empty($_SESSION['quick_login']->roles)) echo $_SESSION['quick_login']->roles?>">
						<?php 
							}else{
						?>
                            <input name="ruangan" type="hidden" id="ruangan" value="<?php if(!empty($_SESSION['quick_login']->roles)) echo $_SESSION['quick_login']->roles?>">
						<?php
							}
						?>
						-->
                            <button class="btn btn-primary" id="check_in">Check in</button>
                            <button class="btn btn-danger" id="check_out">Check Out</button>
                            <p id="scanned-QR" style="display:none"></p>
                            <p id="data"></p>
                        </div>
                    </div>
                </div>
                <!-- <div id="data"></div> -->
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
<?php 
}else{
if($_SESSION['quick_login']->roles=='ttc'){
	//$_SESSION['user_asik']->roles = "recepsionis";
	echo "<iframe src='http://10.3.5.225/permios/log-sik/view/1/2' style='width:100%;height:500px'></iframe>";
}else{

?>
<script>
function setvar(){
var myImg = document.getElementById("scanned-img").src;
document.getElementById("img").value = myImg;
alert("Success Set Image");
}
</script>
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


    if (isset($_REQUEST['data'])) { 
        $pesan = array();
    
        //it's very important!
        if (trim($qrname) == ''){
        	echo "Please completely your form";
        }else{
        	$filename = $PNG_TEMP_DIR.'img - '.md5($qrname .'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	        $filenametable = 'img - '.md5($qrname .'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

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
            if($nama == '' || $email = '' || $hp = '' || $employee = ''){
                $pesan['status'] = "All Field required...!!!";
                 $pesan['link'] = "guest";
            }else{
			
				$myimage = $_POST['img'];

				list($type, $myimage) = explode(';', $myimage);
				list(, $myimage) = explode(',', $myimage);
				$myimage = base64_decode($myimage);
				$imagename = date('Y').date('m').date('d').date('his').str_replace(" ","",$_POST['nama']).'.png';
				file_put_contents('file/photo/'.$imagename, $myimage);
				
				
				$excec = mysql_query("Insert into t_guestbook values(Null,'".$_POST['nama']."','".date('Y-m-d')."','".date('H:i:s')."','','".$_POST['person']."','".$_POST['floor']."','".$_POST['requirement']."','".$imagename."')");
                    if($excec){
                        $pesan['status'] = "Successfully create guesbook...";
                        $pesan['link'] = "home";
                    }
				/*
    	        $data = db_query("select * from t_employee where username='".$_POST['nama']."' OR fullname = '".$_POST['nama']."'");
    	        if(!empty($data)){
					
					$excec = mysql_query("Insert into t_guestbook values(Null,'".$data->IDEmployee."','".date('Y-m-d')."','".date('H:i:s')."','','".$_POST['person']."','".$_POST['floor']."','".$_POST['requirement']."','".$image."')");
                    if($excec){
                        $pesan['status'] = "Successfully create guesbook...";
                        $pesan['link'] = "home";
                    }
    	        }else{
    	        	mysql_query("Insert into t_employee(fullname,email,tlp,Employee,username,password,Qr_Code) values('".$nama."','".$_POST['email']."','".$_POST['hp']."','".$_POST['employee']."','".$username."','".$qrname."','".$filenametable."')");
                    $ID  = mysql_insert_id();
					
					$excec = mysql_query("Insert into t_guestbook values(Null,'".$ID."','".date('Y-m-d')."','".date('H:i:s')."','','".$_POST['person']."','".$_POST['floor']."','".$_POST['requirement']."','".$image."')");
                    if($excec){
                        $pesan['status'] = "Successfully create guesbook...";
                        $pesan['link'] = "home";
                    }
					
				// Create QR Code
    	        QRcode::png($qrname, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
        		//echo '<img src="'.url($PNG_WEB_DIR.basename($filename)).'" /><hr/>'; 
    	        }
				*/
            }
	        
        }  
    echo status($pesan['status']);
    echo redirect($pesan['link']);
    return;
        
    } else {    
       // Create QR Code
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }  

    ?>
<div class="panel panel-widget forms-panel">
	<div id="QR-Code" class="container" style="width:70%;padding-top:5%">
            <div class="panel panel-primary" style="border-color:#eb525d">
                <div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
                    <h4 style="width:50%;float:left;">Photo Shoot</h4>
                    <div style="width:50%;float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                    <select id="cameraId" class="form-control" style="display: inline-block;width: auto;"></select>
                    <!--<button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>-->
					<!--
                    <button id="stop" data-toggle="tooltip" title="Stop" type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-stop"></span></button>
					-->
                    <!--<button id="stopAll" data-toggle="tooltip" title="Stop streams" type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-stop"></span></button>-->
                </div>
            </div>
            <div class="panel-body">
               <!-- <div class="col-md-6" style="text-align: center;">
                    <div class="well" style="position: relative;display: inline-block;">
                        <div class="well" style="position: relative;display: inline-block;">
							<canvas id="qr-canvas" width="320" height="240"></canvas>
                        </div>
						<button id="play" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary" >Turn On Camera</button>
                    </div>
                </div> -->
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <canvas id="qr-canvas" width="320" height="240"></canvas>
                        </div>
						<div>
							<button id="play" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary" >Turn On Camera</button>
							<button id="stopAll" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-primary" >Turn Off Camera</button>
						</div>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <img id="scanned-img" src="themes/img/no_avatar.jpg" width="320" height="240">
                        </div>
						<div>
							<button id="save" data-toggle="tooltip" title="Take Image" type="button" class="btn btn-primary disabled" >Take Image</button>
                            <button class="btn btn-primary" id="set_image" onclick="setvar()">Set Image</button>
						</div>
                    </div>
                </div>
                <!-- <div id="data"></div> -->
            </div>
        </div>
    </div>
	<div class="forms">
		<div class=" form-grids form-grids-right">
			<div class="widget-shadow " data-example-id="basic-forms"> 
				<div class="form-title">
					<h4>Registration & Guestbook :</h4>
				</div>
				<div class="form-body">
					<form class="form-horizontal" method="post"> 
					<input type="hidden" name="img" class="form-control" id="img" placeholder="Name"> 
						<div class="form-group"> 
							<label for="" class="col-sm-2 control-label">Name</label> 
							<div class="col-sm-9"> 
								<input type="text" name="nama" class="form-control" id="" placeholder="Name"> 
							</div> 
						</div> 
						<div class="form-group"> 
							<label for="" class="col-sm-2 control-label">Email</label> 
							<div class="col-sm-9"> 
								<input type="email" name="email" class="form-control" id="" placeholder="Email"> 
							</div> 
						</div> 
                        <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Telephone / Hp</label> 
                            <div class="col-sm-9"> 
                                <input type="text" name="hp" class="form-control" id="" placeholder="Telephone / Hp"> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Employee</label> 
                            <div class="col-sm-9"> 
                                <input type="text" name="employee" class="form-control" id="" placeholder="Employe"> 
                            </div> 
                        </div>  
                        <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Room</label> 
                            <div class="col-sm-9"> 
								<select name="floor" class="form-control" >
								<?php 
									$datatuj = db_query2list("Select Concat('Lantai ',LName) as Lantai from t_lantai
															UNION
															Select Concat('Lantai ',Lantai ,' ',Ruangan,' (',TName,')') as Lantai from t_ruangan inner join t_ttc on t_ttc.id_ttc = t_ruangan.id_ttc");
									if(!empty($datatuj)){
										foreach($datatuj as $valtujuan){
											echo "<option value='".$valtujuan->Lantai."'>".$valtujuan->Lantai."</option>";
										}
									?>
									<?php	
									}
								?>
								</select>
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">The Intended Person</label> 
                            <div class="col-sm-9"> 
								<table width="100%">
								<tr>
									<td style="width:89%;">
										<input type="text" class="form-control readonly-input" name="person" id="pic_project_owner" value="" placeholder="Search PIC Telkomsel"  required />
										<input type="hidden" class="form-control" name="email_project_owner" id="email_project_owner" value="<?php echo $email_project_owner ?>" />
										<input type="hidden" class="form-control" name="nik_pic_telkomsel" id="nik_pic_telkomsel" value="" />
										<input type="hidden" class="form-control" name="samaccountname" id="samaccountname" value="" />
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
                            <label for="" class="col-sm-2 control-label">Purpose</label> 
                            <div class="col-sm-9"> 
								<textarea name="requirement" class="form-control"></textarea>
                                <!-- <input type="text" name="requirement" class="form-control" id="" placeholder="requirement"> -->
                            </div> 
                        </div> 
						<div class="col-sm-offset-2"> 
							<button name="data" type="submit" class="btn btn-default w3ls-button" style="background: #e50012;">Submit</button> 
						</div> 
					</form> 
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="modal fade" id="myModalSearchLdap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title" id="myModalLabel">Search By LDAP</h4>
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
<?php 
}
}?>
<script>
//$(function()
    $(document).ready(function(){
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
			var roles = "<?php echo $_SESSION['user_asik']->roles?>";
			var fdata = {search_by_ldap: search_by_ldap, pass: pass, username: username, roles: roles};
			$('#loading_search_ldap').show();
			$.ajax({
				type:"GET",
				url: "http://10.3.5.225/permios/page/users/sik/ajax/ajax-source-by-ldap.php",
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
	
	function getNIK(nik, mail, fullname, samaccountname){
		$( function() {
			$("#pic_project_owner").val(fullname);
			$("#email_project_owner").val(mail);
			$("#nik_pic_telkomsel").val(nik);
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