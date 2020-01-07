<?php
if(!empty($_POST['simpan'])){
	$tanggal = date('Y-m-d');
	$waktu = strtotime(date('H:i:s'));
	$file = $_FILES['file']['name'];

	$eror		= false;
	$folder		= 'file/import/';
	$jenis      = $_POST['jenis'];
	//type file yang bisa diupload
	$file_type	= array('csv');
	//tukuran maximum file yang dapat diupload
	$max_size	= 500000000; // 5MB
	if($file!=''){
		//Mulai memorises data
		$file_size	= $_FILES['file']['size'];
		//cari extensi file dengan menggunakan fungsi explode
		$explode	= explode('.',$_FILES['file']['name']);
		$extensi	= $explode[count($explode)-1];
		
		//ubah nama file
		$file_name	= "import -".$tanggal."-".$waktu.".".$extensi;
        $file_loc = $folder.$file_name;

		//check apakah type file sudah sesuai
		$pesan='';	
		if(!in_array($extensi,$file_type)){
			$eror   = true;
			$pesan .= '- Type file yang anda upload tidak sesuai<br />';
		}
		if($file_size > $max_size){
			$eror   = true;
			$pesan .= '- Ukuran file melebihi batas maximum<br />';
		}
		//check ukuran file apakah sudah sesuai

		if($eror == true){
			echo '<div class="alert alert-error">'.$pesan.'</div>';
		}
		else{
			//mulai memproses upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$folder.$file_name)){
			    $action = import_csv($jenis,',',$file_name);
			    print_r($action);
			    //echo status($action);
			    //echo redirect('import');
			    return;
			}
		}
	}else{
        status("Rejecting !!!");
        $message = "<div id='al' class='alert alert-danger'>Data gagal Ditambahkan !!</div>";
    }
}else{
    $file = '';
    $judul = '';
    $tahun= '';
}
?>
			<div class="row mt mb">
                  <div class="col-md-12">
                      <section class="task-panel tasks-widget">
	                	<div class="panel-heading">
	                        <div class="pull-left"><h5><i class="fa fa-tasks"></i> Import Data</h5></div>
	                        <br>
	                 	</div>
                          <div class="panel-body">
                              <div class="task-content">
                              	<form method="post" action="" enctype="multipart/form-data" name="form-menu">
					        		<table width="500px" style="width:500px; margin:0 auto" border="0" border="0" class="table">
					                    <tbody>
					                    <?php
					                    if(!empty($message)){
					                        echo '<tr><td colspan="5" align="center">'.$message.'</td></tr>';
					                    }
					                    ?>
					                    <tr>
					                        <td class="bold">Jenis</td>
					                        <td style="color:red"> : 
					                        	<select name="jenis">
					                        		<option value="Recharge">Recharge</option>
					                        		<option value="Bundling">Bundling</option>
					                        	</select>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="bold">File</td>
					                        <td style="color:red"> : <input type="file" name="file" class="input-type validate-kutip" value="<?php echo $hostname?>" />*Format File Harus CSV</td>
					                        <td><input class="btn btn-success" type="submit" id="simpan" name="simpan" value="Import"></td>
					                    </tr>
					                    </tbody>
					                </table>
					        	</form>
                              </div>
                          </div>
                      </section>
                  </div><!--/col-md-12 -->
              </div>