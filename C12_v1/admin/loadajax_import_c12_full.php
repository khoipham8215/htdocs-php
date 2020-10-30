
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
ini_set('memory_limit', '-1');
if(isset($_POST['maql'])){
	echo $_POST['maql']."<br/>";
	$file=$_POST['file'];
	$file=substr($file,0,strlen($file)-1);
	//$file= substr($_POST['file'],0,strlen($_POST['file'])-1);
	//echo $file;
	//$file=$_FILES["fileUpload"]["tmp_name"];
	$i=substr($_POST['maql'],6,2);
	$ls=substr($_POST['maql'],0,5);
	echo "i=".$i;
	/**
	chmod($path_to_file, 777);
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
			if(isset($data[$i-2]['thangps'])){
				$data[$i-2]['id'] = $data[$i-2]['madvi'].$data[$i-2]['thangps'];	
				//$data[$i-2]['ngayps']=date_create("2020-01-01");
			}
			//if(isset($data[$i-2]['ngayps']))
				//$data[$i-2]['ngayps']=date_create("2020-01-01");
				//$data[$i-2]['ngayps']=date_create(substr($sheet->getCellByColumnAndRow($j, $i)->getValue(),0,4)."-".substr($sheet->getCellByColumnAndRow($j, $i)->getValue(),5,2)."-01");
			$data[$i-2]['macqql'] = $macqql;
			
		//$c12[$i-2]=$data;
			if($j==186)
				$data[$i-2]['sldOdts_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==213)
				$data[$i-2]['sldHttt_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==110)
				$data[$i-2]['sldBhytDk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==77)
				$data[$i-2]['sldtn_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==152)
				$data[$i-2]['sldtnld_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==187)
				$data[$i-2]['_dk_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==214)
				$data[$i-2]['_dk_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==14)
				$data[$i-2]['_dk_bhyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==15)
				$data[$i-2]['_dk_bhtn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==13)
				$data[$i-2]['_dk_bhxh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==188)
				$data[$i-2]['_dk_lai6'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==215)
				$data[$i-2]['_dk_lai7'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==101)
				$data[$i-2]['_dk_lai2'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==102)
				$data[$i-2]['_dk_lai3'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==154)
				$data[$i-2]['_dk_lai5'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==202)
				$data[$i-2]['psOdtsTk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==229)
				$data[$i-2]['pshttttk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==118)
				$data[$i-2]['psBhytTk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==119)
				$data[$i-2]['psBhtnTk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==175)
				$data[$i-2]['psBhtnldTk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==209)
				$data[$i-2]['_sldHttttang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==182)
				$data[$i-2]['_sldOdtstang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==111)
				$data[$i-2]['sldBhytTang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==80)
				$data[$i-2]['_sldtntang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==148)
				$data[$i-2]['_sldtnldtang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==210)
				$data[$i-2]['_sldHtttgiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==183)
				$data[$i-2]['_sldOdtsgiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==112)
				$data[$i-2]['sldBhytGiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==81)
				$data[$i-2]['_sldtngiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==149)
				$data[$i-2]['_sldtnldgiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==32)
				$data[$i-2]['_tqlyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==33)
				$data[$i-2]['_tqltn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==165)
				$data[$i-2]['tqlBhxhTang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==169)
				$data[$i-2]['tqlBhytTang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==167)
				$data[$i-2]['tqlBhtnTang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==171)
				$data[$i-2]['tqlBhtnldTang'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==164)
				$data[$i-2]['tqlBhxhGiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==168)
				$data[$i-2]['tqlBhytGiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==166)
				$data[$i-2]['tqlBhtnGiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==170)
				$data[$i-2]['tqlBhtnldGiam'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==176)
				$data[$i-2]['_ps_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==203)
				$data[$i-2]['_ps_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==19)
				$data[$i-2]['_ps_yt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==20)
				$data[$i-2]['_ps_tn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==139)
				$data[$i-2]['_ps_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==120)
				$data[$i-2]['tongBhCk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==184)
				$data[$i-2]['_pst_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==211)
				$data[$i-2]['_pst_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==84)
				$data[$i-2]['_pst_yt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==86)
				$data[$i-2]['_pst_tn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==150)
				$data[$i-2]['_pst_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==185)
				$data[$i-2]['_psg_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==212)
				$data[$i-2]['_psg_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==85)
				$data[$i-2]['_psg_yt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==87)
				$data[$i-2]['_psg_tn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==151)
				$data[$i-2]['_psg_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==177)
				$data[$i-2]['_bst_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==204)
				$data[$i-2]['_bst_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==22)
				$data[$i-2]['_bst_yt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==23)
				$data[$i-2]['_bst_tn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==140)
				$data[$i-2]['_bst_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==178)
				$data[$i-2]['_bsg_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==205)
				$data[$i-2]['_bsg_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==25)
				$data[$i-2]['_bsg_yt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==26)
				$data[$i-2]['_bsg_tn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==141)
				$data[$i-2]['_bsg_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==189)
				$data[$i-2]['_tientlOdts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==216)
				$data[$i-2]['_tientlHttt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==92)
				$data[$i-2]['_tientlyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==93)
				$data[$i-2]['_tientltn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==155)
				$data[$i-2]['_tientlBhtnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==88)
				$data[$i-2]['_lsbh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==89)
				$data[$i-2]['_lsyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==190)
				$data[$i-2]['_lai6_ps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==217)
				$data[$i-2]['_lai7_ps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==95)
				$data[$i-2]['_lai2_ps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==96)
				$data[$i-2]['_lai3_ps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==156)
				$data[$i-2]['_lai5_ps'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==60)
				$data[$i-2]['_laiqh'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==193)
				$data[$i-2]['_dt_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==220)
				$data[$i-2]['_dt_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==57)
				$data[$i-2]['_dt_bhyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==58)
				$data[$i-2]['_dt_bhtn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==159)
				$data[$i-2]['_dt_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==195)
				$data[$i-2]['ck_odts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==222)
				$data[$i-2]['ck_httt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==66)
				$data[$i-2]['_ck_bhyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==67)
				$data[$i-2]['_ck_bhtn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==161)
				$data[$i-2]['ck_bhtnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==196)
				$data[$i-2]['sldOdts'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==223)
				$data[$i-2]['sldHttt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==109)
				$data[$i-2]['sldBhytCk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==35)
				$data[$i-2]['sldtn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==162)
				$data[$i-2]['sldTnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==194)
				$data[$i-2]['_ck_lai6'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==221)
				$data[$i-2]['_ck_lai7'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==104)
				$data[$i-2]['_ck_lai2'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==105)
				$data[$i-2]['_ck_lai3'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==213)
				$data[$i-2]['sldHttt_dk'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==160)
				$data[$i-2]['_ck_lai5'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==153)
				$data[$i-2]['_dk_tnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==69)
				$data[$i-2]['_tien_ck'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==68)
				$data[$i-2]['_ck_lai'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==45)
				$data[$i-2]['tyleno'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==46)
				$data[$i-2]['tylenotn'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==108)
				$data[$i-2]['tylenoyt'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			if($j==145)
				$data[$i-2]['tylenotnld'] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
			
		}
		
	}
	$db= new Database();
	$db->connect();
	//echo $db.error();
	//$table='c12';
	//print_r($data());
	foreach($data as $key=>$value){
		$db->insert('c12',$value);
	}
	$sqlxoaps="DELETE FROM `c12` WHERE `thangps` not like '%2020%'";
	$db->query($sqlxoaps);
	$db->query("UPDATE `c12` SET `ngayps`= concat(left(`ThangPS`,4),'-', RIGHT(`ThangPS`,2),'-01')");
	return $db->error();
}
?>
