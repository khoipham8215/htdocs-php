<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
session_start();
//include_once('library/connect.php');
require_once('menu.php');

//$controller=$_GET['controller'];
if(!isset($_GET['controller'])) {$_GET['controller']='user';}
switch($_GET['controller']){
	case 'trathebhyt':  if(!empty($_SESSION['user'])){include_once('trathebhyt.php');}
	break;
	case 'login': include_once('login.php');
	break;
	case 'logout': include_once('logout.php');
	break;
	case 'tramahc': if(!empty($_SESSION['user'])){include_once('tramahc.php');}
	break;
	case 'rasoatdl': if(!empty($_SESSION['user'])){include_once('rasoatdulieu.php');}
	break;
	case 'qltk': if(!empty($_SESSION['user'])){include_once('qltk.php');}
	break;
	case 'doipass': if(!empty($_SESSION['user'])){include_once('doipass.php');}
	break;
	case 'khomatsd': if(!empty($_SESSION['user'])){include_once('khomatsd.php');}
	break;
	default : include_once('login.php');
	break;
}
if(!isset($_SESSION['user'])){
		include_once('login_view.php');
	}else{
		echo "<div class='login'> Xin chào !  <a  href='index.php?controller=qltk' >".$_SESSION['user']."</a><a href='index.php?controller=logout'>  Đăng xuất </a></div>";
	}	
?>

	