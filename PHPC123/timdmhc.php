<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>

</style>
<?php
require_once("database.php");
// Ham bo dau tieng viet
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
//echo "Tim DMHC !";
$db= new Database();
$db->connect();

function tramaHC($s,$ten,$manghc){
if($ten!=""){
	$sldau=count(explode(',',trim($ten)))-1;
	if($sldau==2) $ten=" ,".$ten;
	if($sldau==4) $ten=substr($ten,strpos($ten,',')+1,strlen($ten));
	//$ten=str_replace(,'',$ten);
	$mangten=explode(',',trim($ten));
	if(isset($mangten[0]))$thon=$mangten[0];
	if(isset($mangten[1])){$xa=strtolower(vn_to_str($mangten[1])); $xa=str_replace(['xa.','p.','q.','phuong.','.'],'',$xa);}
	if(isset($mangten[2])){$huyen=strtolower(vn_to_str($mangten[2])); $huyen=str_replace(['tp','thanhpho','tp.','.'],'',$huyen);}
	if(isset($mangten[3]))$tinh=strtolower(vn_to_str($mangten[3]));
	//$sql="select * from dmhc";
	//$manghc=$db->query($sql);
	
	$kq=TRUE;
	$i=0;
	$stt=1;
	while($kq and $i<count($manghc)){
		$pos1=0;$pos2=0;$pos3=0;
		if(isset($tinh))$pos1=strpos(strtolower(vn_to_str($manghc[$i]['tinh'])),$tinh);
		if(isset($huyen))$pos2=strpos(strtolower(vn_to_str($manghc[$i]['huyen'])),$huyen);
		if(isset($xa))$pos3=strpos(strtolower(vn_to_str($manghc[$i]['xa'])),$xa);
		if($pos1<>0 and $pos2<>0 and $pos3<>0){
			echo "<tr><td>".($s+1)."</td><td>".$thon."</td><td>"."'".$manghc[$i]['matinh']."</td><td>"."'".$manghc[$i]['mahuyen']."</td><td>"."'".$manghc[$i]['maxa']."</td></tr>";
			//$stt+=1;
			$kq=FALSE;
			
		}else {$i++;}
	}
	if($kq) echo "<tr><td>".($s+1)."</td><td class='ktt' colspan='4'>Không tìm thấy : xã : ".$xa." Huyện : ".$huyen." Tỉnh : ".$tinh."</td></tr>";
}	
}


//var_dump($db->getArray('dmhc'));
if($_POST['dmhc']){
	//echo $_POST['dmhc'];
	$tenhc=$_POST['dmhc'];
	$tenhc=str_replace("-",",",$tenhc);
	//$tenhc=strtolower($tenhc);
	//$tenhc=str_replace(['tp','thành phố','xã','phường'],'',$tenhc);
	$manghc=$db->getArray('dmhc');
	$mangten=explode("\n",$tenhc);
	//print_r($mangten);
	echo "<label>Kết quả tìm được :</label><table><tr><td>STT</td><td>Thôn, tổ, số nhà</td><td>Mã Tỉnh</td><td>Mã Huyện</td><td>Mã xã</td></tr>";
	for($i=0;$i<count($mangten);$i++){
		tramaHC($i,$mangten[$i],$manghc);
		//tramaHCNP($mangten[$i],$manghc,0,count($manghc));
	}
	echo "</table>";
	//tramaHC($tenhc,$manghc);
		//echo vn_to_str($mahc[$i]['huyen']);
	//$kq=array_search($tenhc,$manghc);
	//if($kq) echo "Tìm thấy tỉnh :".$mahc[$kq]['tinh'].$mahc[$kq]['huyen'].$mahc[$kq]['xa'];
	//else echo "Không tìm thấy :".$tenhc;
	$mang10=array_slice($manghc,0,1);
	//print_r($mang10);
	
}

/**
function tramaHCNP($ten,$manghc,$l,$r){
	$mid=$l+($r-1)/2;
	$sldau=count(explode(',',trim($ten)))-1;
	if($sldau==2) $ten=" ,".$ten;
	if($sldau==4) $ten=substr($ten,strpos($ten,',')+1,strlen($ten));
	//$ten=str_replace(,'',$ten);
	$mangten=explode(',',trim($ten));
	if(isset($mangten[0]))$thon=$mangten[0];
	if(isset($mangten[1])){$xa=strtolower(vn_to_str($mangten[1])); $xa=str_replace(['xa.','p.','q.'],'',$xa);}
	if(isset($mangten[2])){$huyen=strtolower(vn_to_str($mangten[2])); $huyen=str_replace(['tp','thanhpho'],'',$huyen);}
	if(isset($mangten[3]))$tinh=strtolower(vn_to_str($mangten[3]));
	//$sql="select * from dmhc";
	//$manghc=$db->query($sql);
	$kq=FALSE;
	$i=0;
	$pos1=0;$pos2=0;$pos3=0;
		if(isset($tinh))$pos1=strpos(strtolower(vn_to_str($manghc[$mid]['tinh'])),$tinh);
		if(isset($huyen))$pos2=strpos(strtolower(vn_to_str($manghc[$mid]['huyen'])),$huyen);
		if(isset($xa))$pos3=strpos(strtolower(vn_to_str($manghc[$mid]['xa'])),$xa);
		if($pos1<>0 and $pos2<>0 and $pos3<>0){
			echo "<tr><td>".$ten.$sldau."</td><td>".$thon."</td><td>".$manghc[$i]['matinh']."</td><td>".$manghc[$i]['mahuyen']."</td><td>".$manghc[$i]['maxa']."</td></tr>";
			$kq=TRUE;
		}else {tramaHCNP($ten,$manghc,$l,$mid-1);}
	if(!$kq){ tramaHCNP($ten,$manghc,$mid+1,$r);}
}
*/
?>