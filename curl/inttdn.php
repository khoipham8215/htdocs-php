<?php 
require "database.php";
$sql="select * from ttdn";
$db=new Database();
$kq=$db->query1($sql,MYSQLI_ASSOC);
for ($i=0; $i <count($kq) ; $i++) { 
	# code...
	echo $kq[$i]["mst"]."<br>";
}
	
 ?>