<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tra cứu C12</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
<!-- navigation menu-->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a href="#" class="navbar-brand" >
			<img src="../img/banner2.png" height="50px">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="navbar navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Trang chủ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=cnc12">Quản lý trường</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=qlup">Quản lý upload</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=qldsdn">Quản lý đơn vị</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=docdsld">Quản lý lao động</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=qluser">Hệ thống</a>
				</li>
				
			</ul>
			<div class="container-fluid text-right" id="login">
				<div class="col-12">
					<?php
						session_start();	
					 if(!isset($_SESSION['user'])){ ?>
					<a  href="index.php?controller=loginql" class="btn btn-success">Đăng nhập</a>
				<?php }else{  
					echo "Xin chào !  <a class='btn btn-success' href='index.php?controller=cnc12' >".$_SESSION['user']."</a><a class='btn btn-success' href='index.php?controller=logout'>  Đăng xuất </a>";
				 } ?>
				</div>
			</div>	
		</div>
			
	</div>
</nav>
<?php
//require_once 'PHPExcel.php';
//require_once 'database.php';
//session_start();
//$controller=$_GET['controller'];
if(!isset($_GET['controller'])) {$_GET['controller']='loginql.php';}
switch($_GET['controller']){
	case 'cnc12': if(!empty($_SESSION['user'])){include_once('cnc12.php'); }
	break;
	case 'qlup': if(!empty($_SESSION['user'])){include_once('qlup.php'); }
	break;
	case 'qluser': if(!empty($_SESSION['user'])){include_once('qluser.php'); }
	break;
	case 'qldsdn': if(!empty($_SESSION['user'])){include_once('qldsdn.php'); }
	break;
	case 'docdsld': if(!empty($_SESSION['user'])){include_once('docdsld.php'); }
	break;
	case 'loginql': include_once('loginql.php'); 
	break;
	case 'logout': include_once('logout.php'); 
	break;
	default : if(!empty($_SESSION['user'])){include_once('cnc12.php'); }
	break;
}
	//echo " Bạn đăng nhập với tên :".$_SESSION['user'];
	// header("Location:../index.php?controller=login");
if(!isset($_SESSION['user'])){
		include_once('login_view_admin.php');
	}
?>
<footer>
	<div class="container-fluid col-12"  >
		<hr class="bg-light">
		© Phòng CNTT, BHXH Tỉnh Gia Lai
	</div>
</footer>
</body>
</html>