<?php
require('dompdf/autoload.inc.php');
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
//require_once('dompdf_0-8-3/dompdf/autoload.inc.php');
//require_once('dompdf/src/Dompdf.php');
//Khai báo sử dụng thư viện
use Dompdf\Dompdf;
use Dompdf\Options;
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
if(isset($_GET['inc12'])){
	//echo $_GET['inc12'];
	//echo $_GET['inc12'];
	$db=new Database();
	$db->connect();
	$sql="select * from c12 where id='".$_GET['inc12']."'";
	$kq=$db->query($sql);
	if(isset($kq)){
		foreach($kq as $k){
	//Khởi tạo đối tượng dompdf
	//$dompdf = new Dompdf();
	//$dompdf = new Dompdf($options);
	//Nạp nội dung HTML cần tạo PDF
	//$dompdf->set_option('isHtml5ParserEnabled', true);
	//$dompdf->loadHtml('Hello PDF Dompdf');

	//Khai báo khổ giấy và chiều giấy
	//$dompdf->setPaper('A4', 'landscape');

	//Xuất nội dung với định dạng PDF ra trình duyệt
	//$dompdf->render();
	//$f='demo.pdf';
	//Hoặc xuất thành tập tin PDF để tải về
	//$dompdf->stream();
	//Browsershot::html('<h1>Hello world!!</h1>')->save('example.pdf');
	//Browsershot::url('https://gialai.baohiemxahoi.gov.vn/')->save('example.pdf');
	//$pdf_options = new Options();
	//$options = new Options();
	//$pdf_options->set('defaultFont', 'Times');
	//$pdf_options->set('Author', 'Thorsten Sauer');
	/**$pdf_options->setIsRemoteEnabled(true);
	$pdf_options->set('isRemoteEnabled',true);
	$pdf_options->setIsHtml5ParserEnabled(true);
	$pdf_options->set('isRemoteEnabled', TRUE);
	$pdf_options->set('tempDir', 'tmp_path/pdf'); // keine Auswirkung?!
	
 
	// instantiate and use the dompdf class
	$dompdf = new Dompdf($pdf_options);
	//$dompdf->def("DOMPDF_ENABLE_REMOTE", false);
	$dompdf->set_option('isHtml5ParserEnabled', true);
	$dompdf->setProtocol('https://');
	$dompdf->setBaseHost('http://localhost/phpc12/');
	$dompdf->setBasePath('/PS/html');
  
	$context = stream_context_create([
  	'ssl' => [
    	'verify_peer' => FALSE,
    	'verify_peer_name' => FALSE,
    	'allow_self_signed'=> TRUE
  	]
	]);
	*/
	$ct=subStr($k[5],0,4)."-".subStr($k[5],5,2)."-01";
	$ct=date("t/m/Y",strtotime($ct));
	$html = '<!DOCTYPE html>
	<html lang="en" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Thông báo C12</title>
		<style> 
			body{
				
				background-color:powderblue
			}
			.c12{
			background-color:white;
			width :1000px;			
			padding:10px;
			margin:auto;
			}
			.c12 img{
				width:100%;
			}
			.bhxh{
				color:blue;
				text-align:left;
				font-family:"times";
				font-size:14;
				
			}
			.tieude{
				color:blue;
				text-align:center;
				font-family:"times";
				font-size:x-large;
				font-weight:bold;
				
			}
			p.tb{
				color:red;
				font-size:xx-large;
				margin:0px;
			}
			p.sotb{
				color:black;
				font-size:1em;
				margin:0px;
				font-weight:normal;
			}
			.noidung{
				text-align:left;
				font-family:"times";
				font-size:1.3em;
				
			}
			.ttdv{
				font-size:0.8em;
				font-family:"times";
				width:800px;
				border:1px solid;
				margin:auto;
				padding:5px;
				font-weight:bold;
			}
			.noidung1{
				text-align:left;
				font-family:"Georgia";
				font-size:12;
				src: url("https://proposalways.com/font/Georgia/Georgia.ttf") format("truetype");
			}
			
			@font-face {
			  font-family: "Georgia";
			  font-style: normal;
			  font-weight: normal;
			  src: url("https://proposalways.com/font/Georgia/Georgia.ttf") format("truetype");
			}
		</style>
	</head>
	<body>
	<div class="c12">
	<div class="bhxh">
	<img src="img/bhxh.png" />
	</div>
	<div class="tieude">
	<p class="sotb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Số : '.$k[5].'/BHXH/QLT  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<i>Gia Lai, ngày cập nhật : '.date("d/m/Y",strtotime($k[12])).'.  </i></p>
	<p class="tb"> THÔNG BÁO </p>
	<p> Kết quả đóng bảo hiểm xã hội, bảo hiểm y tế, bảo hiểm thất nghiệp,
		bảo hiểm tai nạn lao động, bệnh nghề nghiệp </p>
	</div>
	<div class="noidung"><div class="ttdv"><i> <p> Kính gửi: (Ông/Bà) '.$k[4].'</p>
	<p> Tên đơn vị: '.$k[1].'</p>
	<p> Địa chỉ: '.$k[2].'</p>
	<p> Điện thoại: '.$k[3].' - Mã đơn vị: '.$k[0].'</p>
	</i>
	</div>
	<p>&nbsp;&nbsp;&nbsp;&nbsp; Bảo hiểm Xã hội tỉnh Gia Lai thông báo:</p>
	<p style="font-weight:bold"> 1. Kết quả đóng bảo hiểm xã hội, bảo hiểm y tế, bảo hiểm thất nghiệp, bảo
	hiểm tai nạn lao động, bệnh nghề nghiệp tháng: '.subStr($ct,4,7).' của đơn vị như sau:</p>
	<p> 1.1. Số lao động tham gia: '.$k[6].' người.</p>
	<p> 1.2. Tổng quỹ lương: '.adddotstring($k[11]).' đồng </p>
	<p> 1.3. Số tiền đã đóng: '.adddotstring($k[7]).' đồng </p>
	<p> 1.4. Số tiền kỳ trước chuyển sang : '.adddotstring($k[8]).' đồng </p>
	<p> 1.5. Số tiền phát sinh trong tháng '.subStr($ct,4,7)." : ".adddotstring($k[10]).' đồng </p>
	<p><b> 2. Số tiền dự tính phải đóng tháng 03/2020: '.adddotstring($k[9]).' đồng </b><i>( = Số tiền kỳ trước chuyển sang + Số tiền phát sinh trong tháng - Số tiền đã đóng)</i></p>
	<p> &nbsp;&nbsp;&nbsp;&nbsp; Bảo hiểm Xã hội tỉnh Gia Lai cảm ơn sự hợp tác của ông (bà) trong việc thực
	hiện trích nộp tiền đóng BHXH, BHYT, BHTN, BHTNLĐ, BNN theo quy định. Đề
	nghị ông (bà) nộp đầy đủ số tiền còn phải đóng vào tài khoản chuyên thu của cơ
	quan BHXH trước ngày <b>'.$ct.'</b>.</p>
	</div>
	<div class="cky">
		<img src="img/cky.png" />
	</div>
	</div>
	</body>
	</html>';
	//$dompdf->setHttpContext($context);
	//$dompdf->loadHtml($html);
	//$dompdf->loadHtml("<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/></head><h1>Thông báo C12 </h1><p style='color:blue;text-align:center;font-family:Arial, Helvetica, sans-serif;font-size:16'>Kính gửi : ".$k[1]."</p></html>");
 
	// (Optional) Setup the paper size and orientation
	//$dompdf->setPaper('A4', 'portrait');
 
	// Render the HTML as PDF
	//ob_end_clean();
	//$dompdf->render();
	//$dompdf->output();
 
	//$t = $_GET['inc12']."_".date("Ymd_His");
 
	// Output the generated PDF to Browser
	
	//$dompdf->stream($t);
	echo $html;
	}
	}
}
?>
