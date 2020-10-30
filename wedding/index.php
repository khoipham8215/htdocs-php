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
		height: 550px;
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
		padding: 5px;
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
		padding: 5px;
	}
	.wrap{
		width: 90%;
		height:90%;
		box-shadow: 5px 5px 10px rgb(77, 77, 77);
		padding: 5px;
	}
	body{
		
	}
	.btn-info{
		background-color: #D8AF45;
		border: none; 
	}
	.btn-info:hover{
		background-color: #EDC585;
	}
	.btn-info:visited{
		background-color: #D8AF45;
	}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script type="text/javascript">
	function guilc(){
		//alert("Gửi lời chúc thành công !");
		var tencd=$(".tencd")[0].innerHTML;
		var tenkm=$(".tenkm").val();
		var loichuc=$(".loichuc").val();
		if(tenkm!='' && loichuc!=''){
		//alert(tencd+"<br>"+tenkm+"<br>"+loichuc);
		$.ajax({
						url : "guilc.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 tcd : tencd,
							 tkm : tenkm,
							 lc  : loichuc							
						},
						success : function (result){
							alert(result);
							//$('#resultp').html(result);
							//alert("Cập nhật thành công !")
							//$('#result').html(result);
							$(".row2").fadeOut();
							$(".row3").fadeIn();
						}
		});
		}else{alert("Bạn quên chúc rồi !");}
	}
</script>
</head>
<body>
<div class="container-fluid wrap ">
	<div class="row row1"></div>
	<div class="row row2"> 
	 	<div class="col-12 text-center hp">	Happy Wedding </div>
	 	<div class="col-12 text-center hp tencd" >  Quốc Lợi - Phương Thảo </div>
	 	<div class="col-12 text-left ht">  Hãy cùng gửi lời chúc trực tiếp, nồng nhiệt nhất đến cặp đôi hạnh phúc nhất đêm nay </div>
	 	<div class="col-12 text-left ht"><input type="text" name="tb" placeholder="Tên của bạn" class="tenkm"></div>
	 	<div class="col-12 text-left ht"><textarea class="loichuc"  type="text" rows="8" cols="40" name="nd" placeholder="Nội dung lời chúc (tối đa 500 kí tự)"></textarea></div>
	 	<div class="col-12 text-left ht"><button class="btn-info" type="button" name="send" id="btnsend" onclick="guilc()">GỬI LỜI CHÚC</button></div>
	</div>
	<div class="row row3 text-center">Wishing the love you exhibit to each other today, always be the first thoughts during any hard time in the future <br>
Signature
 </div>
	<div class="row row1"></div>
</div>

</body>
</html>

