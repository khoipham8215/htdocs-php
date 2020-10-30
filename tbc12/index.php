<?php
session_start();
?>
<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    position: absolute;
}
 
.topnav {
    width: 100%;
    overflow: hidden;
    background-color: #333;
    position: fixed;
}
 
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
}
 
.topnav a:hover {
    background-color: #ddd;
    color: black;
}
 
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
.wrap{
	float:left;
	margin:55px 20px;
	width:100%;
	background-color: #ddd;
}
.content{
	display:none;
	width:auto;
	height:auto;
	padding:20px;
	
}
.content Button{
	float:right;
	font-size:1.2em;
	margin-left:5px;
}
.content label{
	font-size:1.2em;
	margin-left:5px;
}
#tieude{
	background-color:#006A9D;
	color:white;
	font-size:1.3em;
	text-align:center;
	padding:5px;
}
#flg{
	text-align:center;
	background-color:#f2f2f2;
	border:1px solid #006A9D;
	font-size:1.2em;
	padding:5px;
	
}
#flg input{
	font-size:1.2em;
	width:100%;
}
.tblg{
	text-align:left;
	width:100%;
	padding:10px;
}
.tblg td{
	padding:10px;
}
.btlg{
	width:100%;
	background-color:#006A9D;
	color:white;

	padding:5px;
}
#hint{
	font-size:1em;
	color:red;
}
#resultlg{
	font-size:1.2em;
	color: red;
}
.stlg{
	border:1px solid #006A9D;
}
.lg{
	font-size:1.2em;
	color: red;
}
</style>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
 $(function(){
	var content=document.getElementsByClassName("content");
	content[0].style.display="block";
	content[0].fadeIn();
	
 });
 function loadTab(obj){
		//alert(document.cookie);
		var i;
		//var atab=document.getElementsByClassName("topnav a");
		var atab=document.getElementsByTagName("a");
		var content=document.getElementsByClassName("content");
		
		for(i=0;i<atab.length;i++)
		{
			atab[i].style.backgroundColor="#333";
			//alert(content[i].innerHTML);
			content[i].style.display="none";
			
		}
		
		obj.style.backgroundColor="#4CAF50";
		if(obj.innerHTML=="Trang chủ"){
			content[0].style.display="block";
			content[0].fadeIn();
		}
		if(obj.innerHTML=="Tra cứu C12"){
			content[1].style.display="block";
			content[1].fadeIn();
		}
		if(obj.innerHTML=="Liên hệ"){
			content[2].style.display="block";
			content[2].fadeIn();
		}
		if(obj.innerHTML=="Đăng Nhập"){
			content[3].style.display="block";
			content[3].fadeIn();
		}
	}
function login(){
	//alert($("#user").val() + $("#pwd").val());
	/** $.ajax({
		url  : "login.php",
		type : "post",
		dataType : "text",
		data {
			user: $("#user").val(),
			pwd : $("#pwd").val()
		},
		success : function(responce){
			$("#resultlg").html(responce);
		}
	});
	*/
	$.ajax({
			url:"login.php",
			type:"POST",
			dataType: "text",
			data:{
				user: $("#user").val(),
				pwd: $("#pwd").val()
			},
			success:function(response){$("#resultlg").html(response);}
	});
}
</script>
<div class="topnav">
	<a  class="active" href="#" onClick="loadTab(this)">Trang chủ</a>
    <a  href="#" onClick="loadTab(this)">Tra cứu C12</a>
    <a  href="#" onClick="loadTab(this)">Liên hệ</a>
    <a  href="#" onClick="loadTab(this)">Đăng Nhập</a>

<?php
	/** if($_SESSION['user']!=null)
	{
		echo "<p class='lg'> Hello ".$_SESSION['user']."! <a>Log out </a> </p>";
	}else echo "<p class='lg'> Bạn chưa đăng nhập !</p>"; */
?>	
</div>

<div class="wrap" >
	<div class="content">
		<p>Trang chủ</p>
	</div>
	<div class="content">
		<p>Tra cứu C12</p>
	</div>
	
	<div class="content">
		<p>Liên hệ : khoipnv@gialai.vss.gov.vn</p>
	</div>
	<div class="content">
		<div id="tieude">Đăng nhập vào hệ thống !</div>
		<div id="flg">
			<label id="hint"><i> (Tên đăng nhập và mật khẩu mặc định là mã đơn vị vd : 'TA1000A'<br/> nếu chưa có liên hệ BHXH để cung cấp) </i></label><br/><table class="tblg"><tr>
			<td><label>Tên đăng nhập </label></td><td><input type="text" id="user" /></td></tr><tr>
			<td><label>Mật khẩu </label></td><td><input type="password" id="pwd" /></td></tr>
			<tr ><td colspan='2'><Button name="btlg" class ="btlg" onClick="login()">Đăng Nhập </Button></tr></table>
		</div>
		<div id="resultlg"></div>

	</div>

</div>