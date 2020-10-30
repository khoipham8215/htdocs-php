<?php
require_once 'PHPExcel.php';
require_once 'database.php';
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
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
			flag=0;        
			function loadqt(){
				if(flag==0){
					$('#loadadmin').removeClass('hidden');
					$('#loadadmin').fadeIn();
					flag=1;
				}
				if(flag==2){
					$('#loadtrac12').fadeOut();
					$('#loadtrac12').addClass('hidden');
					$('#loadadmin').removeClass('hidden');
					$('#loadadmin').fadeIn();
					flag=1;
				}
				
			}
			function loadtc12(){
				if(flag==0){
					$('#loadtrac12').removeClass('hidden');
					$('#loadtrac12').fadeIn();
					flag=2;
				}
				if(flag==1){
					$('#loadadmin').fadeOut();
					$('#loadadmin').addClass('hidden');
					$('#loadtrac12').removeClass('hidden');
					$('#loadtrac12').fadeIn();
					flag=2;
				}
			}
			
        </script>
		
<div class="wrap">
<div class="menu">
<ul name ="ulmenu" class="ulmenu">
	<li onclick="loadqt()"> Quản trị </li>
	<li onclick="loadtc12()"> Tra cứu C12 </li>
	<li ><a class="ath" href="tonghopc12.php" target="_blank"> Tổng hợp C12 </a></li>
	<li > Tra thông tin đơn vị </li>
	<li> Chức năng khác </li>
</ul>
</div>
<?php
 
?>
<div id="content">
	<div class="hidden" id="loadadmin">
	 <?php require_once("admin/import_c12_excel.php"); ?>
	</div>
	<div class="hidden" id="loadtrac12">
	 <?php require_once("tracuuc12.php"); ?>
	</div>
	
</div>
<div class='demo' onclick="loadtime()">Trạng thái ... </div>
</div>