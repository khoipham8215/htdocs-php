<?php 
require("database.php");
//echo " Login success !";
$db= new Database();
$db->connect();

//error_reporting(0);
//echo "Đã đăng nhập";
	if(isset($_POST['user'])){
		$user=strtolower(trim($_POST['user']));
		$pwd=trim($_POST['pwd']);
		//echo $user.$pwd;
		$sql = "select * from login where mail like '".$user."'";
		$rt =$db->query1($sql,MYSQLI_ASSOC);
		//var_dump($rt);
		//echo $rt[0]['user'].$rt[0]['pass'];
		if(isset($rt)){
			if($pwd==strtolower($rt[0]['pwd'])){
				//echo $rt[0]['user'].$rt[0]['pass'];
				//echo " Login success ! Hello :".$rt[0][1].$rt[0][4];
				session_start();
				$_SESSION['user']=$rt[0]['user'];
				$_SESSION['level']=$rt[0]['level'];
				$db->query("update login set luottruycap=luottruycap+1 where user='".$rt[0]['user']."'");
				echo "Đăng nhập thành công!";
				//header("Location:index.php");
				
			}else echo "Sai pass, vui lòng nhập lại !";
			
		}else echo "User không tồn tại !";
	
	}
 ?>