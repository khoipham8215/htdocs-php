<?
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
?>
<style>
.fup{
	margin-top:55px;
	border:1px solid;
	padding:10px;
}
.fup input,button{
	font-size:20px;
}
.dshs{
	width:300px;
	float :left;
}
.dshs td{
	border:1px solid;
}
.trathe{
	float :left;
	width:800px;
	border:1px solid;
}
.trathe select,option{
	font-size:20px;
	height:30px;
}
#txtdltra{
	display :none;
}
#loadmss{
	text-align:center;
	position:absolute;
	top:300px;
	right:30%;
	display:none;
	z-index:999;
	border:2px solid #337AB7;
	width:300px;
	height:auto;
	
	background-color:white;
}
.loadtd{
	background-color:#337AB7;
	color:white;
	font-size:20px;
	padding :5px;
}
.loadtb{
	color:#337AB7;
	font-size:20px;
}
#over{
	width:100%;
	height:100%;
	opacity:0.6;
	background-color:#000;
	z-index:99;
	display:none;
	position:fixed;
	top:0;
	left:0;
}
.ftt{
	width:100%;
	padding:10px;
}
.ftt input{
	font-size:20px;
	color:red;
}
.ftt label{
	font-size:20px;
	margin:5px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
 <script language="javascript">
            function trathehs(){
				$("#loadmss").fadeIn();
				$('body').append('<div id="over">');
				$("#over").fadeIn();
				//var mangtra=new Array();
				//alert($("select[name='loaitc']").val() + $("select[name='namps']").val());
                $.ajax({
                    url : "trathettaj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 loaitc : $("select[name='loaitc']").val(),	
						 namps : $("select[name='namps']").val(),
						 hoten : $("#hoten").val(),
						 ngaysinh : $("#ngaysinh").val(),
						 diachi: $("input[name='diachi']").val(),	
						 
                    },
                    success : function (result){
						$("#over").fadeOut();
						$("#loadmss").fadeOut();
						$('#kqtra').html(result);
                        //$('#result').html(result);
                    }
                });
            }
</script>

<body>
<div id="loadmss">
	<div class="loadtd">Trạng thái xử lý</div>
	<div class="loadtb">Đang xử lý vui lòng đợi trong giây lát...</div>
	<div class="loadimg"><img src="img/load1.gif" /></div>
</div>
<div class="ftt">
<label>Nhập họ tên</label><input name="hoten" type="text" id="hoten">
<label>Nhập họ tên</label><input name="ngaysinh" type="text" id="ngaysinh">
</div>
<div class="trathe">
<label> Chọn loại tra cứu </label>
<select name="loaitc">
<option value="1">Tra theo họ tên có dấu + ngày sinh </option> 
<option value="2">Tra theo họ tên có dấu + năm sinh </option>
<option value="3">Tra theo họ tên có dấu + năm sinh + địa chỉ </option> 
<option value="4">Tra theo họ tên không dấu + ngày sinh </option>
<option value="5">Tra theo họ tên không dấu + năm sinh </option>   
</select>

<label> Lọc theo địa chỉ </label>
<input type="text" name="diachi" />
<Button type="button" name="tracuuthe" onclick="trathehs()" >Tra thẻ BHYT</Button>
</div>
<div id="kqtra">
</div>

</body>