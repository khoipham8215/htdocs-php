<?php 
require "database.php";
$db=new Database();
$sql="select * from data where td_md5 like '";
//$kq=$db->query1($sql,MYSQLI_ASSOC);
//var_dump($kq);
$num=$_POST['numq'];
$cauhoimd5=$_POST['cauhoimd5'];
$cauhoimd5=explode("#", $cauhoimd5);
$num=explode("#", $num);
//var_dump($num);
for ($i=0; $i <count($cauhoimd5)-1 ; $i++) { 
	$cauhoimd5[$i]=md5(htmlspecialchars($cauhoimd5[$i]));
}
//var_dump($cauhoimd5);
$c=0;
echo "Tổng số câu : ".(count($cauhoimd5)-1)."<br>";
for($i=0;$i<count($cauhoimd5)-1;$i++){
	// kiểm tra các đáp án
	//$dk= " ".$cauhoimd5[$i];
	$sql1=$sql.$cauhoimd5[$i]."'";
	$kq=$db->query1($sql1,MYSQLI_ASSOC);
	if(isset($kq)){
		$tieude=htmlspecialchars_decode($kq[0]['tieude']);
		$da1=htmlspecialchars_decode($kq[0]['da1']);
		$da2=htmlspecialchars_decode($kq[0]['da2']);
		$da3=htmlspecialchars_decode($kq[0]['da3']);
		$da4=htmlspecialchars_decode($kq[0]['da4']);
		$da5=htmlspecialchars_decode($kq[0]['da5']);
		$dad=htmlspecialchars_decode($kq[0]['dad']);
		if($da5=='0' ){$da5='';}else{$da5=$da5."<br>";}
		if($da4=='0' ){$da4='';}else{$da45=$da4."<br>";}
		if($dad=='0' ){$dad='';}else{$dad=$dad."<br>";}
	echo "<b><font color='red' size='3' >Câu hỏi :".($num[$i])."</font></b><br><font color='blue' size='2' >".$tieude."</font><br>".$da1."<br>".$da2."<br>".$da3."<br>".$da4.$da5.$dad."<hr>";
	$c++;
	}else {echo "Câu hỏi :".($num[$i])." Chưa có đáp án "."<hr>";}

	//echo $_POST['monhoc'].'-'.$_POST['cauhoi'];
	//echo "Câu hỏi :".($i+1).$tieude."<br>".$da1."<br>".$da2."<br>".$da3."<br>".$da4."<br>".$dad."<hr>";
}
echo "Số câu đúng / tổng số : ".$c."/".(count($cauhoimd5)-1);
 ?>