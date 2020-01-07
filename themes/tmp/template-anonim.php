<?php
empty($_POST['username']) ? $username = '' : $username = $_POST['username'];
empty($_POST['password']) ? $password = '' : $password = md5($_POST['password']);
$message = NULL;
if(isset($_POST['login'])){
  if(empty($username) || empty($password)){
    $message = "Wajib diisi semuanya!";
  }else{
    $q_check = mysql_query("SELECT a.*,b.building_name,tlp_gedung,extension FROM user a LEFT JOIN building b ON a.id_building=b.id_building where a.username = '$username' and a.password = '$password'");
    $check = mysql_fetch_object($q_check);
    if(!empty($check)){
      unset($_SESSION['guestbook_building']);
      $_SESSION['guestbook_building'] = $check;
	  //$_SESSION['guestbook_building']->roles = "recepsionis";
	  //$_SESSION['guestbook_building']->roles_resepsionis = 'all';
	  $_SESSION['guestbook_building']->fullname = $check->fullname;
	  
      $message = "Berhasil";
      $date = date("Y-m-d H:i:s");
      //mysql_query("insert into `log` (username, date_login) values ('$username', '$date')");
      echo status('Berhasil!!!');
      echo redirect('history-guestbook');
      return;
    }else{
      $message = "Username dan Password salah";
    }
  }
  //echo "SELECT a.*,b.building_name,tlp_gedung,extension FROM USER a LEFT JOIN building b ON a.id_building=b.id_building where a.username = '$username' and a.password = '$password'";
}

echo $message;
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>:: Guestbook Login</title>
  
  
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="<?php echo url('themes/tmp/css_login/style.css')?>">

  
</head>

<body style="background:#1f2227">
  <div class="login-wrap">
	<div class="login-html" >
		<h1 align=center style="color:#ef391f">Guestbook</h1>
		<h5 align=center style="color:#ef391f">Guestbook</h5>
		<!--
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		-->
		<div class="login-form">
			<form method="post">
			<div class="">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input name="username" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input name="password" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input type="submit" name="login" class="button" value="Sign In" style="background:#ef391f">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
			</form>
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up" style="background:#ef391f">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>


    
    
    
  </body>
</html>
