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
    
}
.login{
	width:300px;
    background-color: #045FB4;
    position: fixed;
	color:white;
	position:absolute;
	left:750px;
	top:100px;
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
	float:left;
	margin:55px 20px;
	width:100%;
	background-color: red;
}
.content{
	display:none;
	width:auto;
	height:auto;
	padding:20px;
	margin-top:50px;
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
.contentup{
		margin:auto;
		border-style:solid;
		border-color:#045FB4;
		border-width:1px;
		font-family:arial;
		font-size:1.2em;
		padding:5px;
		background-color:#E6E6E6;
		padding:5px;
		margin-top:55px;
	}
	#fileUpload {
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
		width:300px
	}
	.contentup button{
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin:5px;
		margin-left:50px;
	}
	.contentup select{
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin:5px;
	}
	.dl{
		background-color:blue;
		border-width:1px;
		color:white;
		font-size:1em;
	}
	.hidden{
		display:none;
	}
	.btluu{
		border:1px solid black;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin-right:5px;
		float:auto;
	}
	#loadmss{
	text-align:center;
	position:absolute;
	top:300px;
	right:50%;
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
<div class="banner"><a href="https://gialai.baohiemxahoi.gov.vn"><img src="../img/banner.png" /></a></div>
<div class="topnav">
	<a  class="active" href="#" onClick="loadTab(this)">Trang chủ</a>
    <a  href="index.php?controller=cnc12" onClick="loadTab(this)">Cập nhật C12</a>
    <a  href="index.php?controller=cndmdv" onClick="loadTab(this)">Cập nhật danh mục đơn vị</a>
    <a  href="index.php?controller=qluser" onClick="loadTab(this)">Quản lý user </a>
	<a  href="index.php?controller=qlup" onClick="loadTab(this)">Quản lý upload</a>
</div>

