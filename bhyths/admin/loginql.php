<?php
//header('Content-Type: text/html; charset=UTF-8');
//session_start();
require("database.php");
//echo " Login success !";
$db= new Database();
$db->connect();
//error_reporting(0);
//echo "Đã đăng nhập";
	if(isset($_POST['user'])){
		$user=strtolower(trim($_POST['user']));
		$pwd=strtolower(trim($_POST['pwd']));
		//echo $user.$pwd;
		$sql = "select * from login_ql where user like '".$user."'";
		$rt =$db->query1($sql,MYSQLI_ASSOC);
		//var_dump($rt);
		//echo $rt[0]['user'].$rt[0]['pass'];
		if(isset($rt)){
			if($pwd==strtolower($rt[0]['pass'])){
				//echo $rt[0]['user'].$rt[0]['pass'];
				//echo " Login success ! Hello :".$rt[0][1].$rt[0][4];
				$_SESSION['user']=$rt[0]['user'];
				$_SESSION['quyen']=$rt[0]['quyen'];
				$db->query("update login_ql set luottruycap=luottruycap+1 where user='".$rt[0]['user']."'");
				header("Location:index.php");
				
			}else echo "<div  class='container-fluid kqt'>Sai pass, vui lòng nhập lại !".$rt[0]['user']."</div>";
			
		}else echo "<div class='container-fluid kqt'> User không tồn tại !</div>";
	
	}else include_once('login_view_admin.php');
?>