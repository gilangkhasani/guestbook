<?php	
	$server = "103.15.226.142";
	$user = "itbs";
	$password = "itbs123";
	$db_name = "16011164_portal";
	$con = mysqli_connect("$server","$user","$password","$db_name");
	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	date_default_timezone_set("Asia/Jakarta");
	switch($_REQUEST['mode']){
		case 'getUpdates':
				$query_detail = "select a.*,b.nama as nama_pic,b.msisdn as msisdn_pic from guestbook_windu a left join karyawan_windu b on a.nik_pic_telkomsel=b.nik where a.status_msg='new'"; 
				$sql_detail = mysqli_query($con, $query_detail);
				$point = array();
				if(mysqli_num_rows($sql_detail) >0){
					$output['result'] = 1;
					while($result = mysqli_fetch_object($sql_detail)){
						$point['id_guestbook'] = $result->id_guestbook;
						$point['msisdn'] = $result->msisdn;
						$point['nama_tamu'] = $result->nama;
						$point['company'] = $result->company;
						$point['agenda'] = $result->agenda;
						$point['pesan'] = $result->pesan;
						$point['nama_pic'] = $result->nama_pic;
						$point['msisdn_pic'] = $result->msisdn_pic;
						$output['message'][]=$point;
						$point = array();
					}
				}else{
					$output['result'] = 0;
				}
				break;
		case 'updateMsg':
				$query_update = "update guestbook_windu set status_msg='old' where id_guestbook=".$_REQUEST['id']."";
				$sql_update = mysqli_query($con, $query_update);
				if($sql_update){
					$output['result']=1;
				}else{
					$output['result']=0;
				}
				break;			
		default :
			$output['error']="no query";
			break;
	}
	echo json_encode($output);
	?>