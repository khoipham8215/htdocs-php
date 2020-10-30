<?php
//header('Content-Type: text/html; charset=UTF-8');
//session_start();
require("database.php");
//echo " Login success !";
$db= new Database();
$db->connect();
error_reporting(0);
if(!isset($_SESSION['user'])){
	if(isset($_POST['user'])){
		$user=strtolower(trim($_POST['user']));
		$pwd=strtolower(trim($_POST['pwd']));
		//echo $user.$pwd;
		$sql = "select * from login where user like '".$user."'";
		$rt =$db->query1($sql,MYSQLI_ASSOC);
		//var_dump($rt);
		//echo $rt[0]['user'].$rt[0]['pass'];
		if(isset($rt)){
			if($pwd==strtolower($rt[0]['pass'])){
				//echo $rt[0]['user'].$rt[0]['pass'];
				//echo " Login success ! Hello :".$rt[0][1].$rt[0][4];
				$_SESSION['user']=$rt[0]['user'];
				$_SESSION['quyen']=$rt[0]['pass'];
				$db->query("update login set luottruycap=luottruycap+1 where user='".$rt[0]['user']."'");
				if($rt[0]['luottruycap']==0){
					header("Location:index.php?controller=doipass&l=0");
				}else header("Location:index.php");
			}else echo "<div class='container-fluid kqt'>Sai pass, vui lòng nhập lại !".$rt[0]['user']."</div>";
			
		}else echo "<div class='container-fluid kqt' class='kq'> User không tồn tại !</div>";
	
	}//else echo "<p class='kq'>vui long dang nhap !"</p>;
}
?>