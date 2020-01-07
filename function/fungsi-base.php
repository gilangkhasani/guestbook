<?php
function generateToken(){
	# --- ENCRYPTION ---

    # the key should be random binary, use scrypt, bcrypt or PBKDF2 to
    # convert a string into a key
    # key is specified using hexadecimal
    $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
    
    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
    # and 256 respectively
    $key_size =  strlen($key);
    
    $plaintext = "This string was AES-256 / CBC / ZeroBytePadding encrypted.";

    # create a random IV to use with CBC encoding
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    
    # creates a cipher text compatible with AES (Rijndael block size = 128)
    # to keep the text confidential 
    # only suitable for encoded input that never ends with value 00h
    # (because of default zero padding)
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $plaintext, MCRYPT_MODE_CBC, $iv);

    # prepend the IV for it to be available for decryption
    $ciphertext = $iv . $ciphertext;
    
    # encode the resulting cipher text so it can be represented by a string
    $ciphertext_base64 = base64_encode($ciphertext);

    return substr($ciphertext_base64, 0, 50);
}
function format_date($waktu){
		$explode = explode(" ",$waktu);
		$exop = explode("-",$explode[0]);
		if(count($explode)>1){
			$tgl = $exop[2]."/".$exop[1]."/".$exop[0]." ".$explode[1];
		}else{
			$tgl = $alarmtime;
		}
	return $tgl;
}
function format_date_jquery($waktu){
		//$explode = explode("/",$waktu);
		$exop = explode("/",$waktu);
		if(count($exop)>1){
			$tgl = $exop[2]."-".$exop[0]."-".$exop[1];
		}else{
			$tgl = $waktu;
		}
	return $tgl;
}
function format_date_2jquery($waktu){
		//$explode = explode("/",$waktu);
		$exop = explode("-",$waktu);
		if(count($exop)>1){
			$tgl = $exop[1]."/".$exop[2]."/".$exop[0];
		}else{
			$tgl = $waktu;
		}
	return $tgl;
}
function format_date_sub($waktu){
	$wkt = explode("|",$waktu);
	if(count($wkt)>2){
		$alarmtime = str_replace("_"," ",$wkt[2]).":00";
		$explode = explode(" ",$alarmtime);
		$exop = explode("-",$explode[0]);
		if(count($explode)>1){
			$tgl = $exop[2]."/".$exop[1]."/".$exop[0]." ".$explode[1];
		}else{
			$tgl = $alarmtime;
		}
	}else{
		$tgl = "0000-00-00 00:00:00";
	}
	return $tgl;
}
function convert_hari($hari){
	switch($hari){
		case 'Sunday' :
			$output = 'Minggu';
			break;
		case 'Monday':
			$output = 'Senin';
			break;
		case 'Tuesday':
			$output = 'Selasa';
			break;
		case 'Wednesday':
			$output = 'Rabu';
			break;
		case 'Thursday':
			$output = 'Kamis';
			break;
		case 'Friday':
			$output = 'Jumat';
			break;
		case 'Saturday':
			$output = 'Sabtu';
			break;
		default:
			$output = 'Unknown';
			break;
	}
	return $output;
}
function convert_bulan($bulan){
	switch ($bulan) {
		case '1':
			$output = 'Januari';
			break;
		case '2':
			$output = 'Februari';
			break;
		case '3':
			$output = 'Maret';
			break;
		case '4':
			$output = 'April';
			break;
		case '5':
			$output = 'Mei';
			break;
		case '6':
			$output = 'Juni';
			break;
		case '7':
			$output = 'Juli';
			break;
		case '8':
			$output = 'Agustus';
			break;
		case '9':
			$output = 'September';
			break;
		case '10':
			$output = 'Oktober';
			break;
		case '11':
			$output = 'November';
			break;
		case '12':
			$output = 'Desember';
			break;
		
		default:
			$output = 'Unknown';
			break;
	}
	return $output;
}
function get_tanggal_akhir($thn,$bln){
	$bulan[1]=31;
	$bulan[2]=28;
	$bulan[3]=31;
	$bulan[4]=30;
	$bulan[5]=31;
	$bulan[6]=30;
	$bulan[7]=31;
	$bulan[8]=31;
	$bulan[9]=30;
	$bulan[10]=31;
	$bulan[11]=30;
	$bulan[12]=31;

	if ($thn%4==0){
		$bulan[2]=29;
	}
	return $bulan[$bln];
}

function array2csv($array, $filename)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
	$fp = fopen('file_doc/'.$filename, 'w');
	foreach ($array as $fields) {
		fputcsv($fp, $fields);
	}
	fclose($fp);
   return ob_get_clean();
}

function download_send_headers($filename) {	
    header('Content-Type: application/csv;');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
	readfile("file_doc/".$filename);
    //header("Location: ".url("file_doc/".$filename));
}

