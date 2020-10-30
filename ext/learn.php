<?php 
require "database.php";
$db=new Database();
if($_POST['monhoc']!=''){
	$monhoc=$_POST['monhoc'];
	$cauhoi=$_POST['cauhoi'];
	$cauhoi=explode("##",$cauhoi);
	$data=[];$ch=[];
	//var_dump($cauhoi);
	for($i=0;$i<count($cauhoi)-1;$i++){
		$ch=explode("#",$cauhoi[$i]);
		$data[$i]['monhoc']=htmlspecialchars($monhoc);
		$data[$i]['tieude']=htmlspecialchars($ch[0]);
		$data[$i]['da1']=htmlspecialchars($ch[1]);
		$data[$i]['da2']=htmlspecialchars($ch[2]);
		$data[$i]['da3']=htmlspecialchars($ch[3]);
		$data[$i]['da4']=htmlspecialchars($ch[4]);
		$data[$i]['da5']=htmlspecialchars($ch[5]);
		$data[$i]['dad']=htmlspecialchars($ch[6]);
		$data[$i]['td_md5']=md5(htmlspecialchars($ch[0]));
	}
	//var_dump($data);
	foreach ($data as $key => $value) {
		$db->insert('data',$value);
	}
	echo "Lưu dữ liệu thành công !".(count($cauhoi)-1)." câu đúng";
}
//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
 ?>