<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
	if(!empty($_SESSION['user'])){
		$sql1="SELECT * FROM denghi WHERE madvi like '".$_SESSION['user']."'";
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		if(isset($kq)){
			$stt=1;
			$tt="";
			
			echo "<div class='container-fluid col-12 tbhs'>Danh sách lao động đề nghị cập nhật số điện thoại<table class='table table-hover'><tr class='ttr'><th>STT</th><th>Mã đơn vị</th><th>Số lao động</th><th>Ngày đề nghị</th><th>Người đề nghị</th><th>Trạng thái</th><th>Lần đề nghị</th></tr>";
		foreach($kq as $k){
			if($k['trangthai']==0){
				$tt="Đang đề nghị"; 
			}else if($k['trangthai']==1){$tt="Đã duyệt";}else  $tt="Từ chối, đề nghị bổ sung";
			echo "<tr><td>".$stt."</td><td>".$k['madvi']."</td><td>".$k['sld']."</td><td>".$k['ngaydn']."</td><td>".$k['nguoidn']."</td><td><b>".$tt."</b></td><td>".$k['landn']."</td></tr>";
			$stt++;
			}
		echo "</table></div>";
		}else echo "<div class='container-fluid kqt'> Đơn vị chưa có đề nghị </div>";
	}else echo "<div class='container-fluid kqt'> Bạn chưa đăng nhập </div>";
?>

