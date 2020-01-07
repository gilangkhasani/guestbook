<?php
include '../../../includes/database.php';
function db_query($query){
	$q = mysql_query($query);
	$r = mysql_fetch_object($q);
	return $r;
}
date_default_timezone_set("Asia/Jakarta");
if($_GET['fruangan']=='scc'){
	$q = "SELECT * FROM t_employee where password = '".$_GET['ftype']."' ";
	$row = db_query($q);
	$output = array();
	$output["sql"] = $q;
	$output["notif"] = '';
		if(!empty($row)){
			$exec = mysql_query("update t_checkin_scc set end_time = '".date('H:i:s')."' where IDEmployee='".$row->IDEmployee."' and Date = '".date('Y-m-d')."'");
			if($exec){
				$output["notif"] .= 'Checkout succesfully..';
				$output['sq'] = "update t_guestbook set end_time = '".date('H:i:s')."' where IDEmployee='".$row->IDEmployee."' and Date = '".date('Y-m-d')."'";
			}else{
				$output["notif"] .= mysql_error();
			}
		}else{
			$output["notif"] .= 'Data Not Found...';
		}
}else{
	$q = "SELECT * FROM t_whitelist where password = '".$_GET['ftype']."' ";
	$row = db_query($q);
	$output = array();
	$output["sql"] = $q;
	$output["notif"] = '';
		if(!empty($row)){
			$exec = mysql_query("update t_checkin_ttc set end_time = '".date('H:i:s')."' where IDWhitelist='".$row->IDWhitelist."' and Date = '".date('Y-m-d')."'");
			if($exec){
				$output["notif"] .= 'Checkout succesfully..';
				$output['sq'] = "update t_guestbook set end_time = '".date('H:i:s')."' where IDWhitelist='".$row->IDWhitelist."' and Date = '".date('Y-m-d')."'";
			}else{
				$output["notif"] .= mysql_error();
			}
		}else{
			$output["notif"] .= 'Data Not Found...';
		}
	
	
}
$output["type"] = $_GET["ftype"];
// print_r($row);
echo json_encode($output);
?>