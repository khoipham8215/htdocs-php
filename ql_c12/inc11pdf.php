<?php
//require('dompdf/autoload.inc.php');
require_once 'controllers/database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
//require_once('dompdf_0-8-3/dompdf/autoload.inc.php');
//require_once('dompdf/src/Dompdf.php');
//Khai báo sử dụng thư viện
//use Dompdf\Dompdf;
//use Dompdf\Options;
function adddotstring($strNum) {
 if($strNum==0){
	 return "";
 }else{
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
}
if(isset($_GET['inc11'])){
	//echo $_GET['inc12'];
	//echo $_GET['inc12'];
	$db=new Database();
	$db->connect();
	session_start();
	$db->query("update login set luot_inc11=luot_inc11+1 where user='".$_SESSION['user']."'");
	$sql="select * from c12 where id='".$_GET['inc11']."'";
	$kq=$db->query1($sql,MYSQLI_ASSOC);
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
	$tbhxh=mktime(0,0,0,subStr($k['ThangPS'],5,2)-round($k['tyleno'],0),1,subStr($k['ThangPS'],0,4));
	$tbhtn=mktime(0,0,0,subStr($k['ThangPS'],5,2)-round($k['tylenotn'],0),1,subStr($k['ThangPS'],0,4));
	$tbhyt=mktime(0,0,0,subStr($k['ThangPS'],5,2)-round($k['tylenoyt'],0),1,subStr($k['ThangPS'],0,4));
	$tbhtnld=mktime(0,0,0,subStr($k['ThangPS'],5,2)-round($k['tylenotnld'],0),1,subStr($k['ThangPS'],0,4));
	$ct=subStr($k['ThangPS'],0,4)."-".subStr($k['ThangPS'],5,2)."-01";
	$ct=date("t/m/Y",strtotime($ct));
	$tps=subStr($k['ThangPS'],5,2);
	$nps=subStr($k['ThangPS'],0,4);
	$html = '<!DOCTYPE html>
	<html lang="en" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>Thông báo C11 BHXH</title>
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
				
				text-align:center;
				font-family:"times";
				font-size:x-large;
				font-weight:bold;
				
			}
			p.tb{
				
				font-size:x-large;
				margin-bottom:0;
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
				font-size:1em;
				margin-left:2%;
			    margin-right:2%;
			}
			.ttdv{
				font-size:1em;
				font-family:"times";
				width:auto;
				margin-left:2%;
			    margin-right:2%;
				padding:5px;
				font-weight:bold;
				
			}
			.noidung1{
				text-align:left;
				font-family:"Georgia";
				font-size:12;
				src: url("https://proposalways.com/font/Georgia/Georgia.ttf") format("truetype");
			}
			
			.tdtb{
			  margin-left:10%;
			  margin-right:10%;
			  font-size:20px;
			  
			}
			.cky{
			  margin-left:5%;
			  margin-right:5%;		
			}
			.c11tb {
			text-align:center;
			width:100%;
			}
			.c11tb tr,th,td{
				border:1px solid;
				padding:2px;
				
			}
			.c11tb{
				border-collapse: separate;
				border-spacing:0;
				border:2px solid;
				
			}
			.c11tb td{
				text-align:right;
			}
			td.td2{
				text-align:left;
			}
			.ngay{
				text-align:right;
				
				margin-right:150px;
				font-size:20px;
			}
			.cb{
				font-size:20px;
				color:red;
			}
			 body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        	}
		</style>
	<script type=”text/JavaScript”>
        
         window.onload = function() {
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);
        document.addEventListener("keydown", function(e) {
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                disabledEvent(e);
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                disabledEvent(e);
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                disabledEvent(e);
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                disabledEvent(e);
            }
            // "F12" key
            if (event.keyCode == 123) {
                disabledEvent(e);
            }
        }, false);

        function disabledEvent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
            e.preventDefault();
            return false;
        }
    	};
    	function killCopy(e){ 
            return false } 
        function reEnable(){ 
            return true } 
        document.onselectstart = new Function (“return false”) 
        
        if (window.sidebar){  
            document.onmousedown=killCopy 
            document.onclick=reEnable 
        }
    </script>
	</head>
	<body>
	<div class="c12">
	<div class="bhxh">
	<img src="img/c11-bhxh.png" />
	</div>
	<div class="tieude">
		
	<p class="tb"> THÔNG BÁO KẾT QUẢ ĐÓNG BHXH, BHYT, BHTN, BHTNLĐ, BNN </p>
	<p class="tdtb">Tháng '.$tps.' năm '.$nps.'</p>
	</div>
	<div class="ttdv"><b> <p> Kính gửi: '.$k['Tendvi'].' </p>
	<p> Địa chỉ: '.$k['Diachi'].'</p>
	<p> Điện thoại: '.$k['Dienthoai'].' - Mã đơn vị: '.$k['Madvi'].'</p>
	<p> Bảo hiểm Xã hội tỉnh Gia Lai </p>
	<p> Địa chỉ: 189B Phạm Văn Đồng, phường Tây Sơn, TP Pleiku, Gia Lai </p>
	<p> Điện thoại: 0269.3827652 </p>
	<p> Thông báo kết quả đóng BHXH, BHYT, BHTN, BHTNLD - BNN của đơn vị như sau: </p>
	</b>
	</div><div class="noidung">
	<table class="c11tb">
		<tr><th rowspan=2>STT </th><th rowspan=2>NỘI DUNG </th><th colspan =2>BHXH </th><th rowspan=2>BHYT </th><th rowspan=2>BHTN </th><th rowspan=2>BHTNLĐ </th><th rowspan=2>CỘNG </th></tr>
		<tr><td><b>ÔĐ, TS</b> </td><td><b>HTTT </b></td></tr>
		<tr><td><b>A </b></td><td class="td2"><b>Kỳ trước mang sang</b> </td><td><b>'.adddotstring($k['_dk_odts']+$k['_dk_lai6']).' </b></td><td><b>'.adddotstring($k['_dk_httt']+$k['_dk_lai7']).'</b> </td><td><b>'.adddotstring($k['_dk_bhyt']+$k['_dk_lai2']).'</b> </td><td><b>'.adddotstring($k['_dk_bhtn']+$k['_dk_lai3']).'</b> </td><td><b>'.adddotstring($k['_dk_tnld']+$k['_dk_lai5']).' </b></td><td><b>'.adddotstring($k['Tien_dk']).' </b></td></tr>
		<tr><td>1 </td><td class="td2">Số lao động </td><td>'.adddotstring($k['sldOdts_dk']).' </td><td>'.$k['sldHttt_dk'].' </td><td>'.$k['sldBhytDk'].' </td><td>'.$k['sldtn_dk'].' </td><td> '.$k['sldtnld_dk'].' </td><td> </td></tr>
		<tr><td>2 </td><td class="td2">Phải đóng </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>2.1 </td><td class="td2">Thừa </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>2.2 </td><td class="td2">Thiếu </td><td>'.adddotstring($k['_dk_odts']).' </td><td>'.adddotstring($k['_dk_httt']).' </td><td>'.adddotstring($k['_dk_bhyt']).' </td><td>'.adddotstring($k['_dk_bhtn']).' </td><td>'.adddotstring($k['_dk_tnld']).' </td><td>'.adddotstring($k['_dk_bhxh']+$k['_dk_bhyt']+$k['_dk_bhtn']+$k['_dk_tnld']).' </td></tr>
		<tr><td>3 </td><td class="td2">Thiếu lãi </td><td>'.adddotstring($k['_dk_lai6']).' </td><td>'.adddotstring($k['_dk_lai7']).' </td><td>'.adddotstring($k['_dk_lai2']).' </td><td>'.adddotstring($k['_dk_lai3']).' </td><td>'.adddotstring($k['_dk_lai5']).' </td><td>'.adddotstring($k['_dk_lai6']+$k['_dk_lai7']+$k['_dk_lai2']+$k['_dk_lai3']+$k['_dk_lai5']).' </td></tr>
		<tr><td><b>B </b> </td><td class="td2"><b>Phát sinh trong kỳ</b> </td><td><b>'.adddotstring($k['psOdtsTk']).' </b></td><td><b>'.adddotstring($k['pshttttk']).'</b> </td><td><b>'.adddotstring($k['psBhytTk']).' </b></td><td><b>'.adddotstring($k['psBhtnTk']).' </b></td><td><b>'.adddotstring($k['psBhtnldTk']).'</b> </td><td><b>'.adddotstring($k['psOdtsTk']+$k['pshttttk']+$k['psBhytTk']+$k['psBhtnTk']+$k['psBhtnldTk']).' </b></td></tr>
		<tr><td>1 </td><td class="td2">Số lao động </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>1.1 </td><td class="td2">Tăng </td><td>'.adddotstring($k['_sldHttttang']).' </td><td>'.adddotstring($k['_sldOdtstang']).' </td><td>'.adddotstring($k['sldBhytTang']).' </td><td>'.adddotstring($k['_sldtntang']).' </td><td>'.adddotstring($k['_sldtnldtang']).' </td><td> </td></tr>
		<tr><td>1.2 </td><td class="td2">Giảm </td><td>'.adddotstring($k['_sldHtttgiam']).' </td><td>'.adddotstring($k['_sldOdtsgiam']).' </td><td>'.adddotstring($k['sldBhytGiam']).' </td><td>'.adddotstring($k['_sldtngiam']).' </td><td>'.adddotstring($k['_sldtnldgiam']).' </td><td> </td></tr>
		<tr><td>2 </td><td class="td2">Quỹ lương </td><td>'.adddotstring($k['tql']).' </td><td>'.adddotstring($k['tql']).' </td><td>'.adddotstring($k['_tqlyt']).' </td><td>'.adddotstring($k['_tqltn']).' </td><td>'.adddotstring($k['tql']).' </td><td> </td></tr>
		<tr><td>2.1 </td><td class="td2">Tăng  </td><td>'.adddotstring($k['tqlBhxhTang']).' </td><td>'.adddotstring($k['tqlBhxhTang']).' </td><td>'.adddotstring($k['tqlBhytTang']).' </td><td>'.adddotstring($k['tqlBhtnTang']).' </td><td>'.adddotstring($k['tqlBhtnldTang']).' </td><td> </td></tr>
		<tr><td>2.2 </td><td class="td2">Giảm </td><td>'.adddotstring($k['tqlBhxhGiam']).' </td><td>'.adddotstring($k['tqlBhxhGiam']).' </td><td>'.adddotstring($k['tqlBhytGiam']).' </td><td>'.adddotstring($k['tqlBhtnGiam']).' </td><td>'.adddotstring($k['tqlBhtnldGiam']).' </td><td> </td></tr>
		<tr><td>3 </td><td class="td2">Phải đóng </td><td>'.adddotstring($k['_ps_odts']).' </td><td>'.adddotstring($k['_ps_httt']).' </td><td>'.adddotstring($k['_ps_yt']).' </td><td>'.adddotstring($k['_ps_tn']).' </td><td>'.adddotstring($k['_ps_tnld']).' </td><td>'.adddotstring($k['tongBhCk']).' </td></tr>
		<tr><td>3.1 </td><td class="td2">Tăng </td><td>'.adddotstring($k['_pst_odts']).' </td><td>'.adddotstring($k['_pst_httt']).' </td><td>'.adddotstring($k['_pst_yt']).' </td><td>'.adddotstring($k['_pst_tn']).' </td><td>'.adddotstring($k['_pst_tnld']).' </td><td> </td></tr>
		<tr><td>3.2 </td><td class="td2">Giảm </td><td>'.adddotstring($k['_psg_odts']).' </td><td>'.adddotstring($k['_psg_httt']).' </td><td>'.adddotstring($k['_psg_yt']).' </td><td>'.adddotstring($k['_psg_tn']).' </td><td>'.adddotstring($k['_psg_tnld']).' </td><td> </td></tr>
		<tr><td>4 </td><td class="td2">Điều chỉnh phải đóng kỳ trước </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>4.1 </td><td class="td2">Tăng </td><td>'.adddotstring($k['_bst_odts']).' </td><td>'.adddotstring($k['_bst_httt']).' </td><td>'.adddotstring($k['_bst_yt']).' </td><td>'.adddotstring($k['_bst_tn']).' </td><td>'.adddotstring($k['_bst_tnld']).' </td><td>'.adddotstring($k['_bst_odts']+$k['_bst_httt']+$k['_bst_yt']+$k['_bst_tn']+$k['_bst_tnld']).' </td></tr>
		<tr><td> </td><td class="td2">Trong đó: năm trước </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>4.2 </td><td class="td2">Giảm </td><td>'.adddotstring($k['_bsg_odts']).' </td><td>'.adddotstring($k['_bsg_httt']).' </td><td>'.adddotstring($k['_bsg_yt']).' </td><td>'.adddotstring($k['_bsg_tn']).' </td><td>'.adddotstring($k['_bsg_tnld']).' </td><td>'.adddotstring($k['_bsg_odts']+$k['_bsg_httt']+$k['_bsg_yt']+$k['_bsg_tn']+$k['_bsg_tnld']).' </td></tr>
		<tr><td> </td><td class="td2">Trong đó: năm trước </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>4.3 </td><td class="td2">Điều chỉnh </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>5 </td><td class="td2">Lãi </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>5.1 </td><td class="td2">Số tiền tính lãi </td><td>'.adddotstring($k['_tientlOdts']).' </td><td>'.adddotstring($k['_tientlHttt']).' </td><td>'.adddotstring($k['_tientlyt']).' </td><td>'.adddotstring($k['_tientltn']).' </td><td>'.adddotstring($k['_tientlBhtnld']).' </td><td>'.adddotstring($k['_tientlOdts']+$k['_tientlHttt']+$k['_tientlyt']+$k['_tientltn']+$k['_tientlBhtnld']).' </td></tr>
		<tr><td>5.2 </td><td class="td2">Tỷ lệ tính lãi </td><td>'.$k['_lsbh'].' </td><td>'.$k['_lsbh'].' </td><td>'.$k['_lsyt'].' </td><td>'.$k['_lsbh'].' </td><td>'.$k['_lsbh'].' </td><td> </td></tr>
		<tr><td>5.3 </td><td class="td2">Tổng tiền lãi </td><td>'.adddotstring($k['_lai6_ps']).' </td><td>'.adddotstring($k['_lai7_ps']).' </td><td>'.adddotstring($k['_lai2_ps']).' </td><td>'.adddotstring($k['_lai3_ps']).' </td><td>'.adddotstring($k['_lai5_ps']).' </td><td>'.adddotstring($k['_laiqh']).' </td></tr>
		<tr><td>6 </td><td class="td2">2% bắt buộc để lại </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td><b>C </b> </td><td class="td2"><b>Số tiền đã nộp trong kỳ </b></td><td> </td><td> </td><td> </td><td> </td><td> </td><td><b>'.adddotstring($k['TienUNC']).'</b> </td></tr>
		<tr><td><b>D </b> </td><td class="td2"><b>Phân bổ tiền đóng </b></td><td>'.adddotstring($k['_dt_odts']).' </td><td>'.adddotstring($k['_dt_httt']).' </td><td>'.adddotstring($k['_dt_bhyt']).' </td><td>'.adddotstring($k['_dt_bhtn']).' </td><td>'.adddotstring($k['_dt_tnld']).' </td><td>'.adddotstring($k['_dt_odts']+$k['_dt_httt']+$k['_dt_bhyt']+$k['_dt_bhtn']+$k['_dt_tnld']).'  </td></tr>
		<tr><td>1 </td><td class="td2">Phải đóng </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>2 </td><td class="td2">Tiền lãi </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td><b>Đ </b> </td><td class="td2"><b>Chuyển kỳ sau </b> </td><td><b>'.adddotstring($k['ck_odts']+$k['_ck_lai6']).' </b></td><td><b>'.adddotstring($k['ck_httt']+$k['_ck_lai7']).'</b> </td><td><b>'.adddotstring($k['_ck_bhyt']+$k['_ck_lai2']).' </b></td><td><b>'.adddotstring($k['_ck_bhtn']+$k['_ck_lai3']).'</b> </td><td><b>'.adddotstring($k['ck_bhtnld']+$k['_ck_lai5']).' </b></td><td><b>'.adddotstring($k['_tien_ck']).' </b></td></tr>
		<tr><td>1 </td><td class="td2">Số lao động </td><td>'.$k['sldOdts'].' </td><td>'.$k['sldHttt'].' </td><td>'.$k['sldBhytCk'].' </td><td>'.$k['sldtn'].' </td><td>'.$k['sldTnld'].' </td><td> </td></tr>
		<tr><td>2 </td><td class="td2">Phải đóng </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>2.1 </td><td class="td2">Thừa </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><td>2.2 </td><td class="td2">Thiếu </td><td>'.adddotstring($k['ck_odts']).' </td><td>'.adddotstring($k['ck_httt']).' </td><td>'.adddotstring($k['_ck_bhyt']).' </td><td>'.adddotstring($k['_ck_bhtn']).' </td><td>'.adddotstring($k['ck_bhtnld']).' </td><td>'.adddotstring($k['ck_httt']+$k['ck_odts']+$k['_ck_bhyt']+$k['_ck_bhtn']+$k['ck_bhtnld']).' </td></tr>
		<tr><td>3 </td><td class="td2">Thiếu lãi </td><td>'.adddotstring($k['_ck_lai6']).' </td><td>'.adddotstring($k['_ck_lai7']).' </td><td>'.adddotstring($k['_ck_lai2']).' </td><td>'.adddotstring($k['_ck_lai3']).' </td><td> '.adddotstring($k['_ck_lai5']).'</td><td>'.adddotstring($k['_ck_lai']).' </td></tr>
		
	</table>	
	<p> a) Kết quả đơn vị đã đóng BHXH bắt buộc cho '.adddotstring($k['sldHttt']).' lao động đến hết tháng '.(date("m/Y",$tbhxh)).'.</p>
	<p> b) Kết quả đơn vị đã đóng BHTN bắt buộc cho '.adddotstring($k['sldtn']).' lao động đến hết tháng  '.(date("m/Y",$tbhtn)).'.</p>
	<p> c) Kết quả đơn vị đã đóng BHTNLĐ, BNN bắt buộc cho '.adddotstring($k['sldTnld']).' lao động đến hết tháng '.(date("m/Y",$tbhyt)).'
 </p>
	<p> d) Kết quả đơn vị đã đóng BHYT bắt buộc cho '.adddotstring($k['sldBhytCk']).' lao động đến hết tháng '.(date("m/Y",$tbhyt)).' </p>
	<p> đ) Tổng số nộp thiếu là '.adddotstring($k['_tien_ck']).' đồng. Đề nghị đơn vị nộp cho cơ quan BHXH trước ngày '.$ct.' </p>
	<p> e) Đề nghị đơn vị kiểm tra số liệu trên, nếu chưa thống nhất đề nghị đến cơ quan Bảo hiểm Xã hội tỉnh Gia Lai để kiểm tra điều chỉnh
trước ngày '.$ct.'. Quá thời hạn trên nếu đơn vị không đến, số liệu trên là đúng.
 </p>
	</div>
	<p class="ngay"><i>Gia Lai, Ngày cập nhật '.date("d/m/Y",strtotime($k['Ngaycn'])).'  .</i></p>
	<div class="cky">
		<p class="cb" ><i>( Số liệu C11 biến động liên tục khi có phát sinh điều chỉnh tỷ lệ, mức đóng, tăng, giảm lao động... vì vậy dữ liệu trên chỉ mang tính tham khảo nếu có vướng mắc đề nghị đơn vị liên hệ chuyên quản thu để được giải đáp! )</i></p>
	</div>
	</div>
	</body>
	</html>';
	//$dompdf->setHttpContext($context);
	//$dompdf->loadHtml($html);<img src="img/cky.png" /> '.subStr($ct,3,2).' năm '.subStr($ct,6,4).'
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
