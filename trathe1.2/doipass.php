<style>
.dpass{
	margin-top:50px;
	background-color:#f2f2f2;
	padding:10px;
	font-size:20px;
	
}
.dpass input{
	font-size:20px;
}
.user{
	display:none;
}
#resultp{
	font-size:20px;
	color:red;
}
.kq{
	font-size:30px;
	color:red;
}
</style>
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
						url : "doipassaj.php",
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
		echo "<br/><div class='dpass'><p> Tên đăng nhập  : ".$_SESSION['user']."</p> <p> Mật khẩu cũ  &nbsp; : <input type ='password' name='pwdc' /> </p><p> Mật khẩu mới   : <input type ='password' name='pwdm' /> </p><p> <input type='button' name='update' value='Đổi mật khẩu' onClick='doipass()'/> </p><input type ='text' class='user' name='user' value=".$_SESSION['user']." /></div>";
	}else echo "<div class='dpass'> Bạn chưa đăng nhập </div>";
if($_GET['l']!=null){
		echo "<p class='kq'> Đây là lần đầu truy cập, vui lòng đổi mật khẩu mặc định để bảo vệ tài khoản !</p>";
	}
?>
<div id="resultp"> </div>