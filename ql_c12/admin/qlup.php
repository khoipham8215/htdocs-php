<style type="text/css">
#loadmss{
	text-align:center;
	position:absolute;
	top:300px;
	right:50%;
	display:none;
	z-index:999;
	border:2px solid #337AB7;
	width:300px;
	height:auto;
	background-color:white;
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
</style>
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
?>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function load_ajaxip(obj){
				alert("Xác nhận lưu :"+obj.value);
				$("#loadmss").fadeIn();
				$('body').append('<div id="over">');
				$("#over").fadeIn();
                $.ajax({
					
                    url : "loadajax_import_c12_full.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 maql : obj.value,
						 file : $("input[name='fileip']").val()
                    },
                    success : function (result){
						//$(".demo").easyOverlay("stop");
						$("#over").fadeOut();
						$("#loadmss").fadeOut();
						$('#resultimp').html(result);
                        //$('#result').html(result);
                    }
					//$(".demo").easyOverlay("start");
                });
            }
			
        </script>
		
<?php
//$dir = "uploads/";
//$result = scandir($path);
//$files=array_diff($result,array('.','..'));
//echo "Danh sách file trong thư mục uploads :".var_dump($files);
//outputFiles($dir);
/**
function outputFiles($path){
	if(file_exists($path) && is_dir($path)){
		// Quét tất cả file trong thư mục
		result=scandir($path);
		// Lọc ra thư mục hiện tại (.) và thư mục cha (..)
		$files=array_diff($result,array('.','..'));
		if(count($files)>0){
			// lặp qua mảng trả lại
			foreach($files as $f){
				if(is_file("$path/$f")){
					// hien thi file
					echo $f."<br/>";
				}else if(is_dir("$path/$f")){
					// goi de quy ham neu tim thay thu muc
					outputFiles("$path/$f");
				}
			}
		} echo "Error : Không có file nào trong thư mục";
		
	} echo " Error : Thư mục không tồn tại";
}
function outputFiles1($path){
    // Kiểm tra thư mục có tồn tại hay không
    if(file_exists($path) && is_dir($path)){
        // Quét tất cả các file trong thư mục
        $result = scandir($path);
        
        // Lọc ra các thư mục hiện tại (.) và các thư mục cha (..)
        $files = array_diff($result, array('.', '..'));
        
        if(count($files) > 0){
            // Lặp qua mảng đã trả lại
            foreach($files as $file){
                if(is_file("$path/$file")){
                    // Hiển thị tên File
                    echo $file . "<br>";
                } else if(is_dir("$path/$file")){
                    // Gọi đệ quy hàm nếu tìm thấy thư mục
                    outputFiles("$path/$file");
                }
            }
        } else{
            echo "ERROR: Không có file nào trong thư mục.";
        }
    } else {
        echo "ERROR: Thư mục không tồn tại.";
    }
}
 */
?>
<body>
<div class="col-4 " id="loadmss">
	<div class="loadtd">Trạng thái </div>
	<div class="loadtb">Đang xử lý vui lòng đợi trong giây lát...</div>
	<div class="loadimg"><img src="../img/load1.gif" /></div>
</div>
<div class="container-fluid ftim">
    <form class="ftk" id="form_upload" method="POST" >
        <label>Danh sách file trong thư mục uploads </label>
		<select name="file" id="file">
		
		<?php 
		$path="uploads/";
		if(is_dir($path)){
			$result = scandir($path);
			foreach($result as $r){
				if(is_file("$path/$r")){
					echo '<option name="tenfile">'.$r.'</option>';
				}
			}
		}else echo "Không tồn tại thư mục".$path; 
		?>
	
		</select>
        <Button class="btn btn-info" type="submit" name="submit" >Đọc file</Button><br/>
    </form>
</div>
<?php

if (isset($_POST['submit'])) {
	$target_dir = "uploads/";
	$file = $target_dir . $_POST['file'];
	
	//$file = substr($target_file,0,strlen($target_file));
	
	//$file=$target_file;
	$objFile=PHPExcel_IOFactory::identify($file);
	$objData=PHPExcel_IOFactory::createReader($objFile);
	// Đọc ds các sheet
	$listSheet=$objData->listWorkSheetNames($file);
	//print_r($listSheet);
	echo "<div class='container-fluid ftim dl'>";
	echo "Đang đọc ".$file."<br>";
	$i=0;
	foreach($listSheet as $ls){
		echo "<input class='hidden' type='text' name='cqql' value='".$ls."-".$i."'/>"; 
		echo "<Button class='btn btn-info btluu' type='button' name='btluu' onclick='load_ajaxip(this)' value='".$ls."-".$i."'>Lưu dữ liệu : ".$ls."</Button>&nbsp;&nbsp;";
		$i++;
		
	}
	
	//echo "</Select>";
	echo "<input type='text' class='hidden' name='fileip' value=".$file."/>";
	echo "<br/><br/></div>";

}
?>
<div id="resultimp" class='container-fluid kqt'>

</div>

</body>