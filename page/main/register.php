
<script>
function setvar(){
var myImg = document.getElementById("scanned-img").src;
document.getElementById("img").value = myImg;
//alert(myImg);
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

				file_put_contents('file/photo/'. date('Y').date('m').date('d').$_POST['nama'].'.png', $myimage);
				$image = date('Y').date('m').date('d').$_POST['nama'].'.png';
				
				/*
				$excec = mysql_query("Insert into t_guestbook values(Null,'".$_POST['nama']."','".date('Y-m-d')."','".date('H:i:s')."','','".$_POST['person']."','".$_POST['floor']."','".$_POST['requirement']."','".$image."')");
                    if($excec){
                        $pesan['status'] = "Successfully create guesbook...";
                        $pesan['link'] = "home";
                    }
				*/
    	        	$excec  = mysql_query("Insert into t_employee(fullname,email,tlp,Employee,username,password,Qr_Code) values('".$nama."','".$_POST['email']."','".$_POST['hp']."','".$_POST['employee']."','".$username."','".$qrname."','".$filenametable."')");
					
                    if($excec){
                        $pesan['status'] = "Successfully create guesbook...";
                        $pesan['link'] = "employee";
                    }
					
				// Create QR Code
    	        QRcode::png($qrname, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
        		//echo '<img src="'.url($PNG_WEB_DIR.basename($filename)).'" /><hr/>'; 
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
                    <button id="save" data-toggle="tooltip" title="Image shoot" type="button" class="btn btn-info btn-sm disabled" ><span class="glyphicon glyphicon-picture"></span></button>
                    <button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>
					<!--
                    <button id="stop" data-toggle="tooltip" title="Stop" type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-stop"></span></button>
					-->
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
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <img id="scanned-img" src="" width="320" height="240">
                        </div>
						<div>
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
                                <input type="text" name="person" class="form-control" id="" placeholder="person">
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