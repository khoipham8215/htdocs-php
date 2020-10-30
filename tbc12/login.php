<?php
header('Content-Type: text/html; charset=UTF-8');
//session_start();
require("database.php");
//echo " Login success !";
$db= new Database();
$db->connect();
$user=trim($_POST['user']);
$pwd=$_POST['pwd'];
$sql = "select * from login where user like '".$user."'";
$rt =$db->query($sql);
if(isset($rt)){
	if($pwd==$rt[0][2]){
		echo " Login success ! Hello :".$rt[0][1].$rt[0][4];
		$_SESSION['user']=$rt[0][1];
		$_SESSION['quyen']=$rt[0][4];
	}else echo " Nhập sai pass, vui lòng nhập lại !".$rt[0][1];
	//print_r($rt);
}else echo " User khong ton tai !";
?>