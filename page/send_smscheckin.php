<?php
	include_once("smppclass.php");
    require_once('../function/fungsi-sql.php');
    require_once('../function/fungsi-task.php');
	require_once('../includes/database.php');
	
	$user_ldap = "16010754";
	$pass_ldap = "Auto#2017";
	
	$smpphost = "10.2.224.156";
	$smppport = 28108;
	$systemid = "ARMAN4725";
	$password = "ARMAN123";
	$system_type = "TCP";
	$from = "3999"; //display pengirim
	//$from = "siktest"; //display pengirim
	
	$sik_number = $_GET['sik_number'];
	/* $query = "
		SELECT * 
		FROM sik a 
		LEFT JOIN approve_sik b ON (a.id_sik = b.id_sik)
		WHERE a.sik_number = '".$sik_number."'
		AND b.cek_atasan = 0
	"; */
	$query = "
		SELECT * 
		FROM sik a 
		LEFT JOIN approve_sik b ON (a.id_sik = b.id_sik)
		WHERE a.sik_number = '".$sik_number."'
	";
	$data = db_query2list($query);
	
	foreach($data as $result){
		empty($result->nik_pic_building)? $nik = $result->nik_project: $nik = $result->nik_pic_building;
		/* $getLdap = getLdapByFilter($user_ldap, $pass_ldap, $nik, 'extensionattribute1');
		$telephonenumber = "62".substr($getLdap->telephonenumber, 1); */
		$query_telephone = "
			SELECT * 
			FROM karyawan_ldap
			WHERE nik = '".$nik."'
		";
		$row = db_query($query_telephone);
		$telephonenumber = "62".$row->nomerHP; 
		
		$smpp = new SMPPClass();
		$smpp->SetSender($from);
		$smpp->Start($smpphost, $smppport, $systemid, $password, $system_type);
		
		$msg = "";
		$msg .= "SIK id $sik_number waiting for your confirmation \n";
		if($result->approve_project_owner == 0){
			$msg .= "reply this message to 3999 with format : SIKTTC(space)$sik_number#submit \n";
		} else {
			$msg .= "reply this message to 3999 with format : SIKTTC(space)$sik_number#approve/reject \n";
		}
		
		$smpp->Send($telephonenumber,$msg);
	}
	$smpp->End();
?>