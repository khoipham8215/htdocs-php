<style>

.tbhs{
	border-collapse: separate;
	border-spacing:0;
	border:1px solid #ebebeb;
	padding:5px;
	margin-top:55px;
	
	overflow:auto;

}
.tbhs th{
	background-color:#337ab7;
	color :white;
	padding:2px;
	border:1px solid;
	font-size:20px;
}
.tbhs td{
	border:1px solid #ebebeb;
	padding:2px;
	
}
.qldv{
	margin-top:55px;
	color:red;
	font-size:20px;
}
.btsdt{
	font-size:20px;
}
.madvi,.sld{
	display:none;
}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
			function kiemtrasdt(obj){
				mobie=obj.value;
				var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
				if(mobie.length !== 0) {
					if(vnf_regex.test(mobie)==false){
						alert("Số điện thoại không đúng định dạng, số điện thoại phải là số di động gồm 10 số !");
						obj.value="";
					}else alert("Số điện thoại hợp lệ !");
					//obj.value="Vui lòng nhập lại";
				}else alert("Bạn chưa nhập số điện thoại !");
			}
            function cnsdt(){
				//alert($(this).val());
				var sdt="";
				//var sobhxh=$("input[name='sdt']").name;
				$('.sdt').each(function(){
					//alert($(this).val());
					//var sobhxh=$('.sobhxh')[0].val();
					if($(this).val()!="")
					sdt+=$(this).val()+"#"+$(this).prop('name')+"\n";
				});
				if(sdt==""){alert("Bạn chưa nhập đủ thông tin !");
				 
				}else{
					//alert("Bạn đã nhập "+sdt);
					$.ajax({
						url : "controllers/cnsdtaj.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 sdt : sdt							
						},
						success : function (result){
							//alert(result);
							$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
					
				}
            }
			function cnmk(){
					window.location="index.php?controller=doipass";
			}
			function cndsdn(){
				var t= confirm("Xác nhận gửi danh sách cập nhật số điện thoại cho người lao động !");
				if(t){
					//alert("Cập nhật thành công !");
					$.ajax({
						url : "controllers/cndsdnaj.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 madvi : $('.madvi').val(),
							 sld   : $('.sld').val()
						},
						success : function (result){
							alert(result);
							//$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
				}
			}
			function duyetds(obj){
				//alert(obj.name);
				$.ajax({
						url : "duyetds.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 madvi : obj.name,
							 duyet : 1
						},
						success : function (result){
							alert(result);
							window.location="index.php?controller=qldsdn";
							//$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
			}
			function tuchoids(obj){
				//alert(obj.name);
				$.ajax({
						url : "duyetds.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 madvi : obj.name,
							 duyet : 2
						},
						success : function (result){
							alert(result);
							window.location="index.php?controller=qldsdn";
							//$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
			}
			function xuatds(obj){
				//alert(obj.name);
				$.ajax({
						url : "xuatdshcaj.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 madvi : obj.name,
							 duyet : 3
						},
						success : function (result){
							//alert(result);
							//$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
			}
			
</script>

<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
	if(!empty($_SESSION['user'])){
		$sql1="SELECT * FROM denghi";
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		if(isset($kq)){
			$stt=1;
			$tt="";
			
			echo "<table class='table tab-content tbhs'><tr><th>STT</th><th>Mã đơn vị</th><th>Số lao động</th><th>Ngày đề nghị</th><th>Người đề nghị</th><th>Trạng thái</th><th>Lần đề nghị</th><th>Duyệt</th><th>Từ chối</th><th>Xuất danh sách CNSĐT</th></tr>";
		foreach($kq as $k){
			if($k['trangthai']==0){
				$tt="Đang đề nghị"; 
			}else if($k['trangthai']==1){$tt="Đã duyệt";}else  $tt="Từ chối, đề nghị bổ sung";
			echo "<tr><td>".$stt."</td><td>".$k['madvi']."</td><td>".$k['sld']."</td><td>".$k['ngaydn']."</td><td>".$k['nguoidn']."</td><td style='color:blue'><b>".$tt."</b></td><td>".$k['landn']."</td><td><button class='btn btn-info duyet' name='".$k['madvi']."' onclick='duyetds(this)'>Duyệt</button></td><td><button name='".$k['madvi']."' onclick='tuchoids(this)' class='btn btn-info'>Từ chối</button></td><td><form action='xuatdshcaj.php' method='post' target='_blank'><button class='btn btn-info' name='".$k['madvi']."' type='submit'>Xuất danh sách</button><input name='madvi' type='text' class='madvi' value='".$k['madvi']."' /></form></td></tr>";
			$stt++;
			}
		echo "</table>";
		}else echo "<div class='qldv'> Đơn vị chưa có đề nghị </div>";
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>

