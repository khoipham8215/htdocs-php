<?php
require_once '../PHPExcel.php';
require_once '../database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(isset($_POST['maql'])){
	echo $_POST['maql']."<br/>";
	//$file= $_POST['file'];
	$file=$_FILES["fileUpload"]["name"];
	echo $file;
	$i=substr($_POST['maql'],6,2);
	$ls=substr($_POST['maql'],0,5);
	echo "<br/>i=".$i;
	/**
	$objFile=PHPExcel_IOFactory::identify($file);
	$objData=PHPExcel_IOFactory::createReader($objFile);
	//Chỉ đọc dữ liệu
	$objData->setReadDataOnly(true);

	// Load dữ liệu sang dạng đối tượng
	$objPHPExcel = $objData->load($file);
	$listSheet=$objData->listWorkSheetNames($file);
	$j=0;
	foreach($listSheet as $ls){
		LuuDuLieu($j,$ls,$file);
		echo "Lưu dữ liệu hoàn tất ! ".$ls;
		$j++;
	*/
	LuuDuLieu($i,$ls,$file);
	echo "<br/>Lưu dữ liệu hoàn tất ! ".$ls;
	
}

function LuuDuLieu($s,$macqql,$file){
	//$file = $_FILES['fileUpload']['tmp_name'];
	//echo $file;
	$objFile=PHPExcel_IOFactory::identify($file);
	$objData=PHPExcel_IOFactory::createReader($objFile);
	//Chỉ đọc dữ liệu
	$objData->setReadDataOnly(true);

	// Load dữ liệu sang dạng đối tượng
	$objPHPExcel = $objData->load($file);

	//Lấy ra số trang sử dụng phương thức getSheetCount();
	// Lấy Ra tên trang sử dụng getSheetNames();

	//Chọn trang cần truy xuất
	$sheet = $objPHPExcel->setActiveSheetIndex($s);

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
	echo "<br/>Sheet :".$macqql." có số dòng : ".($Totalrow -1); 
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
			if($j==162)
				$data[$i-2]['sld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==51)
				$data[$i-2]['tienUNC'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==69)
				$data[$i-2]['tien_ck'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==31)
				$data[$i-2]['tql'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==120)
				$data[$i-2]['tongpstk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue()+$sheet->getCellByColumnAndRow(60, $i)->getValue()+$sheet->getCellByColumnAndRow(124, $i)->getValue()-$sheet->getCellByColumnAndRow(129, $i)->getValue();
			if(isset($data[$i-2]['thangps'])){
				$data[$i-2]['id'] = $data[$i-2]['madvi'].$data[$i-2]['thangps'];	
				//$data[$i-2]['ngayps']=date_create("2020-01-01");
			}
			//if(isset($data[$i-2]['ngayps']))
				//$data[$i-2]['ngayps']=date_create("2020-01-01");
				//$data[$i-2]['ngayps']=date_create(substr($sheet->getCellByColumnAndRow($j, $i)->getValue(),0,4)."-".substr($sheet->getCellByColumnAndRow($j, $i)->getValue(),5,2)."-01");
			$data[$i-2]['macqql'] = $macqql;
			
		//$c12[$i-2]=$data;
		
		}
		
	}
	$db= new Database();
	$db->connect();
	//echo $db.error();
	//$table='c12';
	foreach($data as $key=>$value){
		$db->insert('c12',$value);
	}
	$sqlxoaps="DELETE FROM `c12` WHERE `thangps` not like '%2020%'";
	$db->query($sqlxoaps);
	$db->query("UPDATE `c12` SET `ngayps`= concat(left(`ThangPS`,4),'-', RIGHT(`ThangPS`,2),'-01')");
	return $db->error();
}
?>