function pagination($query,$per_page=0,$page=1,$url='?'){   
    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysqli_fetch_array(mysqli_query($query));
    $total = $row['num'];
    $adjacents = "2"; 
      
    $prevlabel = " Prev";
    $nextlabel = "Next ";
    $lastlabel = "Last &rsaquo;&rsaquo;";
    if($per_page==0) $per_page = 20;
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
       // $pagination .= "<ul class='pagination'>";
        $pagination .= "<a href='#'' class='btn icn-only'>Page {$page} of {$lastpage}</a>";
              
        if ($page > 1) $pagination.= "<a class='btn btn-success' href='{$url}page={$prev}'><i class='m-icon-swapleft m-icon-white'></i>{$prevlabel}</a>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<a class='btn btn-danger'>{$counter}</a>";
                else
                    $pagination.= "<a class='btn btn-default' href='{$url}page={$counter}&limit={$per_page}'>{$counter}</a>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<a class='btn btn-danger'>{$counter}</a>";
                    else
                        $pagination.= "<a class='btn btn-default' href='{$url}page={$counter}&limit={$per_page}'>{$counter}</a>";                    
                }
                $pagination.= " ... ";
                $pagination.= "<a class='btn btn-default' href='{$url}page={$lpm1}&limit={$per_page}'>{$lpm1}</a>";
                $pagination.= "<a class='btn btn-default' href='{$url}page={$lastpage}&limit={$per_page}'>{$lastpage}</a>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<a class='btn btn-default' href='{$url}page=1&limit={$per_page}'>1</a></li>";
                $pagination.= "<a class='btn btn-default' href='{$url}page=2&limit={$per_page}'>2</a></li>";
               	$pagination.= " ... ";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<a class='btn btn-danger'>{$counter}</a>";
                    else
                        $pagination.= "<a class='btn btn-default' href='{$url}page={$counter}&limit={$per_page}'>{$counter}</a>";                    
                }
                $pagination.= " ... ";
                $pagination.= "<a class='btn btn-default' href='{$url}page={$lpm1}&limit={$per_page}'>{$lpm1}</a>";
                $pagination.= "<a class='btn btn-default'href='{$url}page={$lastpage}&limit={$per_page}'>{$lastpage}</a>";      
                  
            } else {
                  
                $pagination.= "<a class='btn btn-default' href='{$url}page=1&limit={$per_page}'>1</a>";
                $pagination.= "<a class='btn btn-default' href='{$url}page=2&limit={$per_page}'>2</a>";
                $pagination.= " ... ";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<a class='btn btn-danger'>{$counter}</a>";
                    else
                        $pagination.= "<a class='btn btn-default' href='{$url}page={$counter}&limit={$per_page}'>{$counter}</a>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<a class='btn btn-success' href='{$url}page={$next}&limit={$per_page}'>{$nextlabel}<i class='m-icon-swapright m-icon-white'></i></a>";
                $pagination.= "<a class='btn blue' href='{$url}page=$lastpage&limit={$per_page}'>{$lastlabel}</a>";
            }
        //$pagination.= "</ul>";        
    }else{
        $pagination .= "<a href='#'' class='btn icn-only'>Page {$page} of {$lastpage}</a>";
        $pagination.= "<a class='btn btn-danger'>1</a>";
    }
      
    return $pagination;
}

function send_mail($sendto,$subject_mail,$isi_pesan){
	$to      = $sendto;
	$subject = $subject_mail;
	$message = $isi_pesan;
	$headers = 'From: cs@quickcorp.co.id' . "\r\n" .
	    'Reply-To: cs@quickcorp.co.id' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
}


function send_sms($notujuan,$isipesan){
	$isi=urlencode($isipesan);
	$hp=str_replace('+62', '0', $notujuan);
	$hp=str_replace(' ', '', $hp);
	$hp=str_replace('.', '', $hp);
	$hp=str_replace(',', '', $hp);
	$ho=trim($hp);
	$url="https://reguler.zenziva.net/apps/smsapi.php?userkey=pfrjh6&passkey=syahid10&nohp=$hp&pesan=".urlencode($isipesan)."";
	$data=file_get_contents($url);
	if(eregi('success', $data)){
		$hasil='1';
	}else{
		$hasil='0';
	}
	return $hasil;
}

function send_telegram($chat_id,$isi_pesan){
	ini_set('max_execution_time', 1200);
	$bot_token = '142893211:AAHZb7R-8KtAJOk8pkV5kBJGDLiCExu_hHM'; //alert_activity_bot
	$website = 'https://api.telegram.org/bot'.$bot_token;
	
	
	//echo $comma_separated = implode("", $arrText);
	//ini_set('default_socket_timeout', 500); 
	ini_set('max_execution_time', 500); //300 seconds = 5 minutes
	file_get_contents($website.'/sendMessage?chat_id='.$chat_id.'&text='.$isi_pesan.' by quick');
}

