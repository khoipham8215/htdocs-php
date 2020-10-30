<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
error_reporting(0);
	if(isset($_POST['sdt'])){
		$sdt=explode("\n",$_POST['sdt']);
		echo "Cập nhật số dòng :".count($sdt);
		for($i=0;$i<count($sdt)-1;$i++)
		{
			$s=explode("#",$sdt[$i]);
			$lop=$s[0];
			$soBhxh=$s[1];
		//$sql4="select * from login where user like '".$user."' and pass = '".$pwdc."'";
		//$kq=$db->query($sql4);
		//echo $sql4;
		//echo $kq[0][1].$kq[0][2];
		
			$sql6= "update dsld set maPb='".$lop."'"." where soBhxh='".$soBhxh."'";
			$db->query($sql6);
			//echo $sql6;
		}
		//echo " Cập nhật thông tin thành công !";
		$db->query("update login set luotsuatt=luotsuatt+1 where user='".$_SESSION['user']."'");
		echo "<meta http-equiv='refresh' content='0'>";
		echo " Cập nhật thông tin thành công !";
		//header("Location:index.php");
		//echo "<br/>".$sql5;
	}else echo " Cập nhật thông tin thất bại !";
?>