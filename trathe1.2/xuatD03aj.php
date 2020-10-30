<?php
require_once("PHPExcel.php");
require_once("database.php");
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
session_start();
$db=new Database();

//echo "Tên đăng nhập :".$_SESSION['user'];

if($_POST["xuatdulieu"]==1){
	$data=$_POST["taD03"];
	$data=explode("\n",$data);
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
	$excel->getActiveSheet()->setCellValue('A1', 'SOBHXH');
	$excel->getActiveSheet()->setCellValue('B1', 'SOKCB');
	$excel->getActiveSheet()->setCellValue('C1', 'HOTEN');
	$excel->getActiveSheet()->setCellValue('D1', 'NGAYSINH');
	$excel->getActiveSheet()->setCellValue('E1', 'NAMSINH');
	$excel->getActiveSheet()->setCellValue('F1', 'GIOITINH');
	$excel->getActiveSheet()->setCellValue('G1', 'NOIKHAI');
	$excel->getActiveSheet()->setCellValue('H1', 'TINH_NK');
	$excel->getActiveSheet()->setCellValue('I1', 'HUYEN_NK');
	$excel->getActiveSheet()->setCellValue('J1', 'XA_NK');
	$excel->getActiveSheet()->setCellValue('K1', 'SOCMND');
	$excel->getActiveSheet()->setCellValue('L1', 'NGAYCMND');
	$excel->getActiveSheet()->setCellValue('M1', 'NOICAP');
	$excel->getActiveSheet()->setCellValue('N1', 'MA_TINHCMT');
	$excel->getActiveSheet()->setCellValue('O1', 'DANTOC');
	$excel->getActiveSheet()->setCellValue('P1', 'QUOCTICH');
	$excel->getActiveSheet()->setCellValue('Q1', 'DIACHI');
	$excel->getActiveSheet()->setCellValue('R1', 'TINH_LH');
	$excel->getActiveSheet()->setCellValue('S1', 'HUYEN_LH');
	$excel->getActiveSheet()->setCellValue('T1', 'XA_LH');
	$excel->getActiveSheet()->setCellValue('U1', 'DIACHIHK');
	$excel->getActiveSheet()->setCellValue('V1', 'TINH_HK');
	$excel->getActiveSheet()->setCellValue('W1', 'HUYEN_HK');
	$excel->getActiveSheet()->setCellValue('X1', 'XA_HK');
	$excel->getActiveSheet()->setCellValue('Y1', 'MAPB');
	$excel->getActiveSheet()->setCellValue('Z1', 'MADT');
	$excel->getActiveSheet()->setCellValue('AA1', 'TUNGAY');
	$excel->getActiveSheet()->setCellValue('AB1', 'SOTHANG');
	$excel->getActiveSheet()->setCellValue('AC1', 'TUTHANG');
	$excel->getActiveSheet()->setCellValue('AD1', 'DENTHANG');
	$excel->getActiveSheet()->setCellValue('AE1', 'TYLE');
	$excel->getActiveSheet()->setCellValue('AF1', 'TYLE_NSNN');
	$excel->getActiveSheet()->setCellValue('AG1', 'TYLEDONG');
	$excel->getActiveSheet()->setCellValue('AH1', 'ML_DK');
	$excel->getActiveSheet()->setCellValue('AI1', 'HSL_DK');
	$excel->getActiveSheet()->setCellValue('AJ1', 'ML');
	$excel->getActiveSheet()->setCellValue('AK1', 'HSL');
	$excel->getActiveSheet()->setCellValue('AL1', 'PA');
	$excel->getActiveSheet()->setCellValue('AM1', 'MA_TINH');
	$excel->getActiveSheet()->setCellValue('AN1', 'MA_BV');
	$excel->getActiveSheet()->setCellValue('AO1', 'MAVUNGSS');
	$excel->getActiveSheet()->setCellValue('AP1', 'TAMTRU');
	$excel->getActiveSheet()->setCellValue('AQ1', 'SOBL');
	$excel->getActiveSheet()->setCellValue('AR1', 'NGAYBL');
	$excel->getActiveSheet()->setCellValue('AS1', 'SDT');
	$excel->getActiveSheet()->setCellValue('AT1', 'MA_CA');
	$excel->getActiveSheet()->setCellValue('AU1', 'GIAM_DO_CHET');
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$numRow = 2;
	//echo "Số dòng xuất: ".(count($data)-1);
	for($i=0;$i<count($data)-1;$i++) {
		$dong=explode("#",$data[$i]);
			$excel->getActiveSheet()->setCellValue('A'.$numRow, $dong[1]); // Số thứ tự
			//$excel->getActiveSheet()->setCellValue('B'.$numRow, $dong[1]);
			$excel->getActiveSheet()->setCellValue('C'.$numRow, $dong[2]);
			$excel->getActiveSheet()->setCellValue('D'.$numRow, $dong[3]);
			$excel->getActiveSheet()->setCellValue('Q'.$numRow, $dong[4]); // địa chỉ
			$excel->getActiveSheet()->setCellValue('F'.$numRow, $dong[5]); // giới tính
			$excel->getActiveSheet()->setCellValue('AJ'.$numRow, $dong[6]); // mức lương
			$excel->getActiveSheet()->setCellValue('AM'.$numRow, $dong[7]); // mã tính KCB
			$excel->getActiveSheet()->setCellValue('AN'.$numRow, $dong[8]); // mã cs KCB
			$excel->getActiveSheet()->setCellValue('R'.$numRow, $dong[9]); // mã tỉnh LH
			$excel->getActiveSheet()->setCellValue('S'.$numRow, $dong[10]); // mã huyện LH
			$excel->getActiveSheet()->setCellValue('T'.$numRow, $dong[11]); // mã xã LH
			$excel->getActiveSheet()->setCellValue('AL'.$numRow, "TM"); // phương án
			$excel->getActiveSheet()->setCellValue('O'.$numRow, "Kinh"); // Dân tộc
			$excel->getActiveSheet()->setCellValue('P'.$numRow, "VN"); // Quốc tịch
			$excel->getActiveSheet()->setCellValue('AE'.$numRow, "4.5"); // Tỷ lệ
			$excel->getActiveSheet()->setCellValue('AC'.$numRow, date("m/yy",time())); // từ tháng
			$excel->getActiveSheet()->setCellValue('AD'.$numRow, date("m/yy",time())); // Đến tháng
			$excel->getActiveSheet()->setCellValue('AB'.$numRow, "12"); // Số tháng
			//$excel->getActiveSheet()->setCellValue('F'.$numRow, $dong[5]);
			$numRow++;
			//echo "<p>".$i."-".$dong[0]."-".$dong[1]."-".$dong[2]."-".$dong[3]."-".$dong[4]."</p>";
	}
	
	// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
	// ở đây mình lưu file dưới dạng excel2007
	//$date=now();
	//$filename='D:/PSBHYT-D03-'.time().'.xlsx';
	//PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save($filename);
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="PS-BHYT-D03'.time().'.xls"');
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
	//$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
	//echo $filename;
	$db->query("update login set luotxuatd03=luotxuatd03+1 where user='".$_SESSION['user']."'");
}
if($_POST["xuatdulieu"]==2){
	$data=$_POST["taD03"];
	$data=explode("\n",$data);
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
	$excel->getActiveSheet()->setCellValue('A1', 'STT');
	$excel->getActiveSheet()->setCellValue('B1', 'HOTEN');
	$excel->getActiveSheet()->setCellValue('C1', 'SOBHXH');
	$excel->getActiveSheet()->setCellValue('D1', 'NGAYSINH');
	$excel->getActiveSheet()->setCellValue('E1', 'NAMSINH');
	$excel->getActiveSheet()->setCellValue('F1', 'GIOITINH');
	$excel->getActiveSheet()->setCellValue('G1', 'SOCMND');
	$excel->getActiveSheet()->setCellValue('H1', 'NGAYCMND');
	$excel->getActiveSheet()->setCellValue('I1', 'NOICAP');
	$excel->getActiveSheet()->setCellValue('J1', 'MA_TINHCMT');
	$excel->getActiveSheet()->setCellValue('K1', 'NOIKHAI');
	$excel->getActiveSheet()->setCellValue('L1', 'TINH_NK');
	$excel->getActiveSheet()->setCellValue('M1', 'HUYEN_NK');
	$excel->getActiveSheet()->setCellValue('N1', 'XA_NK');
	$excel->getActiveSheet()->setCellValue('O1', 'DANTOC');
	$excel->getActiveSheet()->setCellValue('P1', 'QUOCTICH');
	$excel->getActiveSheet()->setCellValue('Q1', 'MADT');
	$excel->getActiveSheet()->setCellValue('R1', 'DIACHI');
	$excel->getActiveSheet()->setCellValue('S1', 'TINH_LH');
	$excel->getActiveSheet()->setCellValue('T1', 'HUYEN_LH');
	$excel->getActiveSheet()->setCellValue('U1', 'XA_LH');
	$excel->getActiveSheet()->setCellValue('V1', 'DIACHIHK');
	$excel->getActiveSheet()->setCellValue('W1', 'TINH_HK');
	$excel->getActiveSheet()->setCellValue('X1', 'HUYEN_HK');
	$excel->getActiveSheet()->setCellValue('Y1', 'XA_HK');
	$excel->getActiveSheet()->setCellValue('Z1', 'MA_TINH');
	$excel->getActiveSheet()->setCellValue('AA1', 'MA_BV');
	$excel->getActiveSheet()->setCellValue('AB1', 'NNDH');
	$excel->getActiveSheet()->setCellValue('AC1', 'MACV');
	$excel->getActiveSheet()->setCellValue('AD1', 'NOILAMVIEC');
	$excel->getActiveSheet()->setCellValue('AE1', 'ML_DK');
	$excel->getActiveSheet()->setCellValue('AF1', 'PC1_DK');
	$excel->getActiveSheet()->setCellValue('AG1', 'PC2_DK');
	$excel->getActiveSheet()->setCellValue('AH1', 'PC3_DK');
	$excel->getActiveSheet()->setCellValue('AI1', 'PC4_DK');
	$excel->getActiveSheet()->setCellValue('AJ1', 'PC5_DK');
	$excel->getActiveSheet()->setCellValue('AK1', 'PC6_DK');
	$excel->getActiveSheet()->setCellValue('AL1', 'ML');
	$excel->getActiveSheet()->setCellValue('AM1', 'MLPC');
	$excel->getActiveSheet()->setCellValue('AN1', 'MLBS');
	$excel->getActiveSheet()->setCellValue('AO1', 'PC1');
	$excel->getActiveSheet()->setCellValue('AP1', 'PC2');
	$excel->getActiveSheet()->setCellValue('AQ1', 'PC3');
	$excel->getActiveSheet()->setCellValue('AR1', 'PC4');
	$excel->getActiveSheet()->setCellValue('AS1', 'PC5');
	$excel->getActiveSheet()->setCellValue('AT1', 'PC6');
	$excel->getActiveSheet()->setCellValue('AU1', 'TUTHANG');
	$excel->getActiveSheet()->setCellValue('AV1', 'DENTHANG');
	$excel->getActiveSheet()->setCellValue('AW1', 'PA');
	$excel->getActiveSheet()->setCellValue('AX1', 'TYLE');
	$excel->getActiveSheet()->setCellValue('AY1', 'MAVUNG');
	$excel->getActiveSheet()->setCellValue('AZ1', 'TINHLAI');
	$excel->getActiveSheet()->setCellValue('BA1', 'MADVIDC');
	$excel->getActiveSheet()->setCellValue('BB1', 'TUNGAY');
	$excel->getActiveSheet()->setCellValue('BC1', 'SOTHANG');
	$excel->getActiveSheet()->setCellValue('BD1', 'TRATHE');
	$excel->getActiveSheet()->setCellValue('BE1', 'MAPB');
	$excel->getActiveSheet()->setCellValue('BF1', 'TAMTRU');
	$excel->getActiveSheet()->setCellValue('BG1', 'DACOSO');
	$excel->getActiveSheet()->setCellValue('BH1', 'NOICAPSO');
	$excel->getActiveSheet()->setCellValue('BI1', 'MAVUNGSS');
	$excel->getActiveSheet()->setCellValue('BJ1', 'GHICHU');
	$excel->getActiveSheet()->setCellValue('BK1', 'SDT');
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$numRow = 2;
	//echo "Số dòng xuất: ".(count($data)-1);
	for($i=0;$i<count($data)-1;$i++) {
		$dong=explode("#",$data[$i]);
			$excel->getActiveSheet()->setCellValue('A'.$numRow, $dong[0]); // Số thứ tự
			$excel->getActiveSheet()->setCellValue('C'.$numRow, $dong[1]); // số sổ BHXH
			$excel->getActiveSheet()->setCellValue('B'.$numRow, $dong[2]);  // họ tên
			$excel->getActiveSheet()->setCellValue('D'.$numRow, $dong[3]); // ngày sinh
			$excel->getActiveSheet()->setCellValue('R'.$numRow, $dong[4]); // địa chỉ
			$excel->getActiveSheet()->setCellValue('F'.$numRow, $dong[5]); // giới tính
			$excel->getActiveSheet()->setCellValue('AL'.$numRow, $dong[6]); // mức lương
			$excel->getActiveSheet()->setCellValue('Z'.$numRow, $dong[7]); // mã tính KCB
			$excel->getActiveSheet()->setCellValue('AA'.$numRow, $dong[8]); // mã cs KCB
			$excel->getActiveSheet()->setCellValue('S'.$numRow, $dong[9]); // mã tỉnh LH
			$excel->getActiveSheet()->setCellValue('T'.$numRow, $dong[10]); // mã huyện LH
			$excel->getActiveSheet()->setCellValue('U'.$numRow, $dong[11]); // mã xã LH
			$excel->getActiveSheet()->setCellValue('AW'.$numRow, "TM"); // phương án
			//$excel->getActiveSheet()->setCellValue('O'.$numRow, "Kinh"); // Dân tộc
			$excel->getActiveSheet()->setCellValue('P'.$numRow, "VN"); // Quốc tịch
			$excel->getActiveSheet()->setCellValue('AX'.$numRow, "32"); // Tỷ lệ
			$excel->getActiveSheet()->setCellValue('AU'.$numRow, date("m/yy",time())); // từ tháng
			$excel->getActiveSheet()->setCellValue('AV'.$numRow, date("m/yy",time())); // Đến tháng
			//$excel->getActiveSheet()->setCellValue('AB'.$numRow, "12"); // Số tháng
			//$excel->getActiveSheet()->setCellValue('F'.$numRow, $dong[5]);
			$excel->getActiveSheet()->setCellValue('AY'.$numRow, "03"); // mã vùng
			$excel->getActiveSheet()->setCellValue('AC'.$numRow, "Nhân viên ..."); // mã công việc
			$numRow++;
			//echo "<p>".$i."-".$dong[0]."-".$dong[1]."-".$dong[2]."-".$dong[3]."-".$dong[4]."</p>";
	}
	
	// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
	// ở đây mình lưu file dưới dạng excel2007
	//$date=now();
	//$filename='D:/PSBHXH-D02-'.time().'.xlsx';
	//PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save($filename);
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="PS-BHXH-D02'.time().'.xlsx"');
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
	//$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
	
	//echo "Tên đăng nhập :".$_SESSION['user'];
	$db->query("update login set luotxuatd02=luotxuatd02+1 where user='".$_SESSION['user']."'");
	//echo $filename;
	
}
?>