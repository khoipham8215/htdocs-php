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
				var b=$('.rahs').prop('checked');
				//alert(b);
				//location.reload();
				$('.rhs').each( function(){
					if(b){
						//alert($(this).val());
						//alert("Đã checked");
						$(this).attr('checked',true);
					}else {
						//alert("Chưa checked");
						//alert($(this).val());
						//$(this).checked;
						$(this).attr('checked',false);

				}
				});
			}
			
			function cnlop1(){
				
				//var tr=$('.tbhs tr').length;
				//alert("Số dòng là " + tr);
				var lop="";
				var i=0;
				var l=prompt("Nhập tên lớp !",'');
				if(l!=null){
				$('.rhs').each( function(){
					if($(this).prop('checked')){
						//alert("Bạn đã chọn " +$(this).val());
						lop+=l+"#"+$(this).val()+"\n";
						i++;
					}
				});
				if(lop!=""){

				//alert(lop);
				$.ajax({
						url : "controllers/cnlopaj.php",
						type : "POST",
						dataType:"text",
						data : {						 						 
							 lop : lop							
						},
						success : function (result){
							//alert(result);
							$('#resultp').html(result);
							alert("Cập nhật lớp thành công cho " +i + " học sinh !")
							//$('#result').html(result);
						}
				});
				}else {alert("Bạn chưa chọn học sinh !");}
				}else{
					alert("Hủy cập nhật lớp !");
				}
			}
			function setst12(){
				var b=confirm("Bạn chắc chắn muốn đặt lại số tháng =12 cho toàn bộ học sinh của trường !");
				if(b){
					alert("Đặt lại số tháng thành công !");
				}else{
					alert("Hủy đặt lại số tháng !");
				}
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
function adddotstring($strNum) {
        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter > 0)
        {
			//if(substr($result,0,1)=='-'){ $len=$len-1;}
            $con = substr($strNum, $len - $counter , 3);
            $result = ','.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        //if(substr($result,0,1)=='-'){
        //    $result='-'.substr($result,1,$len+1).":".$len;   
		//	return $result;
        //}
		//else
		if(substr($result,0,1)=='-' && $len==10){
			$result='-'.substr($result,2,$len+1); 
		}
		if(substr($result,0,1)=='-' and $len==7){
			$result='-'.substr($result,2,$len+1); 
		}
		if(substr($result,0,1)=='-' and $len==4){
			$result='-'.substr($result,2,$len+1); 
		}
        return $result;
		
}
	if(!empty($_SESSION['user'])){
	//if(isset($lop)){
		if(isset($lop)){ 
			if($lop=='Tất cả học sinh'){
				$pb=" ORDER by `maPb`";
			}else
			$pb=" AND maPb like'".$lop."'"." ORDER by `hoTen`";}
		$sql1="SELECT * FROM dsld WHERE madvi like '".$_SESSION['user']."'".$pb;
		//echo $sql1;
		$kq=$db->query1($sql1,MYSQLI_ASSOC);
		//print_r($kq);
		if(isset($kq)){
			$stt=1;
			echo "<div class='container-fluid kqt'>Danh sách học sinh đang tham gia BHYT lớp :".$lop." có ".count($kq)." học sinh <button class='btn btn-info' type='button' onClick='cnlop1()'>Cập nhật lớp</button><button class='btn btn-info' type='button' onClick='cnst()'>Cập nhật số tháng</button><button class='btn btn-info' type='button' onClick='setst12()'>Set số tháng=12</button><button class='btn btn-info' type='button' onClick='cnkcb()'>Cập nhật nơi KCB</button><button class='btn btn-primary' type='button' onClick='taoD03()'>Lập DS D03</button> <input class='hsfilter' type='text' id='myInputHS' placeholder='Lọc theo họ tên học sinh' title='Tìm theo họ tên học sinh' /></div>";
			echo "<div class='container-fluid tbhs'><table id='myTableHS' class='table table-hover'><tr class='ttr'><th>Chọn hết<br><input type='checkbox' class='rahs' onchange='chonhet()'/></th><th>STT</th><th>Mã đơn vị</th><th>Số sổ BHXH</th><th>Mã thẻ BHYT</th><th>Mã nơi KCB</th><th>Họ tên</th><th>Ngày Sinh</th><th>Giới tính</th><th>Mức Lương cơ sở</th><th>Lớp</th><th>Mức đóng</th><th>Số tháng</th><th>Từ ngày</th><th>Đến ngày</th><th>Địa chỉ</th></tr>";
		foreach($kq as $k){
			echo "<tr><td><input type='checkbox' class='rhs' onchange='chon(this)' value='".$k['soBhxh']."' /></td><td>".$stt."</td><td>".$k['maDvi']."</td><td>".$k['soBhxh']."</td><td>".$k['soKcb']."</td><td>".$k['maBv']."</td><td>".$k['hoTen']."</td><td>".$k['ngaySinh']."</td><td>".$k['gioiTinh']."</td><td>".adddotstring($k['mucLuong'])."</td><td>".$k['maPb']."</td><td>".adddotstring($k['mucLuong']*4.5/100*$k['soThang'])."</td><td>".$k['soThang']."</td><td>".$k['hanTheTu']."</td><td>".$k['hanTheDen']."</td><td>".$k['diaChiLh']."</td></tr>";
			$stt++;
			}
		echo "</table>";
		}else echo "<div class='qldv'> Không có học sinh của lớp này </div>";
	//}
	}else echo "<div class='qldv'> Bạn chưa đăng nhập </div>";
?>
<div class="container-fluid kqt" id="resultp"></div><br/><br/>
<script type="text/javascript">
	// tạo filter cho table học sinh
// lấy thẻ input
  var input = document.getElementById("myInputHS");
  //var inputns = document.getElementById("myInputNS");
  // định nghĩa hàm xử lý myFunction
  function myFunction() {
    var filter, table, tr, td, i;
    // lấy giá trị người dùng nhập
    filter = input.value.toUpperCase();
 
    // lấy phần bảng hiển thị kết quả
    table = document.getElementById("myTableHS");
    // lấy tất cả các thẻ tr
    tr = table.getElementsByTagName("tr");
 
    //Nếu filter không có giá trị ẩn các kết quả
    if (!filter) {
      table.style.display = "table";
    }else{
      // lặp qua tất cả các thẻ tr
      for (i = 0; i < tr.length; i++) {
        // lấy giá trị của thẻ td đầu tiên đại diện cho tên club
        td = tr[i].getElementsByTagName("td")[6];
        if (td) {
          // kiểm tra giá trị filter có tồn tại trong thẻ tr không
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            //nếu có hiển thị chúng
            table.style.display = "table";
            tr[i].style.display = "";
          } else {
            // nếu không ẩn chúng
            tr[i].style.display = "none";
          }
        }       
      }
    }
  }
 
  //gán sự kiện cho thẻ input
  input.addEventListener("keyup", myFunction);
  //inputns.addEventListener("keyup", myFunctionns);
</script>