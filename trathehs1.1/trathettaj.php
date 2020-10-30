<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
p.td{
	font-size:30px;
	color:red;
	text-align:center;
}
.kt{
	color:red;
}
</style>
<?php

header('Content-Type: text/html; charset=utf-8');
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


error_reporting(0);
require_once 'database.php';
$db= new Database();
$db->connect();

$stt=1;
if($_POST['loaitc']){
	//echo "<br/><br/><br/><p>Loại tra cứu : ".$_POST['loaitc']." Năm tra cứu : ".$_POST['namps'].$_POST['diachi']."</p>";
	//$sql="select * from thebhyt where right(`denNgay`,4) like '".$_POST['namps']."'";
	$sql="select * from thebhyt";
	$manghs=$db->query1($sql,MYSQLI_ASSOC);
	//$dltra=explode("\n",$_POST['dltra']);
	$hoten=$_POST['hoten'];
	$ngaysinh=$_POST['ngaysinh'];
	$mangkq=[];
	$mangkt=[];
	$bd=time();
	$dc=$_POST['diachi'];
	$dc=strtolower(vn_to_str($dc));
	
		if($hoten!=""){
			switch($_POST['loaitc']){
				case 1 : $mangkq=tratheBHYT1($hoten,$ngaysinh,$manghs);
				break;
				case 2 : $mangkq=tratheBHYT2($hoten,$ngaysinh,$manghs);
				break;
				case 3 : $mangkq=tratheBHYT3($hoten,$ngaysinh,$manghs,$dc);
				break;
				case 4 : $mangkq=tratheBHYT4($hoten,$ngaysinh,$manghs);
				break;
				case 5 : $mangkq=tratheBHYT5($hoten,$ngaysinh,$manghs);
				break;
				default:$mangkq=tratheBHYT1($hoten,$ngaysinh,$manghs);
				break;
			}
			
			//if(!empty(tratheBHYT1($dltra[$i],$manghs))){
			//tratheBHYT1($dltra[$i],$manghs,$stt);
			//$stt++;
			//array_push($mangkq,tratheBHYT1($dltra[$i],$manghs));
			//$mangkq.push(tratheBHYT1($dltra[$i],$manghs));
			//}else echo "<br/>Không tìm thấy : ".$i.$dltra[$i];
		}
		//echo "Tra thẻ :".$dltra[$i]."\n";
	
	//echo $sql;
if(count($mangkq)>0){
	echo "<p>Tổng danh sách cấp thẻ năm ".$_POST['namps']." là ".count($manghs)."</p>";
	echo "<br/>Tổng thời gian tra thẻ là ".(time()-$bd)." giây";
	// in kết quả tra được
	echo "<br/><b>Tổng số thẻ tìm thấy : ".count($mangkq)."</b>";
	echo "<p class ='td'> Danh sách thẻ tìm thấy </p>";
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị cấp thẻ</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ từ ngày</th><th>Hạn thẻ đến ngày</th><th>Ngày cấp</th><th>Địa chỉ</th></tr>";
	for($i=0;$i<count($mangkq);$i++){
			$id=$mangkq[$i];
			//$dl=explode("#",$dltra[$i]);
			//$marasoat=$dl[2];
			echo "<tr ><td>".($i+1)."</td><td>".$manghs[$id]['maDonViThu']."</td><td>".($manghs[$id]['soBhxh'])."</td><td>".($manghs[$id]['soKcb'])."</td><td>".($manghs[$id]['hoTen'])."</td><td>".($manghs[$id]['ngaySinh'])."</td><td>".($manghs[$id]['tuNgay'])."</td><td>".($manghs[$id]['denNgay'])."</td><td>".($manghs[$id]['ngayCap'])."</td><td>".($manghs[$id]['diaChiLh'])."</td></tr>";
	}
}else echo "<br/>Không Tìm thấy : ".$hoten.$ngaysinh;
	
	/**
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ từ ngày</th><th>Hạn thẻ đến ngày</th><th>Ngày cấp</th><th>Địa chỉ</th></tr>";
	$j=1;
	for($i=0;$i<count($mangkq);$i++){
		$id=$mangkq[$i];
		//$madt=subStr($manghs[$id]['soKcb'],0,2);
		$madt=$manghs[$id]['maDoiTuong'];
		if($madt!="HS"){
		echo "<tr><td>".$j."</td><td>".$manghs[$id]['maDonViThu']."</td><td>".($manghs[$id]['soBhxh'])."</td><td>".($manghs[$id]['soKcb'])."</td><td>".($manghs[$id]['hoTen'])."</td><td>".($manghs[$id]['ngaySinh'])."</td><td>".($manghs[$id]['tuNgay'])."</td><td>".($manghs[$id]['denNgay'])."</td><td>".($manghs[$id]['ngayCap'])."</td><td>".($manghs[$id]['diaChiLh'])."</td></tr>";
		//echo "<p>".($i+1)." - ".$manghs[$mangkq[$i]]['id']." - ".$manghs[$mangkq[$i]]['maDonViThu']." - ".$manghs[$mangkq[$i]]['soBhxh']." - ".$manghs[$mangkq[$i]]['soKcb']." - ".$manghs[$mangkq[$i]]['namht']." - ".$manghs[$mangkq[$i]]['hoTen']."-".$manghs[$mangkq[$i]]['ngaySinh']."</p>";
		$j++;
		}
		
	}	
	echo "</table>";
	echo "<br/><b>Tổng số học sinh có thẻ đối tượng khác : </b>".($j-1);
	echo "<p class ='td'> Danh sách học sinh năm ".$_POST['namps']." có thẻ đối tượng học sinh </p>";
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ từ ngày</th><th>Hạn thẻ đến ngày</th><th>Ngày cấp</th><th>Địa chỉ</th></tr>";
	$j=1;
	for($i=0;$i<count($mangkq);$i++){
		$id=$mangkq[$i];
		//$pos=strpos($manghs[$id]['maDonViThu'],'BD');
		//echo "Vị trí tìm thấy BD : ".$pos."-".$manghs[$id]['maDonViThu'];
		//$madt=subStr($manghs[$id]['soKcb'],0,2);
		$madt=$manghs[$id]['maDoiTuong'];
		if($madt=="HS"){
		echo "<tr><td>".$j."</td><td>".$manghs[$id]['maDonViThu']."</td><td>".($manghs[$id]['soBhxh'])."</td><td>".($manghs[$id]['soKcb'])."</td><td>".($manghs[$id]['hoTen'])."</td><td>".($manghs[$id]['ngaySinh'])."</td><td>".($manghs[$id]['tuNgay'])."</td><td>".($manghs[$id]['denNgay'])."</td><td>".($manghs[$id]['ngayCap'])."</td><td>".($manghs[$id]['diaChiLh'])."</td></tr>";
		//echo "<p>".($i+1)." - ".$manghs[$mangkq[$i]]['id']." - ".$manghs[$mangkq[$i]]['maDonViThu']." - ".$manghs[$mangkq[$i]]['soBhxh']." - ".$manghs[$mangkq[$i]]['soKcb']." - ".$manghs[$mangkq[$i]]['namht']." - ".$manghs[$mangkq[$i]]['hoTen']."-".$manghs[$mangkq[$i]]['ngaySinh']."</p>";
		$j++;
		}
	}
	
	echo "</table>";
	echo "<br/><b>Tổng số học sinh có thẻ học sinh : </b>".($j-1);
	// xóa mảng kết quả
	//$mangkq=[];
	echo "</table>";
	echo "<p class ='td'> Danh sách học sinh năm ".$_POST['namps']." không thẻ </p>";
	echo "<br/><b>Tổng số học sinh không không thẻ : </b>".count($mangkt);
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ</th><th>Địa chỉ</th></tr>";
	for($i=0;$i<count($mangkt);$i++){
		$dl=explode("#",$dltra[$mangkt[$i]]);
		$hoten=$dl[0];
		$ngaysinh=$dl[1];
		//echo "<p>".$dltra[$mangkt[$i]]."</p>";
		echo "<tr><td>".($i+1)."</td><td></td><td></td><td></td><td>".$hoten."</td><td>".$ngaysinh."</td><td></td><td></td></tr>";
	}
	echo "</table>";
	// xóa mảng không thẻ
	//$mangkt=[];
	//print_r($mangkq);
	//print_r($mangkt);
*/
}
// tra theo họ tên có dấu + ngày sinh
function tratheBHYT1($hoten,$ngaysinh,$manghs){
	//$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'",'-','.'],'',trim($hoten));
	$ngaysinh=trim($ngaysinh);
	//$ngaysinh=subStr($ngaysinh,strlen($ngaysinh)-4,4);
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	//$mangkq=[];
	$mkq=[];
	//$j=1;
	while($kq and $i<count($manghs)){
		
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'",'-','.'],'',$manghs[$i]['hoTen']);
		//$pos1=strpos($ht,$hoten);
		//$ns=$manghs[$i]['ngaySinh'];
		//$ns=subStr($ns,strlen($ns)-4,4);
		//$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		if(strcasecmp($hoten,$ht)==0 and $ngaysinh===$manghs[$i]['ngaySinh']){
		array_push($mkq,$i);
		$i++;
		//echo "<p>".$stt." - ".$manghs[$i]['id']." - ".$manghs[$i]['maDonViThu']." - ".$manghs[$i]['soBhxh']." - ".$manghs[$i]['soKcb']." - ".$manghs[$i]['namht']." - ".$manghs[$i]['hoTen']."-".$manghs[$i]['ngaySinh']."</p>";
		//$kq=FALSE;
		}else $i++;
		
		//echo str_replace([' '],'',$manghs[$i]['hoTen']);
	}
	return $mkq;
	//$j++;
	
}
// tra theo họ tên có dấu + năm sinh
function tratheBHYT2($hoten,$ngaysinh,$manghs){
	//$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'",'-','.'],'',trim($hoten));
	$ngaysinh=trim($ngaysinh);
	$ngaysinh=subStr($ngaysinh,strlen($ngaysinh)-4,4);
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	$mkq=[];
	//$j=1;
	while($kq and $i<count($manghs)){
		
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'",'-','.'],'',$manghs[$i]['hoTen']);
		//$pos1=strpos($ht,$hoten);
		$ns=$manghs[$i]['ngaySinh'];
		$ns=subStr($ns,strlen($ns)-4,4);
		//$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		if(strcasecmp($hoten,$ht)==0 and $ngaysinh===$ns){
		array_push($mkq,$i);
		$i++;
		//echo "<p>".$stt." - ".$manghs[$i]['id']." - ".$manghs[$i]['maDonViThu']." - ".$manghs[$i]['soBhxh']." - ".$manghs[$i]['soKcb']." - ".$manghs[$i]['namht']." - ".$manghs[$i]['hoTen']."-".$manghs[$i]['ngaySinh']."</p>";
		//$kq=FALSE;
		}else $i++;
		
		//echo str_replace([' '],'',$manghs[$i]['hoTen']);
	}
	return $mkq;
	//$j++;
	
}
// tra theo họ tên có dấu + năm sinh + địa chỉ
function tratheBHYT3($dltra,$manghs,$dc){
	$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'"],'',trim($dl[0]));
	$ngaysinh=trim($dl[1]);
	$ngaysinh=subStr($ngaysinh,strlen($ngaysinh)-4,4);
	
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	//$j=1;
	while($kq and $i<count($manghs)){
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'"],'',$manghs[$i]['hoTen']);
		//$pos1=strpos($ht,$hoten);
		//$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		$ns=$manghs[$i]['ngaySinh'];
		$ns=subStr($ns,strlen($ns)-4,4);
		$posdc=0;
		$posdc=strpos(strtolower(vn_to_str($manghs[$i]['diaChiLh'])),$dc);
		//echo "vị trí đia chỉ : ".$dc." là ".$posdc;
		if(strcasecmp($hoten,$ht)==0 and $ngaysinh===$ns and $posdc<>0){
		//$mangkq.push($manghs[$i]);
		return $i;
		//echo "<p>".$stt." - ".$manghs[$i]['id']." - ".$manghs[$i]['maDonViThu']." - ".$manghs[$i]['soBhxh']." - ".$manghs[$i]['soKcb']." - ".$manghs[$i]['namht']." - ".$manghs[$i]['hoTen']."-".$manghs[$i]['ngaySinh']."</p>";
		$kq=FALSE;
		}else $i++;
		//echo str_replace([' '],'',$manghs[$i]['hoTen']);
	}
	//$j++;
	if($kq){
		//echo "<br/>Không tìm thấy ! ".$hoten.$ngaysinh;
		//array_push($mangkt,$dltra);
		//return false;
	}
}
function tratheBHYT4($dltra,$manghs){
	$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'",'.','-'],'',trim($dl[0]));
	$hoten=strtolower(vn_to_str($hoten));
	$ngaysinh=trim($dl[1]);
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	//$j=1;
	while($kq and $i<count($manghs)){
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'",'.','-'],'',$manghs[$i]['hoTen']);
		$ht=strtolower(vn_to_str($ht));
		//$pos1=strpos($ht,$hoten);
		//$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		if(strcasecmp($hoten,$ht)==0 and $ngaysinh===$manghs[$i]['ngaySinh']){
		//$mangkq.push($manghs[$i]);
		return $i;
		//echo "<p>".$stt." - ".$manghs[$i]['id']." - ".$manghs[$i]['maDonViThu']." - ".$manghs[$i]['soBhxh']." - ".$manghs[$i]['soKcb']." - ".$manghs[$i]['namht']." - ".$manghs[$i]['hoTen']."-".$manghs[$i]['ngaySinh']."</p>";
		$kq=FALSE;
		}else $i++;
		//echo str_replace([' '],'',$manghs[$i]['hoTen']);
	}
	//$j++;
	if($kq){
		//echo "<br/>Không tìm thấy ! ".$hoten.$ngaysinh;
		//array_push($mangkt,$dltra);
		//return false;
	}
}
function tratheBHYT5($dltra,$manghs){
	$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'",'.','-'],'',trim($dl[0]));
	$hoten=strtolower(vn_to_str($hoten));
	$ngaysinh=trim($dl[1]);
	$ngaysinh=subStr($ngaysinh,strlen($ngaysinh)-4,4);
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	//$j=1;
	while($kq and $i<count($manghs)){
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'",'.','-'],'',$manghs[$i]['hoTen']);
		$ht=strtolower(vn_to_str($ht));
		$ns=$manghs[$i]['ngaySinh'];
		$ns=subStr($ns,strlen($ns)-4,4);
		//$pos1=strpos($ht,$hoten);
		//$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		if(strcasecmp($hoten,$ht)==0 and $ngaysinh===$ns){
		//$mangkq.push($manghs[$i]);
		return $i;
		//echo "<p>".$stt." - ".$manghs[$i]['id']." - ".$manghs[$i]['maDonViThu']." - ".$manghs[$i]['soBhxh']." - ".$manghs[$i]['soKcb']." - ".$manghs[$i]['namht']." - ".$manghs[$i]['hoTen']."-".$manghs[$i]['ngaySinh']."</p>";
		$kq=FALSE;
		}else $i++;
		//echo str_replace([' '],'',$manghs[$i]['hoTen']);
	}
	//$j++;
	if($kq){
		//echo "<br/>Không tìm thấy ! ".$hoten.$ngaysinh;
		//array_push($mangkt,$dltra);
		//return false;
	}
}
//echo $dltra[0].$dltra[1];
//var_dump(mangtra);
//echo $manghs[0]["hoTen"].$manghs[0]["ngaySinh"];
?>