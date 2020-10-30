<?php
require_once 'database.php';
$db= new Database();
$db->connect();
?>
<style> 
	.tkq{
		margin:0;
		border-style:solid;
		border-color:#045FB4;
		border-width:1px;
		font-family:arial;
		font-size:0.8em;
		
	}
	.ttr th{
		background-color:#045FB4;
		font-family:arial;
		font-size:1.4em;
		color:white;
		height:30px;
		padding:5px;
	}
	.ttd td{
		margin:0;
		border-width:1px;
		border-style:solid;
		border-color:#848484;
		font-family:helvetica;
		font-size:1.2em;
		color:black;
		padding:2px;
	}
	.ttd{
		margin:0;
	}
	.dkq{
		margin:auto;
		padding:5px;
		width:80%;
		background-color:#E6E6E6;
	}
	.ftk{
		background-color:#045FB4;
		padding:5px;
	}
	.ftk input{
		width:150px;
		height:30px;
	}
	.ftk select{
		width:250px;
		height:30px;
	}
	.ftk label{
		color:white;
		font-family:arial;
		font-size:1.2em;
	}
	p.kqt {
		font-size:1.2em;
		font-weight:bold;
		color:#045FB4;
	}
}
</style>
<div class='dkq'>
<div class='ftk'>
<form method="post">
<b><label>Nhập vào mã đơn vị</label></b>
<input type=input name='madvi'  /> 
<label>Chọn cơ quan BHXH quản lý</label> <select class="maql" name="cqql">
<option id=0> Tất cả </option>
<?php
	$sql1="select * from cqbhxh";
	$dm=$db->query($sql1);
	if(isset($dm)){
		foreach($dm as $d){
		echo "<option >".$d['macqql']."-".$d['tencqql']."</option>";
		}		
	}
?>
</select>
<input type=submit value="Tra cứu C12"  name="tracuu"/>

</form>
</div>
<?php

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

//Nhúng file PHPExcel
//require_once 'PHPExcel.php';

if(isset($_POST['tracuu'])){
	$cqql=substr($_POST['cqql'],0,5);
	$c="";
	if($cqql!=0){
		$c=" AND macqql like '".$cqql."'";
	}
	//echo "<p>Kết quả tra được :" .$_POST['madvi']."</p>";
	$sql="select * from c12 where madvi like '%".$_POST['madvi']."%'".$c;
	$kq=$db->query($sql);
if($kq){
	echo "<p class='kqt'>Kết quả tìm được</p><table class='tkq'><tr class='ttr'><th>Mã đơn vị</th><th>Tên đơn vị</><th>Địa chỉ</th><th>Điện thoại</th><th>Người Liên hệ</th><th>Tháng PS</th><th>Số lao động </th><Th> Tổng quỹ lương </th><Th> Tiền đầu kỳ </th><Th> Tiền ps trong kỳ </th><th> Tiền đã nộp </th> <th> Tổng cuối kỳ </th><th> In C12 </th></tr>";
	//var_dump($_POST['cqql']);
	foreach($kq as $k){
		
		echo "<tr class='ttd'><td>".$k[0]."</td><td>".$k[1]."</td><td>".$k[2]."</td><td>".$k[3]."</td><td>".$k[4]."</td><td>".$k[5]."</td><td>".adddotstring($k[6])."</td><td>".adddotstring($k[11])."</td><td>".adddotstring($k[8])."</td><td>".adddotstring($k[10])."</td><td>".adddotstring($k[7])."</td><td>".adddotstring($k[9])."</td><td><form method='get' action='inc12pdf1.php' target='_blank' ><input type='submit' name='inc12' value=".$k[0]."></form></td></tr>";
	}
	echo "</table><p id='cn'>Cập nhật :".$kq[0][12]."</p></div>";
	//var_dump($kq);
	}else
	echo " <p class='kqt'>Không tìm thấy đơn vị này ! </p></div>";
	//echo $sql;
}

?>
