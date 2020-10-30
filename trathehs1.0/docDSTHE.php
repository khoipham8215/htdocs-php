<div class="fup">
    <form class="ftk" id="form_upload" method="POST" enctype="multipart/form-data">
        <input  type="file" name="fileUpload"  id="fileUpload" >
        <Button type="submit" name="submit" >Đọc file DSHS</Button><br/>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
//Nhúng file PHPExcel
require_once 'PHPExcel.php';
require_once 'database.php';

//Đường dẫn file
//$file = 'D:/DSLD_064_02.xlsx';
//$file=basename($_FILES["fileUpload"]["name"]);
//$path=$_FILES["fileUpload"]["path"];
//echo $path;
$file=$_FILES["fileUpload"]["tmp_name"];
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
			$data[$i-2]['maDonViThu'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==1)
			$data[$i-2]['maDonViThe'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==2)
			$data[$i-2]['tinhKcb'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==3)
			$data[$i-2]['maKcb'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==4)
			$data[$i-2]['maDoiTuong'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==5)
			$data[$i-2]['hoTen'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==6)
			$data[$i-2]['ngaySinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==7)
			$data[$i-2]['gioiTinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==8)
			$data[$i-2]['soKCB'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==9)
			$data[$i-2]['soSoBhxh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==10)
			$data[$i-2]['diaChi'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==11)
			$data[$i-2]['mucLuong'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==12)
			$data[$i-2]['tuNgay'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==13)
			$data[$i-2]['denNgay'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==14)
			$data[$i-2]['namht'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==15)
			$data[$i-2]['ngayCap'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==16)
			$data[$i-2]['stlt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==17)
			$data[$i-2]['maQl'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		
				
	//$c12[$i-2]=$data;
	
	}
	
}
// Thêm dữ liệu vào Database
$db= new Database();
$db->connect();
//echo $db.error();
//$table='c12';

foreach($data as $key=>$value){
	$db->insert('thebhyt',$value);
}
if($db->error()){
	echo $db->error();
}else{
	echo "<p> Tổng số dòng lưu CSDL : ".($Totalrow-1)."</p>";
	echo "Lưu danh sách lao động thành công !";
}
//Hiển thị mảng dữ liệu
//echo '<pre>';
//var_dump($data);
}