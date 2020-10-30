<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function kiemtrac12(){
                $.ajax({
                    url : "cnc12aj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 thangps : $("select[name='thangps']").val()
                    },
                    success : function (result){
						$('#resultktc12').html(result);
                        //$('#result').html(result);
                    }
                });
            }
</script>
<div class='ftk'>
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db=new Database();
$db->connect();
//$sql="SELECT * FROM `cqbhxh`";
$sql1="SELECT DISTINCT `thangps` FROM `c12` ORDER BY `ThangPS` DESC";
//$kq=$db->query1($sql,MYSQLI_ASSOC);
$kq1=$db->query1($sql1,MYSQLI_ASSOC);
/**
if(isset($kq)){
	//$stt=1;
	echo "<label>Chọn cơ quan BHXH </label><select name='macqql' >";
	foreach($kq as $k){
		echo "<option name='macqql' value='".$k['macqql']."' >".$k['macqql'].'-'.$k['tencqql']."</option>";
		//$stt++;
	}
}
?>
</select>
 */

if(isset($kq1)){
	//$stt=1;
	echo "<div class='container-fluid ftim'> Chọn tháng phát sinh </label><select name='thangps' >";
	foreach($kq1 as $k){
		echo "<option name='thangps' value='".$k['thangps']."' >".$k['thangps']."</option>";
		//$stt++;
	}
}
?>
</select>
<button id="tracuu" onclick="kiemtrac12()" class="btn btn-primary" >Kiểm tra dữ liệu</button>
</div>
<div id="resultktc12"></div>