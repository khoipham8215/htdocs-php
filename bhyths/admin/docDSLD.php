<div class="container-fluid col-6 ftim fup">
    <form class="ftk" id="form_upload" method="POST" enctype="multipart/form-data">
        <input  type="file" name="fileUpload"  id="fileUpload" >
        <Button type="submit" name="submit" >Đọc file</Button><br/>
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
			$data[$i-2]['madvi'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==1)
			$data[$i-2]['maTinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==2)
			$data[$i-2]['maHuyen'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==3)
			$data[$i-2]['soBhxh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==4)
			$data[$i-2]['soSoBhxhOld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==5)
			$data[$i-2]['soSoBhxhCu'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==6)
			$data[$i-2]['soKcb'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==7)
			$data[$i-2]['loaiDt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==8)
			$data[$i-2]['hoTen'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==9)
			$data[$i-2]['gioiTinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==10)
			$data[$i-2]['ngaySinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==11)
			$data[$i-2]['noiKhaiSinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==12)
			$data[$i-2]['diaChiLh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==13)
			$data[$i-2]['diaChiHk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==14)
			$data[$i-2]['noiCapSo'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==15)
			$data[$i-2]['maPb'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==16)
			$data[$i-2]['nguoiGiamHo'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==17)
			$data[$i-2]['soCmnd'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==18)
			$data[$i-2]['ngayCapCmnd'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==19)
			$data[$i-2]['noiCapCmnd'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==20)
			$data[$i-2]['maBv'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==21)
			$data[$i-2]['danToc'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==22)
			$data[$i-2]['quocTich'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==23)
			$data[$i-2]['mucLuong'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==24)
			$data[$i-2]['heSoLuong'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==25)
			$data[$i-2]['luongHd'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==26)
			$data[$i-2]['mlPc'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==27)
			$data[$i-2]['mlBs'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==28)
			$data[$i-2]['pcCv'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==29)
			$data[$i-2]['pcKv'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==30)
			$data[$i-2]['pcNghe'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==31)
			$data[$i-2]['pcTc'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==32)
			$data[$i-2]['pcKhac'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==33)
			$data[$i-2]['pcTn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==34)
			$data[$i-2]['tyLeBhtn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==35)
			$data[$i-2]['tyLeBhtnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==36)
			$data[$i-2]['tyLeBhyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==37)
			$data[$i-2]['loaiDt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==38)
			$data[$i-2]['maQt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==39)
			$data[$i-2]['pa'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==40)
			$data[$i-2]['tuThang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==41)
			$data[$i-2]['denThang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==42)
			$data[$i-2]['congViec'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==43)
			$data[$i-2]['maCv'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==44)
			$data[$i-2]['maXaLh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==45)
			$data[$i-2]['maHuyenLh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==46)
			$data[$i-2]['maTinhLh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==47)
			$data[$i-2]['maXaHk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==48)
			$data[$i-2]['maHuyenHk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==49)
			$data[$i-2]['maTinhHk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==50)
			$data[$i-2]['maVung'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==51)
			$data[$i-2]['maVungSs'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==52)
			$data[$i-2]['soThang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==53)
			$data[$i-2]['hanTheTu'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==54)
			$data[$i-2]['hanTheDen'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==55)
			$data[$i-2]['soDienThoai'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==56)
			$data[$i-2]['maSoThue'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		
		
	//$c12[$i-2]=$data;
	
	}
	
}
// Thêm dữ liệu vào Database
$db= new Database();
$db->connect();
//echo $db.error();
//$table='c12';
foreach($data as $key=>$value){
	$db->insert('dsld',$value);
}
if($db->error()){
	echo $db->error();
}else
	echo "<div class='container-fluid kqt'> Lưu danh sách lao động thành công !<br> Tổng số cập nhật :".($Totalrow-1)."</div>";
//Hiển thị mảng dữ liệu
//echo '<pre>';
//var_dump($data);
}