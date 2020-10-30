<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
//error_reporting(0);
	if(isset($_POST['madvi'])){
		$madvi=$_POST['madvi'];
		$sld=$_POST['sld'];
		$sql2="SELECT * FROM denghi WHERE madvi='".$madvi."'";
		$kq=$db->query($sql2);
		if(isset($kq)){
			$db->query("update denghi set landn=landn+1,`trangthai` = '0' where madvi='".$madvi."'");
		}else {
			$sql3="INSERT INTO `denghi` (`id`, `madvi`, `sld`, `ngaydn`, `nguoidn`, `trangthai`, `landn`) VALUES (NULL,'".$madvi."', '".$sld."',current_timestamp(), '', '', 1)";
			$db->query($sql3);
			echo " Cập nhật thông tin thành công ! ";
		}
		//echo " Cập nhật thông tin thành công !";
		// INSERT INTO `denghi` (`id`, `madvi`, `sld`, `ngaydn`, `nguoidn`, `trangthai`, `landn`) VALUES (NULL, 'HZ0096Z', '34', current_timestamp(), '', '', '');
		//header("Location:index.php");
		//echo "<br/>".$sql5;
	}else echo " Cập nhật thông tin thất bại !";
?>