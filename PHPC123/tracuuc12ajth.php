<style>
#ttdt{
		background-color:#045FB4;
		font-family:arial;
		font-size:1.4em;
		color:white;
		height:30px;
		padding:5px;
		font-weight:bold;
	}
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
			
            $con = substr($strNum, $len - $counter , 3);
            $result = ','.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        if(substr($result,0,1)==','){
            $result=substr($result,1,$len+1);   
		if(substr($result,0,1)=='-')
			$result="-".substr($result,2,$len+1); 
        }
		else
        return $result;
}


if(isset($_POST['madvith'])){
	$tungay=$_POST['tungay'];
	$tn="";
	if($tungay){
		//$tungay= date_create($tungay);
		$tungay=substr($tungay,6,4)."-".substr($tungay,0,2)."-".substr($tungay,3,2);
		$tn=" AND ngayps >= '".$tungay."'";
	}
	$denngay=$_POST['denngay'];
	$dn="";
	if($denngay){
		$denngay=substr($denngay,6,4)."-".substr($denngay,0,2)."-".substr($denngay,3,2);
		//$denngay=date_create($denngay);
		$dn=" AND ngayps <= '".$denngay."'";
	}
	//echo "<p>Kết quả tra được :" .$_POST['madvi']."</p>";
	$sql="select * from c12 where madvi like '".$_POST['madvith']."'".$tn.$dn;
	$sqlth="select madvi,Tendvi,Sld,tql,TienUNC,Tien_ck,Tongpstk,sum(TienUNC) as Tongdanop, sum(Tongpstk) as TongPS from c12 where madvi like '".$_POST['madvith']."'".$tn.$dn;
	$kq=$db->query($sql);
	$kqt=$db->query($sqlth);
	if($kq){
	echo "<p class='kqt'>Kết quả tìm được</p><table class='tkq'><tr class='ttr'><th>Mã đơn vị</th><th>Tên đơn vị</><th>Địa chỉ</th><th>Điện thoại</th><th>Người Liên hệ</th><th>Tháng PS</th><th>Số lao động </th><Th> Tổng quỹ lương </th><Th> Tiền đầu kỳ </th><Th> Tiền ps trong kỳ </th><th> Tiền đã nộp </th> <th> Tổng cuối kỳ </th><th> In C12 </th></tr>";
	//var_dump($_POST['cqql']);
	foreach($kq as $k){
		
		echo "<tr class='ttd'><td>".$k[0]."</td><td>".$k[1]."</td><td>".$k[2]."</td><td>".$k[3]."</td><td>".$k[4]."</td><td>".$k[5]."</td><td>".adddotstring($k[6])."</td><td>".adddotstring($k[11])."</td><td>".adddotstring($k[8])."</td><td>".adddotstring($k[10])."</td><td>".adddotstring($k[7])."</td><td>".adddotstring($k[9])."</td><td><a class='inc12' target='_blank' href='inc12pdf1.php?inc12=".$k[13]."'>In C12</a></td></tr>";
	}
	echo "<tr id='ttdt'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Tổng tiền đã nộp : </td><td>".adddotstring($kqt[0]['Tongdanop'])."</td><td>Tổng tiền phát sinh : </td><td>".adddotstring($kqt[0]['TongPS'])."</td><td></td><td></td></tr>";
	echo "</table><p id='cn'>Cập nhật :".$kq[0][12]."</p></div>";
	//var_dump($kqt);
	}else
	echo " <p class='kqt'>Không tìm thấy đơn vị này ! </p></div>";
	//echo $sql;
}

?>
