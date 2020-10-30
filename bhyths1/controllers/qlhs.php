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
			function timhs(){
				//lop=$('.lop').val();
				//alert('Tìm học sinh theo lớp '+lop);
				$.ajax({
					url:"controllers/qlhsaj.php",
					type:"POST",
					dataType:"text",
					data:{
						lop:$('.lop').val()
					},
					success:function(result){
						//alert(lop);
						$('#resulths').html(result);
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
		$sql="SELECT DISTINCT `maPb` FROM `dsld` WHERE `maDvi` like '".$_SESSION['user']."' ORDER by `maPb`";
		$row=$db->query1($sql,MYSQLI_ASSOC);
		//echo $sql;
		if(isset($row)){
		echo "<div class='container-fluid ftim'><div class='row'><div class='col-3'>
			Chọn lớp <select custom-select name='lop' class='lop'>";
			echo "<option name='lop'>Tất cả học sinh</option>";
			foreach ($row as $r) {
				//$r['maPb']=str_replace('/', '.', $r['maPb']);
				echo "<option name='lop'>".$r['maPb']."</option>";
			}

		echo "</select></div><div class='col-3'><input class ='btn btn-primary' value='Tìm kiếm' type='button' onclick='timhs()' /></div></div></div>";
		}
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div class="container-fluid kqt" id="resulths"></div><br/><br/><br/><br/>
