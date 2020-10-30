<?php
require_once("database.php");
$db= new Database();
$db->connect();
error_reporting(0);
	if(isset($_POST['user'])){
		$user=$_POST['user'];
		$pwdc=$_POST['pwdc'];
		$pwdm=$_POST['pwdm'];
		$sql4="select * from login where user like '".$user."' and pass = '".$pwdc."'";
		$kq=$db->query($sql4);
		//echo $sql4;
		//echo $kq[0][1].$kq[0][2];
		if($kq!=null){
			$sql5= "update login set pass='".$pwdm."' where user='".$user."'";
			//echo "<br/> Sql5 ".$sql5;
			$kq2=$db->query($sql5);
			if(!$kq2){
				session_start();
				$db->query("update login set luotdoipass=luotdoipass+1 where user='".$_SESSION['user']."'");
				//echo $db->query($sql5);
				echo " Đổi mật khẩu thành công !";
			}else echo " Đổi mật khẩu thất bại !";
		}else { echo " Mật khẩu cũ bạn nhập không đúng !"; }
	}else echo " Không đổi được !";
?>