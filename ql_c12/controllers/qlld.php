<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
			function kiemtrasdt(obj){
				mobie=obj.value;
				var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
				if(mobie.length !== 0) {
					if(vnf_regex.test(mobie)==false){
						alert("Số điện thoại không đúng định dạng, số điện thoại phải là số di động gồm 10 số !");
						obj.value="";
					}//else alert("Số điện thoại hợp lệ !");
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
							alert("Cập nhật thành công !")
							//$('#result').html(result);
						}
					});
					
				}
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
							//alert(result);
							window.location="index.php?controller=qldsdn";
							//$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
				}
			}
			
</script>

<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
	if(!empty($_SESSION['user'])){
		$sql1="SELECT * FROM dsld WHERE madvi like '".$_SESSION['user']."'";
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		if(isset($kq)){
			$stt=1;
			echo "<div class='container-fluid kqt'>Lưu ý số điện thoại phải là số di động, gồm 10 chữ số và bắt đầu bằng 09 08 07 05 03 !</div>";
			echo "<div class='container-fluid tbhs'><table class='table table-hover'><tr class='ttr'><th>STT</th><th>Mã đơn vị</th><th>Số sổ BHXH</th><th>Mã thẻ BHYT</th><th>Mã nơi KCB</th><th>Họ tên</th><th>Ngày Sinh</th><th>Giới tính</th><th>Mức Lương</th><th>Hệ số lương</th><th>Số CMND</th><th>Số điện thoại</th><th>Cập nhật số điện thoại</th></tr>";
		foreach($kq as $k){
			echo "<tr><td>".$stt."</td><td>".$k['maDvi']."</td><td>".$k['soBhxh']."</td><td>".$k['soKcb']."</td><td>".$k['maBv']."</td><td>".$k['hoTen']."</td><td>".$k['ngaySinh']."</td><td>".$k['gioiTinh']."</td><td>".$k['mucLuong']."</td><td>".$k['heSoLuong']."</td><td>".$k['soCmnd']."</td><td>".$k['soDienThoai']."</td><td><input class='sdt' name='".$k['soBhxh']."' type='text' onchange='kiemtrasdt(this)' /></td></tr>";
			$stt++;
			}
		echo "</table><button type='button' name='btnupdate' class='btn btn-info btsdt' onClick='cnsdt()'>Cập nhật số điện thoại</button><button type='button'  class='btn btn-success btsdt' onClick='cndsdn()'>Gửi danh sách đề nghị bổ sung số điện thoại</button><a href='index.php?controller=qldsdn' class='btn btn-info' role='button'>Xem danh sách đề nghị</a> <input class='hidden madvi' value='".$k['maDvi']."' type='text'/><input class='hidden sld' value='".($stt-1)."' type='text'/></div>";
		}else echo "<div class='qldv'> Đơn vị chưa cập nhật danh sách lao động </div>";
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div class="container-fluid kqt" id="resultp"></div><br/><br/><br/><br/>
