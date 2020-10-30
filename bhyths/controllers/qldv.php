
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function cntt(){
				var diachi=$("input[name='diachi']").val();
				var sdt=$("input[name='sdt']").val();
				var email=$("input[name='email']").val();
				var nguoilh=$("input[name='nguoilh']").val();
				if(diachi=="" || sdt=="" || email=="" || nguoilh=="" ){alert("Bạn chưa nhập đủ thông tin !");
				 
				}else{
					$.ajax({
						url : "controllers/qldvaj.php",
						type : "POST",
						dataType:"text",
						data : {
							 
							 diachi : $("input[name='diachi']").val(),	
							 sdt : $("input[name='sdt']").val(),
							 email : $("input[name='email']").val(),
							 nguoilh : $("input[name='nguoilh']").val(),
							 user : $("input[name='user']").val()
						},
						success : function (result){
							$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
					
				}
            }
			function cnmk(){
					window.location="index.php?controller=doipass";
			}
			function bssdt(){
					window.location="index.php?controller=qlld";
			}
			
</script>

<?php
require_once("database.php");
$db= new Database();
$db->connect();
	if(!empty($_SESSION['user'])){
		$sql1="SELECT * FROM DMDV WHERE madvi like '".$_SESSION['user']."'";
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		echo "<div class='container-fluid col-6 qldv'><table class='table tql'><tr><td colspan='2'><p class='kqt'> Đơn vị có thể cập nhật mới thông tin, đổi mật khẩu hoặc bổ sung số điện thoại cho người lao động ! </p></td></tr><tr><td>Tên đăng nhập  </td><td> ".$_SESSION['user']."</td></tr><td> Tên đơn vị </td><td> ".$kq[0]['Tendvi']."</td></tr><td> Mã số thuế </td><td> ".$kq[0]['MST']." </td></tr><td>Địa chỉ  </td><td><input type='text' name='diachi' value='".$kq[0]['Diachi']."' /> </td></tr><td>Điện thoại  </td><td><input type='text' name='sdt' value='".$kq[0]['Dienthoai']."' /> </td></tr><td>Email </td><td> <input type='text' name='email' value='".$kq[0]['Email']."' /></td></tr><td>Người liên hệ  </td><td><input type='text' name='nguoilh' value='".$kq[0]['nguoilh']."' /> </td></tr><tr><td colspan='2'> <input class='btn btn-outline-info bcn' type='button' name='update' value='Cập nhật thông tin' onClick='cntt()'/> </td></tr><tr><td colspan='2'> <input class='btn btn-outline-info bcn' type='button' name='update' value='Đổi mật khẩu' onClick='cnmk()'/> </td></tr><tr><td colspan='2'> <input class='btn btn-outline-info bcn' type='button' name='update' value='Đề nghị bổ sung số điện thoại' onClick='bssdt()'/> </td></tr></table><input type ='text' class='hidden' name='user' value=".$_SESSION['user']." /></div>";
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div class="container-fluid col-6 kqt" id="resultp"> </div>