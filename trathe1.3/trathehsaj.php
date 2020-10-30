<style>
#taD03{
	display:none;
}
.bd03{
	background-color: #F35B46;
	color : white;
	font-size: 22px;
	padding :5px;
	margin-left: 10px;
}
.xuatdl{
	font-size: 18px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript">
function xuatD03(){
				var ds= $("#taD03").val();
				//alert(ds);
				$.ajax({
                    url : "xuatD03aj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
						 taD03 : $("#taD03").val(),						 
                    },
                    success : function (result){
						alert("Đã xuất file thành công ! tại đường dẫn " + result );
						//$('#kqd03').html(result);
                        //$('#result').html(result);
						window.open("file:///"+result,'_blank');
                    }
                });
}
function xuatD02(){
				var ds= $("#taD03").val();
				//alert(ds);
				$.ajax({
                    url : "xuatD02aj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
						 taD03 : $("#taD03").val(),						 
                    },
                    success : function (result){
						alert("Đã xuất file thành công ! tại đường dẫn " + result );
						//$('#kqd03').html(result);
                        //$('#result').html(result);
						//window.open(result,'_blank');
                    }
                });
}
</script>
<?php

header('Content-Type: text/html; charset=utf-8');
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename="dataD03'.time().'.xlsx');
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

session_start();
error_reporting(0);
require_once 'database.php';
$db= new Database();
$db->connect();

