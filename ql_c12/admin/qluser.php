<style>
.tbhs{
	border-collapse: separate;
	border-spacing:0;
	border:1px solid #ebebeb;
	padding:5px;
	margin:5px;
	
}
.tbhs th{
	background-color:#337ab7;
	color :white;
	padding:2px;
	border:1px solid;
	font-size:20px;
}
.tbhs td{
	border:1px solid #ebebeb;
	padding:2px;
	
}
</style>
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db=new Database();
$db->connect();
$sql="select * from login where luottruycap > 0";
$kq=$db->query1($sql,MYSQLI_ASSOC);
if(isset($kq)){
	$stt=1;
	echo "<table class='tbhs'><tr><th>STT</th><th>id</th><th>Tên đăng nhập</th><th>email</th><th>Lượt đăng nhập</th><th>Lượt tra C12</th><th>Lượt TH C12</th><th>Lượt sửa thông tin</th><th>Lượt đổi pass</th><th>Lượt in C12</th><th>Lượt in C11</th><th>Pass</th><th>Ngày</th></tr>";
	foreach($kq as $k){
		echo "<tr><td>".$stt."</td><td>".$k['id']."</td><td>".$k['user']."</td><td>".$k['email']."</td><td>".$k['luottruycap']."</td><td>".$k['luottrac12']."</td><td>".$k['luotthc12']."</td><td>".$k['luotsuatt']."</td><td>".$k['luotdoipass']."</td><td>".$k['luot_inc12']."</td><td>".$k['luot_inc11']."</td><td>".$k['pass']."</td><td>".$k['ngaydn']."</td></tr>";
		$stt++;
	}
}
?>
</table>