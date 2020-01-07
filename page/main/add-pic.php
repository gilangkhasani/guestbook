<?php 
    if (isset($_POST['data'])) { 
        $pesan = array();
    
            empty($_POST['nik']) ? $nik = '' : $nik = $_POST['nik'];
            empty($_POST['nama']) ? $nama = '' : $nama = $_POST['nama'];
            empty($_POST['email']) ? $email = '' : $email = $_POST['email'];
            empty($_POST['hp']) ? $hp = '' : $hp = $_POST['hp'];
            empty($_POST['jabatan']) ? $jabatan = '' : $jabatan = $_POST['jabatan'];
            empty($_POST['departement']) ? $departement = '' : $departement = $_POST['departement'];
            empty($_POST['building']) ? $building = '' : $building = $_POST['building'];
            empty($_POST['lantai']) ? $lantai = '' : $lantai = $_POST['lantai'];
            if($nama!=''){
                $explode = explode(" ",  $nama);
                $username = $explode[0];
            }else{
                $username = '';
            }
            if($nama == '' || $email = '' || $hp = '' || $jabatan = '' || $building == '' || $lantai == '' ){
                $pesan['status'] = "All Field required...!!!";
                 $pesan['link'] = "guest";
            }else{
			
				$excec = mysql_query("INSERT INTO karyawan_jabar (id_karyawan,displayname,fullname,departement,nomerHP,telpon,mail,building,lantai,editted_by,last_edited) values
				(NULL,'".$_POST['nama']."','".$_POST['nama']."','".$_POST['departement']."','".$_POST['hp']."','".$_POST['hp']."','".$_POST['email']."','".$_POST['building']."','".$_POST['lantai']."','".$_SESSION['guestbook_building']->username."',now())");
                    if($excec){
                        $pesan['status'] = "Successfully create Karyawan...";
                        $pesan['link'] = "list-karyawan";
                    }else{
						 $pesan['status'] = mysql_error();
					}
            }
		//print_r($pesan);
    echo status($pesan['status']);
	echo redirect("history-guestbook");
    return;
        
    } else {   
        
    }  
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" style="border-color:#eb525d">
			<div class="panel-heading" style="display: inline-block;width: 100%;    background: #eb525d;">
				<h4 style="width:50%;float:left;">Add Karyawan</h4>						
			</div>
			<div class="panel-body">
				<div data-example-id="basic-forms"> 
					<div class="form-body">
						<form class="form-horizontal" method="post"> 
							<!--
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">NIK</label> 
								<div class="col-sm-8"> 
									<input type="text" name="nik" class="form-control" id="" placeholder="NIK" required> 
								</div> 
							</div>
							-->
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Name</label> 
								<div class="col-sm-8"> 
									<input type="text" name="nama" class="form-control" id="" placeholder="Name" required> 
								</div> 
							</div>
							<!--
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">User LDAP</label> 
								<div class="col-sm-8"> 
									<input type="text" name="userldap" class="form-control" id="" placeholder="User LDAP" required> 
								</div> 
							</div>
							-->
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Email</label> 
								<div class="col-sm-8"> 
									<input type="email" name="email" class="form-control" id="" placeholder="Email" required> 
								</div> 
							</div> 
							<div class="form-group"> 
								<label for="" class="col-sm-3 control-label">Telephone / Hp</label> 
								<div class="col-sm-8"> 
									<input type="text" name="hp" class="form-control" id="" placeholder="Telephone / Hp" required> 
								</div> 
							</div> 
							<!--<div class="form-group">
								<label for="" class="col-sm-3 control-label">Jabatan</label> 
								<div class="col-sm-8"> 
									<input type="text" name="jabatan" class="form-control" id="" placeholder="Jabatan" required> 
								</div> 
							</div>--> 
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Department</label> 
								<div class="col-sm-8"> 
									<select name="departement" class="form-control">
										<?php 
										$data_building = db_query2list("Select distinct(departement) as dep from karyawan_jabar order by departement asc");
										if(!empty($data_building)){
											foreach($data_building as $val){
												echo "<option value='".$val->dep."'>".$val->dep."</option>";
											}
										}
										?>
									</select>
									<!--<input type="text" name="departement" class="form-control" id="" placeholder="departement" required> -->
								</div> 
							</div>  
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Building</label> 
								<div class="col-sm-8"> 
									<select name="building" class="form-control">
										<?php 
										$data_building = db_query2list("Select * from building");
										if(!empty($data_building)){
											foreach($data_building as $val){
												echo "<option value='".$val->building_name."'>".$val->building_name."</option>";
											}
										}
										?>
									</select>
									<!-- <input type="text" name="building" class="form-control" id="" placeholder="Building" required> -->
								</div> 
							</div>  
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Lantai</label> 
								<div class="col-sm-8"> 
									<input type="text" name="lantai" class="form-control" id="" placeholder="Lantai" required> 
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
</div>