$stt=1;
if($_POST['loaitc']){
	echo "<br/><br/><br/><p>Loại tra cứu : ".$_POST['loaitc'].$_POST['diachi']."</p>";
	$sql="select * from thebhyt064";
	$manghs=$db->query1($sql,MYSQLI_ASSOC);
	$dltra=explode("\n",$_POST['dltra']);
	$mangkq=[];
	$mangkt=[];
	$bd=time();
	$dc=$_POST['diachi'];
	$dc=strtolower(vn_to_str($dc));
	for($i=0;$i<(count($dltra)-1);$i++){
		if($dltra!=""){
			switch($_POST['loaitc']){
				case 1 : $kq=tratheBHYT1($dltra[$i],$manghs,$stt);
				break;
				case 2 : $kq=tratheBHYT2($dltra[$i],$manghs);
				break;
				case 3 : $kq=tratheBHYT3($dltra[$i],$manghs,$dc);
				break;
				case 4 : $kq=tratheBHYT4($dltra[$i],$manghs);
				break;
				default:$kq=tratheBHYT1($dltra[$i],$manghs,$stt);
				break;
			}
			if($kq!=null){
				array_push($mangkq,$kq);
				//echo "<br/>Tìm thấy : ".$dltra[$i];
			}else { 
				array_push($mangkt,$i);
				//echo "<br/>Không Tìm thấy : ".$dltra[$i];
			}
			//if(!empty(tratheBHYT1($dltra[$i],$manghs))){
			//tratheBHYT1($dltra[$i],$manghs,$stt);
			//$stt++;
			//array_push($mangkq,tratheBHYT1($dltra[$i],$manghs));
			//$mangkq.push(tratheBHYT1($dltra[$i],$manghs));
			//}else echo "<br/>Không tìm thấy : ".$i.$dltra[$i];
		}
		//echo "Tra thẻ :".$dltra[$i]."\n";
	}
	//echo $sql;
	echo "<p>Tổng danh sách cấp thẻ ".$_POST['namps']." là ".count($manghs)."</p>";
	echo "<br/>Tổng thời gian tra ".(count($dltra)-1)." thẻ là ".(time()-$bd)." giây";
	// in kết quả tra được
	echo "<br/><b>Tổng số người cần tra : ".(count($dltra)-1)."</b>";
	echo "<br/><b>Tổng số đối tượng có thẻ tra được : ".count($mangkq)."</b>";
	echo "<br/><b>Tổng số đối tượng không tìm thấy : ".count($mangkt)."</b>";
	$sd03="";
	$sd02="";
	//echo '<button id="d03" onClick="xuatD03()"> Xuất dữ liệu import TST D03 </button><button id="d02" > Xuất dữ liệu import TST D02 </button>';
	// <form action="xuatD03aj.php" method="post" target="_blank">
	echo '<br/><form action="xuatD03aj.php" method="post" target="_blank"><button type="submit" class="bd03" name="bd03"> Xuất dữ liệu import TST  </button> </button><p class="xuatdl"> <input type="radio" name="xuatdulieu" checked="checked" value="1"> Xuất chỉ tham gia BHYT <br/><input type="radio" name="xuatdulieu" value="2">Xuất tham gia BHXH';
	echo "<p class ='td'> Danh sách thẻ BHYT tra được </p>";
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Giới tính</th><th>Mã KCB</th><th>Mức lương</th><th>Hạn thẻ từ ngày</th><th>Hạn thẻ đến ngày</th><th>Ngày cấp</th><th>Địa chỉ</th></tr>";
	$j=1;
	for($i=0;$i<count($mangkq);$i++){
		$id=$mangkq[$i];
		//$madt=subStr($manghs[$id]['soKcb'],0,2);
		//$madt=$manghs[$id]['maDoiTuong'];
		
		echo "<tr><td>".$j."</td><td>".$manghs[$id]['maDonViThu']."</td><td>".($manghs[$id]['soBhxh'])."</td><td>".($manghs[$id]['soKcb'])."</td><td>".($manghs[$id]['hoTen'])."</td><td>".($manghs[$id]['ngaySinh'])."</td><td>".($manghs[$id]['gioiTinh'])."</td><td>".($manghs[$id]['maKcb'])."</td><td>".($manghs[$id]['mucLuong'])."</td><td>".($manghs[$id]['tuNgay'])."</td><td>".($manghs[$id]['denNgay'])."</td><td>".($manghs[$id]['ngayCap'])."</td><td>".($manghs[$id]['diaChiLh'])."</td></tr>";
		$diachi=explode(",",$manghs[$id]['diaChiLh']);
		$diachi=$diachi[0];
		$sd03=$sd03.($i+1)."#".$manghs[$id]['soBhxh']."#".$manghs[$id]['hoTen']."#".$manghs[$id]['ngaySinh']."#".$diachi."#".$manghs[$id]['gioiTinh']."#".$manghs[$id]['mucLuong']."#".$manghs[$id]['tinhKcb']."#".$manghs[$id]['maKcb']."#".$manghs[$id]['maTinhLh']."#".$manghs[$id]['maHuyenLh']."#".$manghs[$id]['maXaLh']."\n";
		//echo "<p>".($i+1)." - ".$manghs[$mangkq[$i]]['id']." - ".$manghs[$mangkq[$i]]['maDonViThu']." - ".$manghs[$mangkq[$i]]['soBhxh']." - ".$manghs[$mangkq[$i]]['soKcb']." - ".$manghs[$mangkq[$i]]['namht']." - ".$manghs[$mangkq[$i]]['hoTen']."-".$manghs[$mangkq[$i]]['ngaySinh']."</p>";
		$j++;
	}	
	echo "</table>";
	
	// xóa mảng kết quả
	//$mangkq=[];
	echo "</table>";
	echo "<p class ='td'> Danh sách đối tượng không tìm thấy </p>";
	//echo "<br/><b>Tổng số học sinh không không thẻ : </b>".count($mangkt);
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ</th><th>Địa chỉ</th></tr>";
	for($i=0;$i<count($mangkt);$i++){
		$dl=explode("#",$dltra[$mangkt[$i]]);
		$hoten=$dl[0];
		$ngaysinh=$dl[1];
		//echo "<p>".$dltra[$mangkt[$i]]."</p>";
		echo "<tr><td>".($i+1)."</td><td></td><td></td><td></td><td>".$hoten."</td><td>".$ngaysinh."</td><td></td><td></td></tr>";
	}
	echo "</table>";
	$user=$_SESSION['user'];
	$db->query("INSERT INTO `lichsu` (`id`, `time`, `action`, `tongso`, `timthay`, `khongthay`, `user`) VALUES (NULL, current_timestamp(), 'trathebhyt', '".(count($dltra)-1)."', '".(count($mangkq))."', '".(count($mangkt))."', '".$user."')");
	$db->query("update login set luottrathe=luottrathe+1 where user='".$user."'");
	// xóa mảng không thẻ
	//$mangkt=[];
	//print_r($mangkq);
	//print_r($mangkt);

// in cả mảng tìm thấy thẻ và không thấy
/**	
	echo "<p class ='td'> Danh sách tổng hợp đối tượng tra thẻ </p>";
	echo "<table class='tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số BHXH</th><th>Mã thẻ</th><th>Họ tên</th><th>Ngày Sinh</th><th>Hạn thẻ từ ngày</th><th>Hạn thẻ đến ngày</th><th>Ngày cấp</th><th>Địa chỉ</th></tr>";
	$j=0;
	$k=0;
	for($i=0;$i<count($dltra)-1;$i++){
		if($i==$mangkt[$j]){
			$dl=explode("#",$dltra[$mangkt[$j]]);
			$j++;
			$hoten=$dl[0];
			$ngaysinh=$dl[1];
			//$sd03=$sd03.($i+1)."#".$hoten."#".$ngaysinh."\n";
			//echo "<p>".$dltra[$mangkt[$i]]."</p>";
			echo "<tr style='color:red'><td>".($i+1)."</td><td></td><td></td><td>Không tìm thấy</td><td>".$hoten."</td><td>".$ngaysinh."</td><td></td><td></td><td></td><td></td></tr>";
		}else{
			$id=$mangkq[$k];
			$k++;
			echo "<tr><td>".($i+1)."</td><td>".$manghs[$id]['maDonViThu']."</td><td>".($manghs[$id]['soBhxh'])."</td><td>".($manghs[$id]['soKcb'])."</td><td>".($manghs[$id]['hoTen'])."</td><td>".($manghs[$id]['ngaySinh'])."</td><td>".($manghs[$id]['tuNgay'])."</td><td>".($manghs[$id]['denNgay'])."</td><td>".($manghs[$id]['ngayCap'])."</td><td>".($manghs[$id]['diaChiLh'])."</td></tr>";
			$sd03=$sd03.($i+1)."#".$manghs[$id]['soBhxh']."#".$manghs[$id]['hoTen']."#".$manghs[$id]['ngaySinh']."#".$manghs[$id]['diaChiLh']."\n";
		}
	}
	echo "</table>";
*/
	echo "<textarea name='taD03' id='taD03' rows='20' cols='60'>".$sd03."</textarea></form>";
}

// tra theo họ tên có dấu + ngày sinh
function tratheBHYT1($dltra,$manghs,$stt){
	$dl=explode("#",$dltra);
	$hoten=str_replace([' ',"'"],'',trim($dl[0]));
	$ngaysinh=trim($dl[1]);
	//echo $hoten.$ngaysinh;
	$kq=TRUE;
	$i=0;
	//$j=1;
	while($kq and $i<count($manghs)){
		//$pos1=0;$pos2=0;
		$ht=str_replace([' ',"'"],'',$manghs[$i]['hoTen']);
		//$pos1=strpos($ht,$hoten);
		$pos2=strpos($manghs[$i]['ngaySinh'],$ngaysinh);
		if($hoten==$ht and $ngaysinh==$manghs[$i]['ngaySinh']){
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
// tra theo họ tên có dấu + năm sinh
function tratheBHYT2($dltra,$manghs){
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
		if($hoten==$ht and $ngaysinh==$ns){
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
		if($hoten==$ht and $ngaysinh==$ns and $posdc<>0){
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
		if($hoten==$ht and $ngaysinh==$manghs[$i]['ngaySinh']){
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
<div id="kqd03"></div>