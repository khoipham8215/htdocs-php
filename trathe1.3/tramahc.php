<style>

</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
	function timmaHC(){
		$("#loadmss").fadeIn();
		$('body').append('<div id="over">');
		$("#over").fadeIn();
		$.ajax({
			
			url:"timdmhc.php",
			type:"POST",
			dataType: "text",
			data:{
				dmhc: $("#txthc").val()
			},
			success:function(response){
				$("#over").fadeOut();
				$("#loadmss").fadeOut();
				$("#dmhc").html(response);}
		});
	
	//alert(resultdt);
	}
</script>
<body>
<div class="wrap1" >
	<div class="content1">
		<label>Tìm mã danh mục hành chính ( dữ liệu phải đủ 4 phần: <br/>thôn, xã, huyện, tỉnh phân cách bởi dấu , hoặc - )</label><br/>
		<textarea  id ="txthc" name="txthc" class="txthc" rows="30" cols="60" > </textarea>
		<div id="tachthx"> </div>
		<Button name="timmahc" onClick="timmaHC()" value="Kiểm tra" >Tìm mã DM hành chính</Button>
		<div id="dmhc"> </div>
	</div>
</div>

</body>