<?php 
    // memulai session
    date_default_timezone_set("Asia/Jakarta");
    session_start();
    //empty($_SESSION['rushone-administrator']) ? : $_SESSION['rushone-administrator'] = 'anonim';
    if(empty($_SESSION['guestbook_windu']->roles)){
		$user = new stdClass;
		$user->roles = 'anonim';
        $user->name = 'anonim';
        $user->username = 'anonim';
		$_SESSION['guestbook_windu']->roles = 'anonim';
        $_SESSION['guestbook_windu'] = $user;
    }
	
    require_once('function/fungsi-path.php');
    require_once('function/fungsi-sql.php');
    require_once('function/fungsi-base.php');
	
	
    if(!empty($_GET['q'])){
        $path = explode("/",$_GET['q']);
    }
	
    try {
        require_once './includes/session.php';
    }
    catch(Exception $error) {
        print $error->getMessage();
    }
	
    if($_SESSION['guestbook_windu']->roles == 'anonim'){
		!empty($path[0]) ? $url = $path[0]: $url = "";
		if($url == 'ticket'){
			require_once('page/ticket-guestbook.php');
		} else if ($url == 'form') {
			require_once('page/form-guestbook.php');
		} else {
			require_once('page/menu.php');
		}
        
    }
?>