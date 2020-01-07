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
	$output["sql"] = $q;$output["notif"] = '';
	$output["table"] = '<table class="table striped  cell-hovered" style="font-size:12px;">';
		if(!empty($row)){
			mysql_query("insert into t_checkin_scc(IDEmployee,Date,Start_time) values('".$row->IDEmployee."','".date('Y-m-d')."','".date('H:i:s')."')");
			$output["table"] .= '<tbody class="load-black">';
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Name</td>";
				$output["table"] .= "<td>".$row->fullname."</td>";
				$output["table"] .= "</tr>";
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Email</td>";
				$output["table"] .= "<td>".$row->email."</td>";
				$output["table"] .= "</tr>";
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Telephone/Hp</td>";
				$output["table"] .= "<td>".$row->tlp."</td>";
				$output["table"] .= "</tr>";
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Telephone/Hp</td>";
				$output["table"] .= "<td>".$row->Employee."</td>";
				$output["table"] .= "</tr>";
			$output["table"] .= '</tbody>';
			$output["notif"] .= 'Checkin Successfully...';
		}else{
			$output["table"] .= "<tr>";
			$output["table"] .= "<td class='align-center' colspan='5'>Data Not Found!!! please register via <a href='guest'>gusetbook</a></td>";
			$output["table"] .= "</tr>";
			$output["notif"] .= 'Data Not Found...';
		}
	$output["table"] .= '</table>';
}else{
	$q = "SELECT * FROM t_whitelist where password = '".$_GET['ftype']."' ";
	$row = db_query($q);
	$output = array();
	$output["sql"] = $q;$output["notif"] = '';
	$output["table"] = '<table class="table striped  cell-hovered" style="font-size:12px;">';
		if(!empty($row)){
			mysql_query("insert into t_checkin_ttc(IDWhitelist,Date,Start_time) values('".$row->IDWhitelist."','".date('Y-m-d')."','".date('H:i:s')."')");
			$output["table"] .= '<tbody class="load-black">';
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Name</td>";
				$output["table"] .= "<td>".$row->Name."</td>";
				$output["table"] .= "</tr>";
				$output["table"] .= "<tr>";
				$output["table"] .= "<td>Jabatan</td>";
				$output["table"] .= "<td>".$row->Posisi."</td>";
				$output["table"] .= "</tr>";
			$output["table"] .= '</tbody>';
			$output["notif"] .= 'Checkin Successfully...';
		}else{
			$output["table"] .= "<tr>";
			$output["table"] .= "<td class='align-center' colspan='5'>Data Not Found!!! please register via <a href='guest'>gusetbook</a></td>";
			$output["table"] .= "</tr>";
			$output["notif"] .= 'Data Not Found...';
		}
	$output["table"] .= '</table>';

}
$output["type"] = $_GET["ftype"];
// print_r($row);
echo json_encode($output);
?>