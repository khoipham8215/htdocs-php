<?
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
?>
<style>
.fup{
	margin-top:55px;
	border:1px solid;
	padding:10px;
}
.fup input,button{
	font-size:20px;
}
.dshs{
	width:300px;
	float :left;
}
.dshs td{
	border:1px solid;
}
.trathe{
	float :left;
	width:800px;
	border:1px solid;
}
.trathe select,option{
	font-size:20px;
	height:30px;
}
#txtdltra{
	display :none;
}
#loadmss{
	text-align:center;
	position:absolute;
	top:300px;
	right:30%;
	display:none;
	z-index:999;
	border:2px solid #337AB7;
	width:300px;
	height:auto;
	
	background-color:white;
}
.loadtd{
	background-color:#337AB7;
	color:white;
	font-size:20px;
	padding :5px;
}
.loadtb{
	color:#337AB7;
	font-size:20px;
}
#over{
	width:100%;
	height:100%;
	opacity:0.6;
	background-color:#000;
	z-index:99;
	display:none;
	position:fixed;
	top:0;
	left:0;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
 <script language="javascript">
            function trathehs(){
				$("#loadmss").fadeIn();
				$('body').append('<div id="over">');
				$("#over").fadeIn();
				//var mangtra=new Array();
				//alert($("select[name='loaitc']").val() + $("select[name='namps']").val());
                $.ajax({
                    url : "trathehsaj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 loaitc : $("select[name='loaitc']").val(),	
						 namps : $("select[name='namps']").val(),
						 dltra : $("#txtdltra").val(),
						 diachi: $("input[name='diachi']").val(),	
						 
                    },
                    success : function (result){
						$("#over").fadeOut();
						$("#loadmss").fadeOut();
						$('#kqtra').html(result);
                        //$('#result').html(result);
                    }
                });
            }
</script>

<body>
<div id="loadmss">
	<div class="loadtd">Trạng thái xử lý</div>
	<div class="loadtb">Đang xử lý vui lòng đợi trong giây lát...</div>
	<div class="loadimg"><img src="img/load1.gif" /></div>
</div>
<div class="fup">
    <form class="ftk" id="form_upload" method="POST" enctype="multipart/form-data">
        <input  type="file" name="fileUpload"  id="fileUpload" >
        <Button type="submit" name="submit" >Đọc file danh sách học sinh cần tra cứu</Button><br/>
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
$listSheet=$objData->listWorkSheetNames($file);
for ($i = 2; $i <= $Totalrow; $i++) {
    //----Lặp cột
    for ($j = 0; $j < $TotalCol; $j++) {
        // Tiến hành lấy giá trị của từng ô đổ vào mảng
		//if($j==0 or $j==2 or $j==5 or $j==6 or $j==7 or $j==10 or $j==17 or $j==34 or $j==51 or $j==69 or $j==121)
		//	$data[$i-2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==1)
			$data[$i-2]['hoten'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==2)
			$data[$i-2]['ngaysinh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		if($j==3)
			$data[$i-2]['marasoat'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
		
				
	//$c12[$i-2]=$data;
	
	}
	
}
// Thêm dữ liệu vào Database
$db= new Database();
$db->connect();
//echo $db.error();
//$table='c12';
$i=1;
echo "<p class='df'>Đã đọc file : ".$_FILES["fileUpload"]["name"]." Sheet :".$listSheet[0]."</p>";
echo "<p> Thời gian rà soát dự kiến cho :".count($data)." thẻ là :".(count($data)*0.25)." giây ( Khoảng".((count($data)*0.25)/60)."phút </p>";
echo "<div class='dshs'><table class='dshs'><tr><th>STT</th><th>Họ tên</th><th>Ngày Sinh</th><th>Mã rà soát</th></tr>";
foreach($data as $key=>$value){
	if(!empty($value['hoten']))
		echo "<tr><td>".$i++."</td><td>".$value['hoten']."</td><td>".$value['ngaysinh']."</td><td>".$value['marasoat']."</td></tr>";
}

//Hiển thị mảng dữ liệu
//echo '<pre>';
//var_dump($data);
}
?>

</table>
</div>
<textarea  id ="txtdltra" name="txtdltra" class="txta" rows="20" cols="60" >
<?php
 foreach($data as $key=>$value){
	 if(!empty($value['hoten']))
		echo $value['hoten']."#".$value['ngaysinh']."#".$value['marasoat']."\n";
 }
?>
 </textarea>
<div class="trathe">
<label> Chọn loại tra cứu </label>
<select name="loaitc">
<option value="1">Tra theo họ tên có dấu + ngày sinh </option> 
<option value="2">Tra theo họ tên có dấu + năm sinh </option>
<option value="3">Tra theo họ tên có dấu + năm sinh + địa chỉ </option> 
<option value="4">Tra theo họ tên không dấu + ngày sinh </option>
<option value="5">Tra theo họ tên không dấu + năm sinh </option>   
</select>
<label> Chọn năm tra cứu </label>
<select name="namps">
<option value="2014">2014 </option> 
<option value="2015">2015</option>
<option value="2016">2016 </option>  
<option value="2017">2017 </option>
<option value="2018">2018 </option>  
</select>
<label> Lọc theo địa chỉ </label>
<input type="text" name="diachi" />
<Button type="button" name="tracuuthe" onclick="trathehs()" >Tra thẻ BHYT</Button>
</div>
<div id="kqtra">
</div>

</body>