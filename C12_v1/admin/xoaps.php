<style>

</style>
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db=new Database();
$db->connect();
//$sql="select * from login where luottruycap > 0";
//$kq=$db->query1($sql,MYSQLI_ASSOC);
if(isset($_POST['macqql'])){
	$macqql=$_POST['macqql'];
	$thangps=$_POST['thangps'];
	$sql="DELETE FROM `c12` WHERE `macqql`='".$macqql."' AND `thangps`='".$thangps."'";
	//echo $sql;
	$kq=$db->query($sql);
	if(!isset($kq)){
		echo "Đã xóa thành công C12 của CQQL :".$macqql." Tháng PS : ".$thangps;
	}else echo "Xóa thất bại !";

}
?>
</table>