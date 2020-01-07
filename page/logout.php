<div class="row hr-container-content">
	<?php
	$user = new stdClass;
	$user->name_roles = 'anonim';
	$user->name = 'anonim';
	$user->username = 'anonim';
	unset($_SESSION['guestbook_building']);
	$_SESSION['guestbook_building'] = $user;
	echo '<section id="main" class="bg-one">';
	echo status('Logout');
	echo '</section>';
	echo redirect('/guestbook');
	?>
</div>