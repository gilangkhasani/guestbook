<?php
	
	$server = "localhost";
	$user = "root";
	$password = "";
	$db_name = "16011164_portal";
	$con = mysqli_connect("$server","$user","$password","$db_name");
	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	date_default_timezone_set("Asia/Jakarta");
	
	$search_by_ldap = $_GET['search_by_ldap'];
	$field_name = $_GET['field_name'];
	$field_nik = $_GET['field_nik'];
	
	$query_detail = "
		SELECT * 
		FROM karyawan_ldap 
		WHERE fullname LIKE '%".$search_by_ldap."%'
	";
	
	$sql_detail = mysqli_query($con, $query_detail);
	
	$output = array();
	$output["sql_detail"] = $query_detail;
	
	$output['content'] = '';
	
	$array = array();
	while($result = mysqli_fetch_object($sql_detail)){
		$array[] = $result;
		
		$output['content'] .= '<tr>';
			$output['content'] .= '<td><a class="btn btn-success btn-xs" onclick="getNIK(\''.$result->nik.'\',\''.$result->fullname.'\',\''.$field_nik.'\',\''.$field_name.'\')">Select</a></td>';
			$output['content'] .= '<td>'.$result->fullname.'</td>';
			$output['content'] .= '<td>'.$result->nomerHP.'</td>';
		$output['content'] .= '</tr>';
	} 
	$output['output_array'] = $array;
	$output['output_json'] = json_encode($array);
	
	echo json_encode($output);
?>