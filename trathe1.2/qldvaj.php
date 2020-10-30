<?php
header('Content-Type: text/html; charset=utf-8');
require_once("database.php");
$db= new Database();
$db->connect();
error_reporting(0);
	if(isset($_POST['user'])){
		//$diachi=$_POST['diachi'];
		$sdt=$_POST['sdt'];
		$email=$_POST['email'];
		//$nguoilh=$_POST['nguoilh'];
		$user=$_POST['user'];
		$hoten=$_POST['hoten'];
		//$sql4="select * from login where user like '".$user."' and pass = '".$pwdc."'";
		//$kq=$db->query($sql4);
		//echo $sql4;
		//echo $kq[0][1].$kq[0][2];
		$sql5= "update login set sdt='".$sdt."'".", email='".$email."'".", hoten='".$hoten."'"." where user='".$user."'";
		$db->query($sql5);
		echo " Cập nhật thông tin thành công !";
		//echo "<br/>".$sql5;
	}else echo " Cập nhật thông tin thất bại !";
?>