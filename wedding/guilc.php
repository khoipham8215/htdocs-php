<?php 
require "database.php";
$db=new Database();
if($_POST['tcd']!=''){
	$tencd=$_POST['tcd'];
	$tenkm=$_POST['tkm'];
	$loichuc=$_POST['lc'];
	$data=[];
	//var_dump($cauhoi);
	$data[0]['tencd']=$tencd;
	$data[0]['tenkm']=$tenkm;
	$data[0]['loichuc']=$loichuc;
	//var_dump($data);
	foreach ($data as $key => $value) {
		$db->insert('wedding',$value);
	}
	echo "Gửi lời chúc thành công !";
}else{
	echo "Không nhận được dữ liệu !";
}
//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
 ?>