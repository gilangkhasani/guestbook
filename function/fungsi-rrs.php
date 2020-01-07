<?php
function import_csv_dapot($seperator, $new_name_file){
	$file = fopen('./file_doc/import/'.$new_name_file,"r");
	$data_import = array();
	$data_hasil = array();
	$data_hasil['berhasil'] = NULL;
	$data_hasil['gagal'] = NULL;
	$dept = NULL;
	while(! feof($file))
	  {
	  $data_import[] = fgetcsv($file,1000,$seperator);
	  }
	if(!empty($data_import)){
		unset($data_import[0]);
	}
	foreach($data_import as $index_import => $value_import){
		if($value_import[0]!=''){
			if(mysqli_query("insert into dapot_site (site_id,site_name,oss_sitename,ring_name,longitude,latitude,alamat) values ('".$value_import[0]."','".$value_import[1]."','".$value_import[2]."','".$value_import[3]."','".$value_import[4]."','".$value_import[5]."','".$value_import[6]."')
				ON DUPLICATE KEY UPDATE site_name ='".$value_import[1]."',oss_sitename = '".$value_import[2]."', ring_name = '".$value_import[3]."', longitude = '".$value_import[4]."', latitude = '".$value_import[5]."', alamat = '".$value_import[6]."'
				")){
				$data_hasil['berhasil'][] = $value_import;
			}else{
				$data_hasil['gagal'][] = $value_import.mysql_error();
			}
		}
	}
	fclose($file);
	
	unlink('./file_doc/import/'.$new_name_file);
	return $data_hasil;
}

//================================================================================================================================================================================================================================================================================================

// Start Action From User
function insert_user($username,$password,$roles,$block = 0,$fullname,$email,$tlp){
	if($username=='' || $password=='' || $roles == ''|| $fullname == '' ){
		$alert = "Semua field dengan tanda * wajib diisi!!";
	}else{
		$cek = db_num_rows("Select * from user where username = '$username'");
		if($cek>0){
			$alert = "Data user dengan <b>".$username."</b> sudah ada!";
		}else{
			$query = mysql_query("Insert into user(username,password,fullname,roles,block,email,tlp) values('$username','".md5($password)."','$fullname','$roles','$block','$email','$tlp')");
			if($query){
				$alert = "Data berhasil ditambahkan!";
			}else{
				$alert = "Data gagal ditambahkan!".mysql_error();
			}
		}
	}
	return $alert;
}

function update_user($id,$username,$password,$roles,$block = 0,$fullname,$email,$tlp){
	if($password==''){
		// $cek = db_num_rows("Select * from user where username = '$username'");
		// if($cek>0){
		// 	$alert = "Data user dengan <b>".$username."</b> sudah ada!!";
		// }else{
			$query = mysql_query("update user set username = '".$username."',roles = '".$roles."',block='".$block."',fullname = '".$fullname."',email = '".$email."',tlp = '".$tlp."' where id_user = '".$id."'");
			if($query){
				$alert = "Data berhasil diupdate!";
			}else{
				$alert = "Data gagal diupdate!!".mysql_error();
			}
		// }
	}else{
		$pass = md5($password);
		// $cek = db_num_rows("Select * from user where username = '$username'");
		// if($cek>0){
		// 	$alert = "Data user dengan <b>".$username."</b> sudah ada!";
		// }else{
			$query = mysql_query(" update user set username = '".$username."',password='".$pass."',roles = '".$roles."',block='".$block."',fullname = '".$fullname."',email = '".$email."',tlp = '".$tlp."' where id_user = '".$id."'");
			if($query){
				$alert = "Data berhasil diupdate!";
			}else{
				$alert = "Data gagal diupdate!".mysql_error();
			}
		// }
	}
	return $alert;
}

function delete_user($id){
	if($id==''){
		$alert = "ID tidak dideklarasi!!";
	}else{
		$query = mysql_query("Delete from user where id_user = '".$id."'");
		if($query){
			$alert = "Data berhasil dihapus!";
		}else{
			$alert = "Data gagal dihapus!".mysql_error();
		}
	}
	return $alert;
}
// End Action From User
?>