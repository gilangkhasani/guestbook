<?php
if(!empty($_GET['q'])){
    switch(strtolower($_GET['q'])){

    // GLobal 
    case b('home'):
    case b('home/'):
		$loader = loader($_SESSION['guestbook_windu']->roles,array('anonim'), './page/menu.php', 'Guestbook');
		$id = $path[0];
		break;
    case b('ticket'):
		$loader = loader($_SESSION['guestbook_windu']->roles,array('anonim'), './page/ticket-guestbook.php', 'Ticket Guestbook');
		$id = $path[0];
		break;
	case b('form'):
		$loader = loader($_SESSION['guestbook_windu']->roles,array('anonim'), './page/form-guestbook.php', 'Form Guestbook');
		$id = $path[0];
		break;
	
    case b('logout'):
		$loader = loader($_SESSION['guestbook_windu']->roles,array('ttc','scc','anonim','admin','rpa','guest','resepsionis'), './page/logout.php', 'Quick Corp');
		$id = $path[0];
		break;
    // END 
    default : 
		$loader = loader($_SESSION['guestbook_windu']->roles,array('anonim','admin','user'), './page/no-page.php', 'No Page');
		$id = $path[0];
        break;
    }
	
}
?>