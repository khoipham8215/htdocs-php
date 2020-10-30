
<?php
//include_once('library/connect.php');
require_once('views/menu.php');

//$controller=$_GET['controller'];
if(!isset($_GET['controller'])) {$_GET['controller']='user';}
switch($_GET['controller']){
	case 'trac12': if(!empty($_SESSION['user'])){include_once('controllers/trac12.php'); }
	break;
	case 'tonghopc12': if(!empty($_SESSION['user'])){include_once('controllers/tonghopc12.php'); }
	break;
	case 'login':  include_once('controllers/login.php');
	break;
	case 'logout': include_once('controllers/logout.php');
	break;
	case 'qldv': if(!empty($_SESSION['user'])){include_once('controllers/qldv.php');}
	break;
	case 'doipass': if(!empty($_SESSION['user'])){include_once('controllers/doipass.php'); }
	break;
	default : include_once('controllers/login.php');
	break;
}
	if(!isset($_SESSION['user'])){
		include_once('views/login_view.php');
	}else{
		echo "<div class='login'> Xin chào !  <a  href='index.php?controller=qldv' >".$_SESSION['user']."</a><a href='index.php?controller=logout'>  Đăng xuất </a></div>";
	}
?>

	