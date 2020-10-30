<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
error_reporting(0);
	if(isset($_POST['user'])){
		$diachi=$_POST['diachi'];
		$sdt=$_POST['sdt'];
		$email=$_POST['email'];
		$nguoilh=$_POST['nguoilh'];
		$user=$_POST['user'];
		//$sql4="select * from login where user like '".$user."' and pass = '".$pwdc."'";
		//$kq=$db->query($sql4);
		//echo $sql4;
		//echo $kq[0][1].$kq[0][2];
		$sql5= "update dmdv set Diachi='".$diachi."'".", Dienthoai='".$sdt."'".", Email='".$email."'".", nguoilh='".$nguoilh."'"." where Madvi='".$user."'";
		$db->query($sql5);
		echo " Cập nhật thông tin thành công !";
		$db->query("update login set luotsuatt=luotsuatt+1 where user='".$_SESSION['user']."'");
		//echo "<br/>".$sql5;
	}else echo " Cập nhật thông tin thất bại !";
?>