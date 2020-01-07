<?php 
if($_SESSION['guestbook_building']->roles=='rpa' || $path[0]=='logout'){
	if(!empty($loader['konten']))require_once $loader['konten']; 
}else{
?>
<!DOCTYPE html>
<head>
<title>:: Portal Telkomsel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<!--<link rel="stylesheet" href="<?php echo url('themes/tmp/css/bootstrap.css')?>">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="<?php echo url('themes/tmp/css/style.css')?>" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="<?php echo url('themes/tmp/css/font.css')?>" type="text/css"/>
<link href="<?php echo url('themes/tmp/css/font-awesome.css')?>" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="themes/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="themes/easyui/themes/icon.css">
<!--//font-awesome icons -->
<script type="text/javascript" src="themes/tmp/js/jquery2.1.1.min.js"></script>

<script type="text/javascript" src="themes/tmp/js/bootstrap-3.3.7.min.js"></script>
<script src="<?php echo url('themes/tmp/js/modernizr.js')?>"></script>
<script src="<?php echo url('themes/tmp/js/jquery.cookie.js')?>"></script>
<script src="<?php echo url('themes/easyui/js/jquery.easyui.min.js')?>"></script>
<script src="<?php echo url('themes/easyui/js/datagrid-filter.js')?>"></script>

</head>
<body class="dashboard-page" style="background:#1f2227">
  <script>
          var theme = $.cookie('protonTheme') || 'default';
          $('body').removeClass (function (index, css) {
              return (css.match (/\btheme-\S+/g) || []).join(' ');
          });
          if (theme !== 'default') $('body').addClass(theme);
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
   </script>
	<div class="main-grid" style="margin:0;">
		<div id="toolbar" style="background:#ddd">			
			<?php if($_SESSION['guestbook_building']->roles=='admin'){}else{?>
			<a href="<?php echo url("input"); ?>" class="easyui-linkbutton" iconCls="icon-add" plain="true" >Isi Buku Tamu</a>
			<?php }?>
			<a href="<?php echo url("history-guestbook"); ?>" class="easyui-linkbutton" iconCls="icon-more" plain="true" >List Guestbook</a>
			<a href="<?php echo url("unchecked-guestbook"); ?>" class="easyui-linkbutton" iconCls="icon-more" plain="true" >Unchecked Guestlist</a>
			<?php 
			if($_SESSION['guestbook_building']->roles=='ttc' || $_SESSION['guestbook_building']->roles=='scc' || $_SESSION['guestbook_building']->roles=='admin'){
				?>
				<a href="<?php echo url("add-karyawan"); ?>" class="easyui-linkbutton" iconCls="icon-add" plain="true" >Tambah Karyawan</a>
				<a href="<?php echo url("list-karyawan"); ?>" class="easyui-linkbutton" iconCls="icon-more" plain="true" >List Karyawan</a>
				<?php 				
			}
			?>
			<?php 
			if($_SESSION['guestbook_building']->roles=='admin'){
				?>
				<a href="#" onclick="newRecordUser()" class="easyui-linkbutton" iconCls="icon-add" plain="true" >Tambah User</a>
				<a href="<?php echo url("list-user"); ?>" class="easyui-linkbutton" iconCls="icon-more" plain="true" >List User</a>
				<?php 				
			}
			?>
			<a style="float:right" href="<?php echo url("logout"); ?>" class="easyui-linkbutton" iconCls="icon-lock" plain="true" >Logout (<?php echo $_SESSION['guestbook_building']->username ?>)</a>
		</div>
        <?php 
		if(!empty($loader['konten']))require_once $loader['konten']; 
		?>
    </div>
</body>

</html>
<?php 
}
?>