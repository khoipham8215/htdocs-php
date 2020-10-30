<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function doipass(){
				var pwdc=$("input[name='pwdc']").val();
				var pwdm=$("input[name='pwdm']").val();
				if(pwdc=="" || pwdm==""){alert("Bạn chưa nhập đủ thông tin !");
				 
				}else{
					if(pwdc==pwdm){ alert("Mật khẩu cũ và mới giống nhau !");
					
					}else{
					$.ajax({
						url : "controllers/doipassaj.php",
						type : "POST",
						dataType:"text",
						data : {
							 
							 user : $("input[name='user']").val(),	
							 pwdc : $("input[name='pwdc']").val(),
							 pwdm : $("input[name='pwdm']").val()
						},
						success : function (result){
							$('#resultp').html(result);
							//$('#result').html(result);
						}
					});
					
					}
            }
			}
</script>

<?php
require_once("database.php");
$db= new Database();
	
$db->connect();
	if(!empty($_SESSION['user'])){
		echo "<div class='container-fluid col-6 ftim'><p> Tên đăng nhập  : ".$_SESSION['user']."</p> <p> Mật khẩu cũ  &nbsp; : <input type ='password' name='pwdc' /> </p><p> Mật khẩu mới   : <input type ='password' name='pwdm' /> </p><p> <input type='button' name='update' value='Đổi mật khẩu' onClick='doipass()'/> </p><input type ='text' class='hidden' name='user' value=".$_SESSION['user']." /></div>";
	}else echo "<div class='container-fluid col-6 kqt'> Bạn chưa đăng nhập </div>";
if($_GET['l']!=null){
		echo "<div class='container-fluid col-6 kqt'> Đây là lần đầu truy cập, vui lòng đổi mật khẩu mặc định để bảo vệ tài khoản !</div>";
	}
?>
<div class='container-fluid col-6 kqt' id="resultp"> </div>