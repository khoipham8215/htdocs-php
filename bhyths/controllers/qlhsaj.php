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
            function cnlop(){
				//alert($(this).val());
				var sdt="";
				//var sobhxh=$("input[name='sdt']").name;
				$('.malop').each(function(){
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
			function chonhet(){
				//alert(" Bạn muốn chọn hết "+$('.rahs').val() + $('.rhs').checked);
				var b=$('.rahs').checked;
				$('.rhs').each( function(){
					if(b){
						//alert($(this).val());
						//alert("Đã checked");
						$(this).attr('checked',b);
					}else {
						//alert("Chưa checked");
						//alert($(this).val());
						//$(this).checked;
						$(this).attr('checked',!b);

				}
				});
			}
			function chon(obj){
				alert(obj.value);
			}
			
</script>

<?php
require_once("database.php");
$db= new Database();
$db->connect();
session_start();
$lop=$_POST['lop'];
//echo strlen($lop);
//$lop=str_replace('/','\/',$lop);
//echo $lop;

	if(!empty($_SESSION['user'])){
	//if(isset($lop)){
		if(isset($lop)){ 
			if($lop=='Tất cả học sinh'){
				$pb="";
			}else
			$pb=" AND maPb like'".$lop."'";}
		$sql1="SELECT * FROM dsld WHERE madvi like '".$_SESSION['user']."'".$pb;
		//echo $sql1;
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		if(isset($kq)){
			$stt=1;
			echo "<div class='container-fluid kqt'>Danh sách học sinh đang tham gia BHYT lớp :".$lop."</div>";
			echo "<div class='container-fluid tbhs'><table class='table table-hover'><tr class='ttr'><th>Chọn hết<br><input type='checkbox' class='rahs' onClick='chonhet()'/></th><th>STT</th><th>Mã đơn vị</th><th>Số sổ BHXH</th><th>Mã thẻ BHYT</th><th>Mã nơi KCB</th><th>Họ tên</th><th>Ngày Sinh</th><th>Giới tính</th><th>Mức Lương</th><th>Hệ số lương</th><th>Số CMND</th><th>Lớp</th><th>Cập nhật lớp</th></tr>";
		foreach($kq as $k){
			echo "<tr><td><input type='checkbox' class='rhs' onchange='chon(this)'/></td><td>".$stt."</td><td>".$k['maDvi']."</td><td>".$k['soBhxh']."</td><td>".$k['soKcb']."</td><td>".$k['maBv']."</td><td>".$k['hoTen']."</td><td>".$k['ngaySinh']."</td><td>".$k['gioiTinh']."</td><td>".$k['mucLuong']."</td><td>".$k['heSoLuong']."</td><td>".$k['soCmnd']."</td><td>".$k['maPb']."</td><td><input class='malop' name='".$k['soBhxh']."' type='text'  /></td></tr>";
			$stt++;
			}
		echo "</table><button type='button' name='btnupdate' class='btn btn-info btsdt' onClick='cnlop()'>Cập nhật lớp</button><button type='button'  class='btn btn-success btsdt' onClick='cndsdn()'>Gửi danh sách đề nghị bổ sung số điện thoại</button><a href='index.php?controller=qldsdn' class='btn btn-info' role='button'>Xem danh sách đề nghị</a> <input class='hidden madvi' value='".$k['maDvi']."' type='text'/><input class='hidden sld' value='".($stt-1)."' type='text'/></div>";
		}else echo "<div class='qldv'> Không có học sinh của lớp này </div>";
	//}
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div class="container-fluid kqt" id="resultp"></div><br/><br/><br/><br/>
