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
		font-size:1.2em;
		padding:5px;
		width:80%;
		background-color:#E6E6E6;
		padding:5px;
	}
	.content input{
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
	}
	.content button{
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin:5px;
	}
	.content select{
		border-width:1px;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin:5px;
	}
	.dl{
		background-color:blue;
		border-width:1px;
		color:white;
		font-size:1em;
	}
	.hidden{
		display:none;
	}
	.btluu{
		border:1px solid black;
		font-family:arial;
		font-size:1em;
		padding:5px;
		margin-right:5px;
		float:auto;
	}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function load_ajax(obj){
				alert("Xác nhận lưu :"+obj.value);
                $.ajax({
					
                    url : "importLDajax.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 maql : obj.value,
						 file : $("input[name='file']").val()
                    },
                    success : function (result){
						//$(".demo").easyOverlay("stop");
						$('#result').html(result);
                        //$('#result').html(result);
                    }
					//$(".demo").easyOverlay("start");
                });
            }
			function cqqlchange(obj){
				value=obj.value;
				//$("input[name='cqchon']").val()=value;
				//alert($("select[name='cqql']").val())
				//alert(value);
				//alert($("input[name='file']").val());
			}
			function loadtime(){
				alert("xin chao !");
				//$(".demo").easyOverlay("start");
			}
        </script>
		<script src="jquery.easy-overlay.js"></script>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="content">
<div class="fup">
    <form class="ftk" id="form_upload" method="POST" enctype="multipart/form-data">
        <input  type="file" name="fileUpload"  id="fileUpload" >
        <Button type="submit" name="submit" >Đọc file</Button><br/>
    </form>
</div>
<?php

if (isset($_POST['submit'])) {
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
	$uploadOk = 1;
	if (file_exists($target_file)) {
    echo "File đã tồn tại !.";
    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
    echo "Lỗi không tải lên server.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "The file ". $target_file. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	}	
	//$file = substr($target_file,0,strlen($target_file));
	//echo $file;
	$file=$target_file;
	$objFile=PHPExcel_IOFactory::identify($file);
	$objData=PHPExcel_IOFactory::createReader($objFile);
	// Đọc ds các sheet
	$listSheet=$objData->listWorkSheetNames($file);
	//print_r($listSheet);
	

	
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
		$db->insert('dsld',$value);
	}
	return $db->error();
}
	
	//$i=0;
	//foreach($listSheet as $ls){
		//LuuDuLieu(0,$listSheet[0]);
		//echo $i;
	//	$i++;
	//}
//echo "Lưu dữ liệu hoàn tất ! ".$listSheet[0];
//$db->__destruct();


}
// sqlxoaps="DELETE FROM `c12` WHERE `thangps` not like '%2020%'";
?>
<div id="result">
Kết quả xử lý
</div>
<div class='demo' onclick="loadtime()">Loadding... </div>
</div>