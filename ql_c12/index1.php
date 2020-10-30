<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>	
<link rel="stylesheet" type="text/css" href="./css/stylebt.css">
</head>
<body>
<!-- navigation menu-->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a href="#" class="navbar-brand" >
			<img src="img/banner2.png" height="50px">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="navbar navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="#">Trang chủ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Tra cứu C12</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Quản lý đơn vị</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Quản lý đơn vị</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Liên hệ</a>
				</li>
			</ul>
		</div>		
	</div>
</nav>
<?php
//include_once('library/connect.php');
//require_once('views/menu.php');

//$controller=$_GET['controller'];
echo "<div class='content1'>";
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
	case 'qlld': if(!empty($_SESSION['user'])){include_once('controllers/qlld.php');}
	break;
	case 'doipass': if(!empty($_SESSION['user'])){include_once('controllers/doipass.php'); }
	break;
	case 'qldsdn': if(!empty($_SESSION['user'])){include_once('controllers/qldsdn.php'); }
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
</body>
</html>