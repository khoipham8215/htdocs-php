<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
require_once("PHPExcel.php");
require_once("database.php");
session_start();
$db=new Database();
if($_POST["madvi"]){
	//$data=$_POST["taD03"];
	//$data=explode("\n",$data);
	$madvi=$_POST["madvi"];
	$data=$db->query1("SELECT * FROM dsld WHERE maDvi like '".$madvi."'",MYSQLI_ASSOC);
	$excel = new PHPExcel();
	//Chọn trang cần ghi (là số từ 0->n)
	$excel->setActiveSheetIndex(0);
	//Tạo tiêu đề cho trang. (có thể không cần)
	$excel->getActiveSheet()->setTitle('Import BHYT');

	//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
	//$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	//$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	//$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	$phpColor = new PHPExcel_Style_Color();
	$phpColor->setRGB('CA212A'); 
	//Xét in đậm cho khoảng cột
	$excel->getActiveSheet()->getStyle('A1:AU1')->getFont()->setBold(true);
	$excel->getActiveSheet()->getStyle('A1:AU1')->getFont()->setColor($phpColor);
	//Tạo tiêu đề cho từng cột
	//Vị trí có dạng như sau:
	/**
	 * |A1|B1|C1|..|n1|
	 * |A2|B2|C2|..|n1|
	 * |..|..|..|..|..|
	 * |An|Bn|Cn|..|nn|
	 */
	$excel->getActiveSheet()->setCellValue('A1', 'SO_SO_BHXH');
	$excel->getActiveSheet()->setCellValue('B1', 'MA_THE');
	$excel->getActiveSheet()->setCellValue('C1', 'HO_TEN');
	$excel->getActiveSheet()->setCellValue('D1', 'GIOI_TINH');
	$excel->getActiveSheet()->setCellValue('E1', 'NGAY_SINH');
	$excel->getActiveSheet()->setCellValue('F1', 'CHI_NAM_SINH');
	$excel->getActiveSheet()->setCellValue('G1', 'CHI_THANG_SINH');
	$excel->getActiveSheet()->setCellValue('H1', 'MA_TINH_KCB');
	$excel->getActiveSheet()->setCellValue('I1', 'MA_KCB');
	$excel->getActiveSheet()->setCellValue('J1', 'MA_PB');
	$excel->getActiveSheet()->setCellValue('K1', 'MA_QUOC_TICH');
	$excel->getActiveSheet()->setCellValue('L1', 'SO_CMND');
	$excel->getActiveSheet()->setCellValue('M1', 'NGAY_CAP_CMND');
	$excel->getActiveSheet()->setCellValue('N1', 'DIA_CHI_LH');
	$excel->getActiveSheet()->setCellValue('O1', 'MA_XA_LH');
	$excel->getActiveSheet()->setCellValue('P1', 'MA_HUYEN_LH');
	$excel->getActiveSheet()->setCellValue('Q1', 'MA_TINH_LH');
	$excel->getActiveSheet()->setCellValue('R1', 'DIA_CHI_HK');
	$excel->getActiveSheet()->setCellValue('S1', 'MA_XA_HK');
	$excel->getActiveSheet()->setCellValue('T1', 'MA_HUYEN_HK');
	$excel->getActiveSheet()->setCellValue('U1', 'MA_TINH_HK');
	$excel->getActiveSheet()->setCellValue('V1', 'MA_XA_KS');
	$excel->getActiveSheet()->setCellValue('W1', 'MA_HUYEN_KS');
	$excel->getActiveSheet()->setCellValue('X1', 'MA_TINH_KS');
	$excel->getActiveSheet()->setCellValue('Y1', 'MA_VUNG_SS');
	$excel->getActiveSheet()->setCellValue('Z1', 'MA_HUONG');
	$excel->getActiveSheet()->setCellValue('AA1', 'NGUOI_GIAM_HO');
	$excel->getActiveSheet()->setCellValue('AB1', 'UU_TIEN_MA_HUONG_CN');
	$excel->getActiveSheet()->setCellValue('AC1', 'MA_DVI_TG');
	$excel->getActiveSheet()->setCellValue('AD1', 'SO_DIEN_THOAI');
	$excel->getActiveSheet()->setCellValue('AE1', 'MA_DAN_TOC');
	$excel->getActiveSheet()->setCellValue('AF1', 'MA_KHOI_KCB');
	$excel->getActiveSheet()->setCellValue('AG1', 'UU_TIEN_MA_KHOI_KCB');
	$excel->getActiveSheet()->setCellValue('AH1', 'LOAI_HC');
	$excel->getActiveSheet()->setCellValue('AI1', 'MA_SO_THUE');
	$excel->getActiveSheet()->setCellValue('AJ1', 'GHI_CHU');
	
	
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$numRow = 2;
	//echo "Số dòng xuất: ".(count($data)-1);
	foreach($data as $d) {
		$dong=explode("#",$data[$i]);
			$excel->getActiveSheet()->setCellValue('A'.$numRow, $d['soBhxh']); // số sổ BHXH
			$excel->getActiveSheet()->setCellValue('AD'.$numRow, $d['soDienThoai']); // số đt
			$excel->getActiveSheet()->setCellValue('AI'.$numRow, $d['maSoThue']);
			$numRow++;
			//echo "<p>".$i."-".$dong[0]."-".$dong[1]."-".$dong[2]."-".$dong[3]."-".$dong[4]."</p>";
	}
	
	// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
	// ở đây mình lưu file dưới dạng excel2007
	//$date=now();
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="HCSDT-'.$madvi.'-'.time().'.xlsx"');
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
	//$filename='HCSDT-'.$madvi.'-'.time().'.xlsx';
	//PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->output($filename);
	//header('Content-type: application/vnd.ms-excel');
	//header('Content-Disposition: attachment; filename="PS-BHYT-D03'.time().'.xls"');
	//PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
	//$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
	
	//echo "Tên đăng nhập :".$_SESSION['user'];
	//$db->query("update login set luotxuatd02=luotxuatd02+1 where user='".$_SESSION['user']."'");
	//echo $filename;
	
}
?>