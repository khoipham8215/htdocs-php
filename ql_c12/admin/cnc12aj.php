</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function xoaps(obj){
				alert("Xóa đợt" + obj.value + "thangps : " +  $("input[name='thangps']").val());
                $.ajax({
                    url : "xoaps.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 macqql : obj.value,	
						 thangps : $("input[name='thangps']").val()
                    },
                    success : function (result){
						$('#resultxoaps').html(result);
                        //$('#result').html(result);
                    }
                });
            }
</script>
<div class='fkq'>
<?php
require_once 'PHPExcel.php';
require_once 'database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$db=new Database();
$db->connect();
if(isset($_POST['thangps'])){
	//$macqql=substr($_POST['macqql'],1,4);
	$thangps=$_POST['thangps'];
	//$stt=1;
	$sql="SELECT `macqql`,`thangps`,`ngaycn`,count(`macqql`) as sldv FROM `c12` WHERE `thangps` like '".$thangps."' group by `macqql`";
	$kq=$db->query1($sql,MYSQLI_ASSOC);
	//echo $sql;
	if(isset($kq)){
		$stt=1;
		echo "<div class='container-fluid kqt'>Kết quả tra được </div>";
		echo "<table class='table tab-content tbhs'><tr><th>STT</th><th>Mã CQ BHXH</th><th>Tháng phát sinh</th><th>Số lượng đơn vị</th><th>Ngày cập nhật</th><th>Xóa đợt PS</th></tr>";
		foreach($kq as $k){
			echo "<tr><td>".$stt."</td><td>".$k['macqql']."</td><td>".$k['thangps']."</td><td>".$k['sldv']."</td><td>".$k['ngaycn']."</td><td><button class='btn btn-info' id ='xoaps' value='".$k['macqql']."' onclick='xoaps(this)'> Xóa phát sinh </button></td></tr>";
			$stt++;
		}
	}else echo "<label>Không tìm thấy </label>";
	echo "</table>";
	echo "<input name='thangps' type=text style='display:none' value='".$k['thangps']."' />";
}
?>
</div>
<div id="resultxoaps" class="container-fluid kqt"> </div>