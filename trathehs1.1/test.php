<?php
	if("abc"=="ABC"){
		echo "abc== ABC <br/>";
	}else echo "abc != ABC<br/>";
	if("abc"==="ABC"){
		echo "abc=== ABC<br/>";
	}else echo "abc != ABC<br/>";
	if(strcasecmp("abc","Abc")==0){
		echo 'strcasecmp("abc","Abc")='.strcasecmp("abc","Abc").'<br/>';
	}else echo "abc != ABC<br/>";
	if(strcmp("abc","Abc")==0){
		echo 'strcmp("abc","Abc")='.'strcmp("abc","Abc")<br/>';
	}else echo 'strcmp("abc","Abc")='.strcmp("abc","Abc")." abc != ABC<br/>";
	
	echo 'strcasecmp("đỗ công danh","Đỗ Công Danh")='.strcasecmp("đỗ công danh","Đỗ Công Danh").'<br/>';
	echo 'strcasecmp("abc","Abc")='.strcasecmp("abc","Abc").'<br/>';
	$m="MAI TIẾN THÀNH";
	//$m=strtolower($m);
	echo 'strcasecmp('.$m.',"Mai Tiến Thành")='.strcasecmp($m,"Mai Tiến Thành").'<br/>';
	echo 'similar_text("MAI TIẾN THÀNH","Mai Tiến Thành",$pecent)='.similar_text("MAI TIẾN THÀNH","Mai Tiến Thành",$pecent)." %= ".$pecent.'<br/>';
	echo 'similar_text("mai tiến thanh","Mai Tiến Thành",$pecent)='.similar_text("mai tiến thanh","Mai Tiến Thành",$pecent)." %= ".$pecent.'<br/>';
	echo 'similar_text("mai tiến dũng","Mai Tiến Thành",$pecent)='.similar_text("mai tiến dũng","Mai Tiến Thành",$pecent)." %= ".$pecent.'<br/>';
	echo 'similar_text("đỗ công danh","Đỗ Công Danh",$pecent)='.similar_text("đỗ công danh","Đỗ Công Danh",$pecent)." %= ".$pecent.'<br/>';
	$m1="MAI TIẾN THÀNH";
	$m2="Mai Tiến Thành";
	$m1=str_replace(' ','',$m1);
	$m2=str_replace(' ','',$m2);
	echo 'similar_text('.$m1.','.$m2.',$pecent)='.similar_text($m1,$m2,$pecent)." %= ".$pecent.'<br/>';
	$chuoi="";
	for($i=12; $i<434;$i+=10)
	$chuoi=$chuoi."G".$i."+";
	echo $chuoi."<br/>";
	$ht="Duyn";
	//$ht=strtolower(vn_to_str($ht));
	echo "duyn==Duyn :".strcasecmp($ht,"duyn")."<br/>";
	$ns="1.1.2007";
	$ns=subStr($ns,strlen($ns)-4,4);
	echo $ns."<br/>";
function vn_to_str ($str){

$unicode = array(
 
'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
 
'd'=>'đ',
 
'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
 
'i'=>'í|ì|ỉ|ĩ|ị',
 
'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
 
'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
 
'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
 
'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
 
'D'=>'Đ',
 
'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
 
'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
 
'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
 
'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
 
'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
 
);
foreach($unicode as $nonUnicode=>$uni){
 
$str = preg_replace("/($uni)/i", $nonUnicode, $str);
 
}
$str = str_replace(' ','',$str);
 
return $str;
 
}
?>