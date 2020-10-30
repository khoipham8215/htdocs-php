<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tra cứu C12</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<body>
<!-- navigation menu-->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid" >
		<a href="#" class="navbar-brand" >
			<img src="img/banner2.png" height="50px">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="navbar navbar-collapse" id="navbarResponsive" >
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Trang chủ</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=timso1">Tìm ảnh scan sổ BHXH</a>
				</li>
	
			</ul>
			
		</div>
			
	</div>
</nav>
<?php
//include_once('library/connect.php');
//require_once('views/menu.php');

//$controller=$_GET['controller'];
//echo "<div class='content1'>";
if(!isset($_GET['controller'])) {$_GET['controller']='timso1';}
switch($_GET['controller']){
	
	case 'timso2': include_once('timso2.php'); 
	break;
	case 'timso1': include_once('timso1.php'); 
	break;
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
