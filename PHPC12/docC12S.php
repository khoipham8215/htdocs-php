<?php
//Nhúng file PHPExcel
require_once 'PHPExcel.php';
require_once 'database.php';

//Đường dẫn file
$file = 'D:/C12_Chi_Tieu_595.xls';
//Tiến hành xác thực file
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);

//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);

// Load dữ liệu sang dạng đối tượng
$objPHPExcel = $objData->load($file);

//Lấy ra số trang sử dụng phương thức getSheetCount();
// Lấy Ra tên trang sử dụng getSheetNames();

//Chọn trang cần truy xuất
$sheet = $objPHPExcel->setActiveSheetIndex(0);

//Lấy ra số dòng cuối cùng
$Totalrow = $sheet->getHighestRow();
//Lấy ra tên cột cuối cùng
$LastColumn = $sheet->getHighestColumn();

//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);

//Tạo mảng chứa dữ liệu
$data = []; // Tạo mảng chứa dữ liệu C12

//Tiến hành lặp qua từng ô dữ liệu
//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2
$c12=[]; 

for ($i = 2; $i <= $Totalrow; $i++) {
    //----Lặp cột
    for ($j = 0; $j < $TotalCol; $j++) {
        // Tiến hành lấy giá trị của từng ô đổ vào mảng
		//if($j==0 or $j==2 or $j==5 or $j==6 or $j==7 or $j==10 or $j==17 or $j==34 or $j==51 or $j==69 or $j==121)
		//	$data[$i-2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==0)
			$data[$i-2]['madvi'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==2)
			$data[$i-2]['tendvi'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==5)
			$data[$i-2]['diachi'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==6)
			$data[$i-2]['dienthoai'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==7)
			$data[$i-2]['nguoilh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==10)
			$data[$i-2]['thangps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==17)
			$data[$i-2]['tien_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==34)
			$data[$i-2]['sld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==51)
			$data[$i-2]['tienUNC'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==69)
			$data[$i-2]['tien_ck'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==121)
			$data[$i-2]['tongpstk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if(isset($data[$i-2]['thangps']))
			$data[$i-2]['id'] = $data[$i-2]['madvi'].$data[$i-2]['thangps'];
	//$c12[$i-2]=$data;
	
	}
	
}
// Thêm dữ liệu vào Database
//$db= new Database();
//$db->connect();
//echo $db.error();
//$table='c12';
//foreach($data as $key=>$value){
//	$db->insert('c12',$value);
//}
//echo $db->error();
//Hiển thị mảng dữ liệu
echo '<pre>';
//echo $sheet->getSheetNames();
echo $sheet->getSheetCount();
//var_dump($sheet->getSheetCount();
//var_dump($objData);