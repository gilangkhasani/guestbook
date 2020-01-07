<?php
	switch($_SESSION['guestbook_windu']->roles){
		case 'anonim':
		$loader['konten'] = './page/form-guestbook.php';
		$loader['title'] = 'Guestbook Form';
		break;
	}
	//--Cek Session--
    require_once './includes/database.php';
    require_once './includes/loader.php';
?>