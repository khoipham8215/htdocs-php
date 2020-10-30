<?php 
require "database.php";
$db=new Database();
if($_POST['tcd']!=''){
	$tencd=$_POST['tcd'];
	$sql="SELECT * from wedding where tencd like '%".$tencd."%' order by ngaygui DESC";
	$kq=$db->query1($sql,MYSQLI_ASSOC);
	//var_dump($data);
	//echo $sql.count($kq);
	echo '<table class="table table-hover">';
	echo "<tr><td><font color='red'>Tên khách mời</font></td><td><font color='red'>Lời chúc</font></td><td><font color='red' >Ngày gửi</font></td></tr>";
	for ($i=0; $i <count($kq) ; $i++) { 
		echo "<tr><td>".$kq[$i]['tenkm']."</td><td>".$kq[$i]['loichuc']."</td><td><font size='1em'>".date('d/m/Y H:i:s',strtotime($kq[$i]['ngaygui']))."</font></td></tr>";
	}
	echo "</table>";
	//echo "Gửi lời chúc thành công !";
}else{
	echo "Không nhận được dữ liệu !";
}
//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
 ?>