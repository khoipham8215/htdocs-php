<style>

</style>
<?php
require_once('database.php');
//require('dompdf/autoload.inc.php');
//use Dompdf\Dompdf;
//use Dompdf\Options;
//$options = new Options();
//$options->set('defaultFont', 'Courier');
//composer require dompdf/dompdf;
//require_once('browsershot/src/Browsershot.php');
//use Spatie\Browsershot\Browsershot;
// Thêm dấu , vào số
//require 'pdfcrowd.php';
$db=new Database();
$db->connect();
function adddotstring($strNum) {
        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter > 0)
        {
			//if(substr($result,0,1)=='-'){ $len=$len-1;}
            $con = substr($strNum, $len - $counter , 3);
            $result = ','.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        //if(substr($result,0,1)=='-'){
        //    $result='-'.substr($result,1,$len+1).":".$len;   
		//	return $result;
        //}
		//else
		if(substr($result,0,1)=='-' && $len==10){
			$result='-'.substr($result,2,$len+1); 
		}
		if(substr($result,0,1)=='-' and $len==7){
			$result='-'.substr($result,2,$len+1); 
		}
		if(substr($result,0,1)=='-' and $len==4){
			$result='-'.substr($result,2,$len+1); 
		}
        return $result;
		
}

//Nhúng file PHPExcel
//require_once 'PHPExcel.php';

if(isset($_POST['madvi'])){
	session_start();
	$db->query("update login set luottrac12=luottrac12+1 where user='".$_SESSION['user']."'");
	$cqql=substr($_POST['cqql'],0,5);
	$c="";
	if($cqql!=0){
		$c=" AND macqql like '".$cqql."'";
	}
	$thangps=$_POST['thangps'];
	$t="";
	if(isset($thangps)){
		$t1=substr($thangps,0,2);
		
		$t=substr($thangps,3,4).$t1;
		$t=" AND thangps like '".$t."'";
	}
	//echo "<p>Kết quả tra được :" .$_POST['madvi']."</p>";
	$sql="select * from c12 where madvi like '%".$_POST['madvi']."%'".$c.$t;
	$kq=$db->query($sql);
	if($kq){
	echo "<p class='kqt'>Kết quả tìm được</p><table class='table table tkq'><tr class='ttr'><th>Mã đơn vị</th><th>Tên đơn vị</><th>Tháng PS</th><th>Số lao động </th><Th> Tổng quỹ lương </th><Th> Tiền đầu kỳ </th><Th> Tiền ps trong kỳ </th><th> Tiền đã nộp </th> <th> Tổng cuối kỳ </th><th> In C12 </th><th> In C11 </th></tr>";
	//var_dump($_POST['cqql']);
	foreach($kq as $k){
		
		echo "<tr class='ttd'><td>".$k[0]."</td><td>".$k[1]."</td><td>".$k[5]."</td><td>".adddotstring($k[6])."</td><td>".adddotstring($k[11])."</td><td>".adddotstring($k[8])."</td><td>".adddotstring($k[10])."</td><td>".adddotstring($k[7])."</td><td>".adddotstring($k[9])."</td><td><a class='btn btn-success inc12' target='_blank' href='inc12pdf1.php?inc12=".$k[13]."'>In C12</a></td><td><a class='btn btn-success inc12' target='_blank' href='inc11pdf.php?inc11=".$k[13]."'>Chi tiết C11</a></td></tr>";
	}
	echo "</table><p id='cn'>Cập nhật :".date("d/m/Y h:m",strtotime($kq[0][12]))."</p></div>";
	//var_dump($kq);
	}else
	echo " <p class='kqt'>Không tìm thấy dữ liệu ! </p></div>";
	//echo $sql;
}else echo "khong tim thay".$_SESSION['user'];

?>
