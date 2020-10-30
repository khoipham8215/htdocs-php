
<?php 
/** function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f;
        sleep($seconds);
    }
}
*/
error_reporting(0);
require_once("PHPExcel.php");
function setInterval ( $func, $seconds ) 
{
      $seconds = (int)$seconds;
      $_func = $func;
      while ( true )
      {
            $_func;
            sleep($seconds);
      }
}
//session_start();
//$_SESSION['trang']=0;
//if(is_null($GLOBALS['trang'])){
//  $GLOBALS['trang']=0;
//}

$fileType = 'Excel2007';
// Tên file cần ghi
$fileName = 'D:/luudulieu.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($fileName);
$objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', "STT")
                            ->setCellValue('B1', "Mã số BHXH")
                            ->setCellValue('C1', "Họ tên")
                            ->setCellValue('D1', "Ngày Sinh")
                            ->setCellValue('E1', "Giới tính")
                            ->setCellValue('F1', "Mã hộ")
                            ->setCellValue('G1', "Số CMTND")
                            ->setCellValue('H1', "Số điện thoại")
                            ->setCellValue('I1', "Nơi khai sinh")
                            ->setCellValue('J1', "Ngày kê khai")
                            ->setCellValue('K1', "Người kê khai")
                            ->setCellValue('L1', "Người duyệt")
                            ->setCellValue('M1', "Ngày duyệt")
                            ->setCellValue('N1', "Trạng thái")
                            ->setCellValue('O1', "Lý do")
                            ->setCellValue('P1', "Lần đề nghị")
                            ->setCellValue('Q1', "Lỗi hồ sơ")
                            ->setCellValue('R1', "Lỗi trùng")
                            ->setCellValue('S1', "Quốc tịch")
                            ->setCellValue('T1', "Dân tộc")
                            ->setCellValue('U1', "Tổ Tỉnh")
                            ->setCellValue('V1', "Lý do Tỉnh")
                            ->setCellValue('W1', "Tổ TW")
                            ->setCellValue('X1', "Lý do TW");
                            

	if($_POST['dulieu']!=""){
    $st=$_POST['st'];
	 	$d= $_POST['dulieu'];
    $d=explode("\n", $d);
    //echo var_dump($d);
    $numRow=2+($st*10-10);
    for($i=0;$i<count($d);$i++){
        $col=explode("#", $d[$i]);
        
                              $objPHPExcel->getActiveSheet()->setCellValue('A'.$numRow, $col[0]);
                              $objPHPExcel->getActiveSheet()->setCellValue('B'.$numRow, $col[1]);
                              $objPHPExcel->getActiveSheet()->setCellValue('C'.$numRow, $col[2]);
                              $objPHPExcel->getActiveSheet()->setCellValue('D'.$numRow, $col[3]);
                              $objPHPExcel->getActiveSheet()->setCellValue('E'.$numRow, $col[4]);
                              $objPHPExcel->getActiveSheet()->setCellValue('F'.$numRow, $col[5]);
                              $objPHPExcel->getActiveSheet()->setCellValue('G'.$numRow, $col[6]);
                              $objPHPExcel->getActiveSheet()->setCellValue('H'.$numRow, $col[7]);
                              $objPHPExcel->getActiveSheet()->setCellValue('I'.$numRow, $col[8]);
                              $objPHPExcel->getActiveSheet()->setCellValue('J'.$numRow, $col[9]);
                              $objPHPExcel->getActiveSheet()->setCellValue('K'.$numRow, $col[10]);
                              $objPHPExcel->getActiveSheet()->setCellValue('L'.$numRow, $col[11]);
                              $objPHPExcel->getActiveSheet()->setCellValue('M'.$numRow, $col[12]);
                              $objPHPExcel->getActiveSheet()->setCellValue('N'.$numRow, $col[13]);
                              $objPHPExcel->getActiveSheet()->setCellValue('O'.$numRow, $col[14]);
                              $objPHPExcel->getActiveSheet()->setCellValue('P'.$numRow, $col[15]);
                              $objPHPExcel->getActiveSheet()->setCellValue('Q'.$numRow, $col[16]);
                              $objPHPExcel->getActiveSheet()->setCellValue('R'.$numRow, $col[17]);
                              $objPHPExcel->getActiveSheet()->setCellValue('S'.$numRow, $col[18]);
                              $objPHPExcel->getActiveSheet()->setCellValue('T'.$numRow, $col[19]);
                              $objPHPExcel->getActiveSheet()->setCellValue('U'.$numRow, $col[20]);
                              $objPHPExcel->getActiveSheet()->setCellValue('V'.$numRow, $col[21]);
                              $objPHPExcel->getActiveSheet()->setCellValue('W'.$numRow, $col[22]);
                              $objPHPExcel->getActiveSheet()->setCellValue('X'.$numRow, $col[23]);
      $numRow++;
      }
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
// Tiến hành ghi file
$objWriter->save($fileName);
    echo "Đã xuất dữ liệu sang php ! Trang ".$st;
    //$_SESSION['trang']+=10;
    //$GLOBALS['trang']+=10;
    //$st+=10;
	}else
		echo " Không nhận được dữ liệu !";


//setInterval(load(),1000);

//setInterval(hi(),1);
//load();
?>
