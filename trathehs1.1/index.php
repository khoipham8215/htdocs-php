<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
//include_once('library/connect.php');
require_once('menu.php');

//$controller=$_GET['controller'];
if(!isset($_GET['controller'])) {$_GET['controller']='user';}
switch($_GET['controller']){
	case 'trathehs':  include_once('trathehs.php');
	break;
	case 'bscksk': include_once('bscksk.php');
	break;
	case 'trathett': include_once('trathett.php');
	break;
	default : include_once('trathehs.php');
	break;
}
	
?>

	