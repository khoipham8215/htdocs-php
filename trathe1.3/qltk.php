<style>
.qldv{
	margin-top:50px;
	background-color:#f2f2f2;
	padding:10px;
	font-size:20px;
	width:50%;
	
}
.qldv input{
	font-size:20px;
	width:100%;
}
.user{
	display:none;
}
#resultp{
	font-size:20px;
	color:red;
}
.qldv table,tr,td{
	font-size:20px;
	padding:5px;
	color:blue;
}
.tql{
	
	border-collapse: separate;
	border-spacing:0;
	width:100%;
}
.bcn{
	background-color:#045fb4;
	color:white;
	padding:4px;
}
.bcn:hover{
	background-color:#4CAF50;
	color:white;
	padding:4px;
}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function cntt(){
				var sdt=$("input[name='sdt']").val();
				var email=$("input[name='email']").val();
				if(sdt=="" || email==""){alert("Bạn chưa nhập đủ thông tin !");
				 
				}else{
					$.ajax({
						url : "qldvaj.php",
						type : "POST",
						dataType:"text",
						data : {
							 
							 
							 sdt : $("input[name='sdt']").val(),
							 email : $("input[name='email']").val(),
							 hoten : $("input[name='hoten']").val(),
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
			
</script>

<?php
require_once("database.php");
$db= new Database();
$db->connect();
	if(!empty($_SESSION['user'])){
		$sql1="SELECT * FROM login WHERE user like '".$_SESSION['user']."'";
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		echo "<div class='qldv'><table class='tql'><tr><td>Tên đăng nhập  </td><td> ".$_SESSION['user']."</td></tr><tr><td>Họ Tên  </td><td> <input type='text' name='hoten' value='".$kq[0]['hoten']."' /></td></tr><tr><td>Điện thoại  </td><td><input type='text' name='sdt' value='".$kq[0]['sdt']."' /> </td></tr><tr><td>Email </td><td> <input type='text' name='email' value='".$kq[0]['email']."' /></td></tr><tr><td colspan='2'> <input class='bcn' type='button' name='update' value='Cập nhật thông tin' onClick='cntt()'/> </td></tr><tr><td colspan='2'> <input class='bcn' type='button' name='update' value='Đổi mật khẩu' onClick='cnmk()'/> </td></tr></table><input type ='text' class='user' name='user' value=".$_SESSION['user']." /></div>";
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div id="resultp"> </div>