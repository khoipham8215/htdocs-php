<?php 
require "database.php";
$db=new Database();
$sql="SELECT DISTINCT `monhoc` FROM `data` WHERE 1";
$kq=$db->query1($sql,MYSQLI_ASSOC);
//var_dump($kq);
echo "<p> Chọn môn học :<select id='monhoc' name='monhoc'>";
for($i=0;$i<count($kq);$i++){
	
	//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
	echo "<option name='mh'>".$kq[$i]['monhoc']."</option>";
}
echo "</select></p>";
 ?>