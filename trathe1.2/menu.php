<?php
session_start();
?>
<style>
body{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    position: absolute;
	width:100%;
}
 
.topnav {
    width: 100%;
    overflow: hidden;
    background-color: #333;
    
}
#flogin{
	width:30%;
	margin:10px 10px;
}
.login{
	width:300px;
    background-color: #045FB4;
    position: fixed;
	color:white;
	position:absolute;
	left:600px;
	top:20px;
	padding:5px;
	font-weight:bold;
	text-align:center;
}
.login a{
	color: #f2f2f2;
}
.login a:hover{
	background-color: #ddd;
    color: black;
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
.topnav a:visited {
    background-color: #ddd;
    color: white;
}
 
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
.wrap{
	border: 1px solid blue;
	display:block;
	float:left;
	width:auto;
	background-color: #ddd;
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
.lg a{
	font-size:1.2em;
	color: red;
}
.hidden{
	display:none;
}
p.kq{
	font-size:1.2em;
	color:red;
	margin-top:55px;
}
.banner img{
	width:500px;
	
}
.muser{
	background-color:red;
	position:absolute;
	left:650px;
	top:130px;
	z-index:99;
	padding:5px;
	display:none;
}
#dpass{
	margin-top:60px;
	background-color:red;
}
.wrap1{
	border: 1px solid blue;
	display:block;
	float:left;
	margin:5px 10px;
	width:auto;
	background-color: #ddd;
}
.content1{
	width:auto;
	height:auto;
	padding:20px;
	
}
.content1 Button{
	float:right;
	font-size:1.2em;
	margin-left:5px;
}
.content1 label{
	font-size:1.2em;
	margin-left:5px;
}
#dmhc table td{
	border:1px solid blue;
	margin:0;
}
#dmhc{
	float:left;
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
#loadmss{
	text-align:center;
	position:absolute;
	top:300px;
	left:40%;
	display:none;
	z-index:999;
	border:2px solid #337AB7;
	width:400px;
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
.cta{
	float:left;
	
	margin-right:30px;
}
.ctb{
	float:left;
	
	margin-right:30px;
}
.ctc{
	float:left;
	border:2px solid red;
	margin-right:30px;
	color:blue;
	padding:5px;
}
.ctd{
	float:left;
	border:2px solid red;
	margin-right:30px;
	color:blue;
	padding:5px;
}
.content2{
	width:auto;
	height:auto;
	padding:20px;
	
}
.content2 Button{
	float:right;
	font-size:1.2em;
	margin-left:5px;
}
.content2 label{
	font-size:1.2em;
	margin-left:5px;
}
.tb{
	font-size:22px;
	color:red;
	margin: 10px 10px;
}
</style>
<link ref="stylesheet" type="text/css" href="../css/style.css">
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
		//var content=document.getElementsByClassName("content");
		
		for(i=0;i<atab.length;i++)
		{
			atab[i].style.backgroundColor="#333";
			//alert(content[i].innerHTML);
			//content[i].style.display="none";
			
		}
		
		obj.style.backgroundColor="#4CAF50";
		obj.addClass("active");
		
}

</script>
<body>
<div class="banner"><a href="https://gialai.baohiemxahoi.gov.vn"><img src="img/banner.png" /></a></div>
<div class="topnav">
	<a  class="active" href="#" onClick="loadTab(this)">Trang chủ</a>
    <a  href="index.php?controller=trathebhyt" onClick="loadTab(this)">Tra thẻ BHYT </a>
    <a  href="index.php?controller=tramahc" onClick="loadTab(this)">Tìm mã hành chính</a>
	<a  href="index.php?controller=rasoatdl" onClick="loadTab(this)">Rà soát dữ liệu</a>
	<a  href="index.php?controller=login" onClick="loadTab(this)">Đăng nhập</a>
	<a  href="index.php?controller=khomatsd" onClick="loadTab(this)">Kho Mã thẻ tái sử dụng</a>
	<a  href="filemau/mautrathe3.xlsx" >Tải file mẫu tra thẻ</a>
    
</div>

<div id="loadmss">
	<div class="loadtd">Trạng thái </div>
	<div class="loadtb">Đang xử lý vui lòng đợi trong giây lát...</div>
	<div class="loadimg"><img src="img/load1.gif" /></div>
</div>
</body>
