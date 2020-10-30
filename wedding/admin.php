<!DOCTYPE html>
<html>
<head>
	<title> Happy Wedding</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<style type="text/css">
	@import url("https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Parisienne&display=swap");
	.row1{
		width: 98%;
		height: 120px;
		background-image: url("img/hoavan1.png");
		background-repeat: repeat-x;
		padding: 0px;
		margin:auto;
	}
	.row2{
		width: 100%;
		height: auto;
		font-family: 'Dancing Script', cursive !important;
		font-size: 25px;
		margin:auto;
		color: #D8AF45;
	}
	.row3{
		display: none;
		width: 100%;
		height: auto;
		font-family: 'Dancing Script', cursive !important;
		font-size: 25px;
		margin-top:5%;
		color: #D8AF45;
	}
	.row2 .hp{
		font-size: 40px;
	}
	.row2 input, textarea,button{
		border-radius: 10px 10px;
		font-family: 'times';
		font-size: 20px;
		border: 1px solid #D8AF45;
		color: #D8AF45;
		width: 95%;
	}
	.wrap{
		width: 90%;
		box-shadow: 5px 5px 10px rgb(77, 77, 77);
		padding: 0px;
	}
	body{
		
	}
	.btn-info{
		background-color: #D8AF45;
		border: none; 
		margin:5px;
	}
	.btn-info:hover{
		background-color: #EDC585;
	}
	.btn-info:visited{
		background-color: #D8AF45;
	}
	.btn-info:active{
		background-color: #D8AF45;
	}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script type="text/javascript">
	function getloichuc(){
		//alert("Gửi lời chúc thành công !");
		var tencd=$(".tencd").val();
		//alert(tencd);
		//alert(tencd+"<br>"+tenkm+"<br>"+loichuc);
		$.ajax({
						url : "getlc.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 tcd : tencd,
							 						
						},
						success : function (result){
							//alert(result);
							//$('#resultp').html(result);
							//alert("Cập nhật thành công !")
							//$('#result').html(result);
							$(".row3").html(result);
							$(".row3").fadeIn();
						}
		});
		
	}
	function xuatlc(){
		alert("Đang hoàn thiện !");
	}
</script>
</head>
<body>
<?php 
require "database.php";
$db=new Database();
$kq=$db->query1("SELECT DISTINCT `tencd` FROM `wedding` WHERE 1",MYSQLI_ASSOC);
 ?>
<div class="container-fluid wrap ">
	<div class="row row1"></div>
	<div class="row row2 text-center">&nbsp;&nbsp; Chọn tên cặp đôi &nbsp;&nbsp;
	 	<select class="tencd">
	 		<?php
	 			for ($i=0; $i <count($kq) ; $i++) { 
	 				echo "<option>".$kq[$i]['tencd']."</option>";
	 			}
	 		   ?>
	 	</select>
	 	<button class="btn-info getlc" onclick="getloichuc()"> Xem lời chúc</button>
	 	<button class="btn-info getlc" onclick="xuatlc()"> Xuất Excel</button>
	</div>
	<div class="row3"></div>
	<div class="row row1"></div>
</div>

</body>
</html>

