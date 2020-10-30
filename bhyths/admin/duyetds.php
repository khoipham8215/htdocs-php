<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db=new Database();
$db->connect();
//$sql="select * from login where luottruycap > 0";
//$kq=$db->query1($sql,MYSQLI_ASSOC);
if(isset($_POST['duyet'])){
	$madvi=$_POST['madvi'];
	$tt=$_POST['duyet'];
	$sql="UPDATE `denghi` set `trangthai`='".$tt."' WHERE `madvi`='".$madvi."'";
	//echo $sql;
	$kq=$db->query($sql);
	echo "Duyệt thành công !";
}else echo "Duyệt thất bại !";
?>
