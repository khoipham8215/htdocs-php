<?php 
require "database.php";
$db=new Database();

//$kq=$db->query1($sql,MYSQLI_ASSOC);
//var_dump($kq);
$monhoc=$_POST['monhoc'];
$sql="select * from data where monhoc like '".$monhoc."'";
//$monhoc=explode("#", $monhoc);
//for ($i=0; $i <count($monhoc)-1 ; $i++) { 
//	$monhoc[$i]=md5(htmlspecialchars($monhoc[$i]));
//}
//var_dump($cauhoimd5);
$kq=$db->query1($sql,MYSQLI_ASSOC);
echo "<h2>".$monhoc."</h2>";
echo "Tổng số câu : ".(count($kq))."<br>";
//echo $sql;
for($i=0;$i<count($kq);$i++){
	// kiểm tra các đáp án
	//$dk= " ".$cauhoimd5[$i];
	//$sql1=$sql.$monhoc[$i]."'";
	
	if(isset($kq)){
		$tieude=htmlspecialchars_decode($kq[$i]['tieude']);
		$da1=htmlspecialchars_decode($kq[$i]['da1']);
		$da2=htmlspecialchars_decode($kq[$i]['da2']);
		$da3=htmlspecialchars_decode($kq[$i]['da3']);
		$da4=htmlspecialchars_decode($kq[$i]['da4']);
		$da5=htmlspecialchars_decode($kq[$i]['da5']);
		$dad=htmlspecialchars_decode($kq[$i]['dad']);
		if($da5=='0' ){$da5='';}else{$da5=$da5."<br>";}
		if($da4=='0' ){$da4='';}else{$da4=$da4."<br>";}
		if($dad=='0' ){$dad='';}else{$dad=$dad."<br>";}
	echo "<b><font color='red' size='3' >Câu hỏi :".($i+1)."</font></b><br><font color='blue' size='2' >".$tieude."</font><br>".$da1."<br>".$da2."<br>".$da3."<br>".$da4.$da5.$dad."<hr>";
	}else {echo "Câu hỏi :".($i+1).$monhoc[$i]." Chưa có đáp án "."<hr>";}
	//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
	//echo "Câu hỏi :".($i+1).$tieude."<br>".$da1."<br>".$da2."<br>".$da3."<br>".$da4."<br>".$dad."<hr>";
}
 ?>