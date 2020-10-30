<?php
require_once 'PHPExcel.php';
require_once 'database.php';
session_start();
if($_SESSION['user']=="admin"){
?>
<style> 
.wrap{
	width:90%;
	margin:auto;
	background-color:#F4FBF4;
}
.menu{
	background-color:#58257B;
	width:100%;
	float:left;
	text-align:center;
	
}
.ulmenu li{
	display:block;
	font-size: 1.2em;
	color:white;
	font-style:"times";
	padding:5px;
	background-color:#00537c;
	width:18%;
	float:left;
	border:1px solid white;
	margin-right:2px;
	font-weight:bold;
	cursor: pointer;
}
.ulmenu{
	width:100%;
}
.hidden{
	display:none;
}
#content{
	border: 1px solid;
	padding-top:10px;
	display:block;
}
.ath{
		font-size:1em;
		margin:auto;
		margin-top:10px;
		
		
	}
</style>

<?php
require_once('menu_ad.php');

//$controller=$_GET['controller'];
if(!isset($_GET['controller'])) {$_GET['controller']='cnc12';}
switch($_GET['controller']){
	case 'cnc12': if(!empty($_SESSION['user'])){include_once('import_c12_excel.php'); }
	break;
	case 'qlup': if(!empty($_SESSION['user'])){include_once('qlup.php'); }
	break;
	default : if(!empty($_SESSION['user'])){include_once('qlup.php'); }
	break;
}
}else header("Location:../index.php?controller=login");
	//echo " Bạn đăng nhập với tên :".$_SESSION['user'];
	// header("Location:../index.php?controller=login");
?>