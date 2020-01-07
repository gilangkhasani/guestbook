<?php
empty($_POST['username']) ? $username = '' : $username = $_POST['username'];
empty($_POST['password']) ? $password = '' : $password = md5($_POST['password']);
$message = NULL;
if(isset($_POST['login'])){
  if(empty($username) || empty($password)){
    $message = "Wajib diisi semuanya!";
  }else{
    $q_check = mysql_query("SELECT a.*,b.building_name FROM 16011164_portal.user a LEFT JOIN 16010754_sik.building b ON a.id_building=b.id_building where a.username = '$username' and a.password = '$password'");
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
  echo "select * from `user` where username = '$username' and password = '$password'";
}

echo $message;
?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>| Login :: Portal Telkomsel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="<?php echo url('themes/tmp/css/bootstrap.css')?>">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="<?php echo url('themes/tmp/css/style.css')?>" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="<?php echo url('themes/tmp/css/font.css')?>" type="text/css"/>
<link href="<?php echo url('themes/tmp/css/font-awesome.css')?>" rel="stylesheet"> 
<!-- //font-awesome icons -->
</head>
<body class="signup-body" style="background:#2f2e2f">
        <div class="agile-signup">  
            
            <div class="content2" style="border-radius: 0;">
                <div class="grids-heading gallery-heading signup-heading" style="background:#4e4d4e;color:#fff;font-family:serif;">
                    <img src="<?php echo url('themes/img/logo-tsel.png'); ?>" style="width:50%">
					<h5 style="background:#4e4d4e;color:#fff;font-family: monospace;">Portal Telkomsel</h5>
                </div>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="Username" >
                    <input type="password" name="password" placeholder="Password" >
                    <input type="submit" class="register" name="login" value="Login" style="background:#4e4d4e;color:#fff;font-family:serif;border:2px solid #e30331;border-radius: 30px;"> 
                </form>
				<!-- 
                <div class="signin-text">
                    <div class="text-left">
                        <p><a href="#"> Forgot Password? </a></p>
                    </div>
                    <div class="text-right">
                        <p><a href="signup.html"> Create New Account</a></p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <h5>- OR -</h5>
                <div class="footer-icons">
                    <ul>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="twitter facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter chrome"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="twitter dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <a href="index.html">Back To Home</a>
            </div>
				-->
            
            <!-- footer -->
            <div class="copyright" style="font-family:monospace">
                <p>© 2017 Design by <a href="http://jabar.telkomsel.co.id/" target="_blank" style="color:#4e4d4e">IT Support Bussiness Jabar</a></p>
            </div>
            <!-- //footer -->
            
        </div>
    
</body>
</html>
