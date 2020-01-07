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
    	        //mysql_query("Insert into t_guestbook values(Null,'".$_POST['nama']."','".date('Y-m-d H:i:s')."')");
    	        $data = db_query("select * from user where username='".$_POST['nama']."' OR fullname = '".$_POST['nama']."'");
    	        if(!empty($data)){
    	        	$pesan['status'] = "user existing";
                    $pesan['link'] = "guest";
    	        }else{
    	        	$excec = mysql_query("Insert into t_employee(fullname,email,tlp,Employee,username,password,Qr_Code) values('".$nama."','".$_POST['email']."','".$_POST['hp']."','".$_POST['employee']."','".$username."','".$qrname."','".$filenametable."')");
                    
                    if($excec){
                        $pesan['status'] = "Successfully create Employee...";
                        $pesan['link'] = "home";
                    }
           // Create QR Code
    	        QRcode::png($qrname, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
        		//echo '<img src="'.url($PNG_WEB_DIR.basename($filename)).'" /><hr/>'; 
    	        }
            }
	        
        }  


    echo status($pesan['status']);
    echo redirect($pesan['link']);
    return;
        
    } else {    
       // Create QR Code
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } 
    
        
    //display generated file 
    
    //config form
    // echo '<form action="index.php" method="post">
    //     Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
    //     ECC:&nbsp;<select name="level">
    //         <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
    //         <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
    //         <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
    //         <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
    //     </select>&nbsp;
    //     Size:&nbsp;<select name="size">';
        
    // for($i=1;$i<=10;$i++)
    //     echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    // echo '</select>&nbsp;
    //     <input type="submit" value="GENERATE"></form><hr/>';
        
    // benchmark
    //QRtools::timeBenchmark();    

    ?>

<div class="panel panel-widget forms-panel">
	<div class="forms">
		<div class=" form-grids form-grids-right">
			<div class="widget-shadow " data-example-id="basic-forms"> 
				<div class="form-title">
					<h4>Registration :</h4>
				</div>
				<div class="form-body">
					<form class="form-horizontal" method="post"> 
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
                            <label for="" class="col-sm-2 control-label">Employe</label> 
                            <div class="col-sm-9"> 
                                <input type="text" name="employee" class="form-control" id="" placeholder="Employe"> 
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
