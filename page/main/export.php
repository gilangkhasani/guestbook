<?php 
if(isset($_POST['export'])){
	switch($_POST['report']){
		case 'mail':
			$data = db_query2list("Select *,omc_mail.site_id as site_id,dapot_site.site_name as site_name,dapot_site.oss_sitename as osssite_name From omc_mail left join dapot_site on omc_mail.site_id = dapot_site.site_id
			".$_POST['where']."
			order by open_ticket");
		    $array_export[0] = array('No','Ticket ID', 'Site ID', 'Site Name', 'OSS Name', 'TP Name','Ticket Trouble Number', 'PIC TP', 'Open Ticket', 'Respon TIme', 'Backup Time', 'Close Time', 'Status');
		    $no = 1;
		    foreach($data as $value){
		        $array_export[$no] = array($no, $value->ticketID,$value->site_id , $value->site_name, $value->osssite_name, $value->tp_name,$value->no_tt,$value->pic,$value->open_ticket,$value->respon_time,$value->temp_backup,$value->close_time,$value->log_status);
		        $no++;
		    }
		    $filename = "Export_".strtotime(date("Y-m-d H:i:s")).".csv";
		    
		    echo array2csv($array_export, $filename);
		    download_send_headers($filename);
		    //unlink('file/'.$filename);
		    die();
			break;
		case 'dapot':
		$data = db_query2list("Select * From dapot_site
										".$_POST['where']."
										order by site_id");
		    $array_export[0] = array('No', 'Site ID', 'Site Name', 'OSS Name', 'Ring Name','Longitude', 'Latitude', 'Alamat');
		    $no = 1;
		    foreach($data as $value){
		        $array_export[$no] = array($no, $value->site_id , $value->site_name, $value->oss_sitename, $value->ring_name,$value->longitude,$value->latitude,$value->alamat);
		        $no++;
		    }
		    $filename = "Export_".$_POST['report']."_".strtotime(date("Y-m-d H:i:s")).".csv";
		    
		    echo array2csv($array_export, $filename);
		    download_send_headers($filename);
		    //unlink('file/'.$filename);
		    die();
			break;
		default :
			break;
	}
}
?>