function color_category($value){
/*	00 - 20  primary  #3c8dbc
	20 - 40  Info     #00c0ef
	40 - 60  Success  #00a65a
	60 - 80  Warning  #f39c12
	80 - 100 Danger   #f56954 */
	$color = "";
	if ($value >0 and $value <=20){ $color = "#3c8dbc"; }
	elseif ($value >20 and $value <=40){ $color = "#00c0ef"; }
	elseif ($value >40 and $value <=60){ $color = "#00a65a"; }
	elseif ($value >60 and $value <=80){ $color = "#f39c12"; }
	elseif ($value >80){ $color = "#f56954"; }
	return $color;

}
function gettselldap($ldapuser,$ldappass){
	$adServer = "ldap://telkomsel.co.id";
	$ldap = ldap_connect($adServer);
	$ldaprdn = "telkomsel\\$ldapuser";
	$ldap_dn = 'dc=telkomsel,dc=co,dc=id';
	$pass = $ldappass;
	
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	$bind = @ldap_bind($ldap, $ldaprdn, $pass);
	if($bind){
	//$filter="(S=$samaccountname)";
	$ldap_user = $ldapuser;
	//$result = ldap_search($ldap, $ldap_dn, "(".$keywordtitle."=".$keyword.")");
	 $result = ldap_search($ldap, $ldap_dn, "(samaccountname=".$ldap_user.")");
	 //Nah ini untuk narik nilai atributnya.
	 $entries = ldap_get_entries($ldap, $result);
	 //Ini untuk munculin, tinggal dipilih-dipilih value mana yang mau diambil
	 foreach ( $entries as $key => $value)
	 {
		$ldap_att = new stdClass;
		$ldap_att->title = $value['title'][0];
		$ldap_att->description = $value['description'][0];
		$ldap_att->physicaldeliveryofficename = $value['physicaldeliveryofficename'][0];
		$ldap_att->telephonenumber = $value['telephonenumber'][0];
		$ldap_att->displayname = $value['displayname'][0];
		$ldap_att->department = $value['department'][0];
		$ldap_att->company = $value['company'][0];
		$ldap_att->samaccountname = $value['samaccountname'][0];
		$ldap_att->directorate = $value['extensionattribute13'][0];
		$ldap_att->group = $value['extensionattribute14'][0];
		$ldap_att->division = $value['extensionattribute15'][0];
		$ldap_att->mail = $value['mail'][0];
		$getmanager = explode(",",$value['manager'][0]);
		$ldap_att->manager = substr($getmanager[0],3,strlen($getmanager[0])-3);
		$ldap_att->mobile = $value['mobile'][0];
		$ldap_att->nik = $value['extensionattribute1'][0];
		$ldap_att->fullname = $value['extensionattribute7'][0];
		$ldap_att->loker = $value['extensionattribute6'][0];
		 }
		ldap_close($ldap);
		return $ldap_att;
	}
}

function gettselldap2($ldapuser,$ldappass,$ldapsearch){
	$adServer = "ldap://telkomsel.co.id";
	$ldap = ldap_connect($adServer);
	$ldaprdn = "telkomsel\\$ldapuser";
	$ldap_dn = 'dc=telkomsel,dc=co,dc=id';
	$pass = $ldappass;
	
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	$bind = @ldap_bind($ldap, $ldaprdn, $pass);
	if($bind){
	//$filter="(S=$samaccountname)";
	$ldap_user = $ldapsearch;
	//$result = ldap_search($ldap, $ldap_dn, "(".$keywordtitle."=".$keyword.")");
	 $result = ldap_search($ldap, $ldap_dn, "(cn=".$ldap_user.")");
	 //Nah ini untuk narik nilai atributnya.
	 $entries = ldap_get_entries($ldap, $result);
	 //Ini untuk munculin, tinggal dipilih-dipilih value mana yang mau diambil
	 foreach ( $entries as $key => $value)
	 {
		$ldap_att = new stdClass;
		$ldap_att->title = $value['title'][0];
		$ldap_att->description = $value['description'][0];
		$ldap_att->physicaldeliveryofficename = $value['physicaldeliveryofficename'][0];
		$ldap_att->telephonenumber = $value['telephonenumber'][0];
		$ldap_att->displayname = $value['displayname'][0];
		$ldap_att->department = $value['department'][0];
		$ldap_att->company = $value['company'][0];
		$ldap_att->samaccountname = $value['samaccountname'][0];
		$ldap_att->directorate = $value['extensionattribute13'][0];
		$ldap_att->group = $value['extensionattribute14'][0];
		$ldap_att->division = $value['extensionattribute15'][0];
		$ldap_att->mail = $value['mail'][0];
		$getmanager = explode(",",$value['manager'][0]);
		$ldap_att->manager = substr($getmanager[0],3,strlen($getmanager[0])-3);
		$ldap_att->mobile = $value['mobile'][0];
		$ldap_att->nik = $value['extensionattribute1'][0];
		$ldap_att->fullname = $value['extensionattribute7'][0];
		$ldap_att->loker = $value['extensionattribute6'][0];
		 }
		ldap_close($ldap);
		return $ldap_att;
	}
}
?>

