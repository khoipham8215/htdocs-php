<?php
require_once 'PHPExcel.php';
require_once 'database.php';
?>
<style> 
	.content{
		margin:auto;
		border-style:solid;
		border-color:#045FB4;
		border-width:1px;
		font-family:arial;
		font-size:0.8em;
		padding:5px;
		width:80%;
		background-color:#E6E6E6;
		.ftk{
		background-color:#045FB4;
		padding:5px;
	}
	.ftk{
		width:150px;
		height:30px;
		font-size:1.2em;
	}
	
	
</style>
<div class="content">
<div >
    <form class="ftk" id="form_upload" method="POST" enctype="multipart/form-data">
        <input  type="file" name="fileUpload"  id="fileUpload" >
        <Button type="submit" name="submit" >Đọc file</Button><br/>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['fileUpload']['tmp_name'];
	//echo $file;
	$objFile=PHPExcel_IOFactory::identify($file);
	$objData=PHPExcel_IOFactory::createReader($objFile);
	// Đọc ds các sheet
	$listSheet=$objData->listWorkSheetNames($file);
	//print_r($listSheet);
	/** echo "<form id ='luudl' method='get' action='index.php'><Label for='cqql'>Chọn cơ quan quản lý :</label><Select id='CQQL' size=1>";
	$i=0;
	foreach($listSheet as $ls){
		echo "<option id=".$ls.">";
		echo $ls."-".$i;
		$i++;
		echo "</option>";
	}
	
	echo "</Select>";
	 */
	
function LuuDuLieu($s,$macqql){
	$file = $_FILES['fileUpload']['tmp_name'];
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
			if($j==31)
				$data[$i-2]['tql'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==120)
				$data[$i-2]['tongpstk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue()+$sheet->getCellByColumnAndRow(60, $i)->getValue()+$sheet->getCellByColumnAndRow(124, $i)->getValue()-$sheet->getCellByColumnAndRow(129, $i)->getValue();
			if(isset($data[$i-2]['thangps']))
				$data[$i-2]['id'] = $data[$i-2]['madvi'].$data[$i-2]['thangps'];
			$data[$i-2]['macqql'] = $macqql;
		//$c12[$i-2]=$data;
		
		}
		
	}
	// Thêm dữ liệu vào Database
	$db= new Database();
	$db->connect();
	//echo $db.error();
	//$table='c12';
	foreach($data as $key=>$value){
		$db->insert('c12',$value);
	}
	return $db->error();
}
	$i=0;
	//foreach($listSheet as $ls){
		LuuDuLieu(0,$listSheet[0]);
		//echo $i;
	//	$i++;
	//}
echo "Lưu dữ liệu hoàn tất ! ".$listSheet[0];
//$db->__destruct();
}

?>
</div>