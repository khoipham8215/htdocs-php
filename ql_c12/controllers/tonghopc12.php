        <script language="javascript">
            function load_thc12(){
				//alert("Tu ngay :" + $('#datepicker').val());
                $.ajax({
                    url : "controllers/tracuuc12ajth.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 tungay : $('#datepicker').val(),
						 denngay : $('#datepickerdn').val(),
						 madvith : $("input[name='madvith']").val()
						 
                    },
                    success : function (result){
						$('#resultthc12').html(result);
                        //$('#result').html(result);
                    }
                });
            }
			
			
        </script>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'database.php';
$db= new Database();
$db->connect();
$sql3="select * from login where user like '".$_SESSION['user']."'";
$ttdv=$db->query1($sql3,MYSQLI_ASSOC);
?>
	
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $("#datepicker").datepicker();
	$( "#datepickerdn" ).datepicker();
  } );
  function layngay(){
	 value= $("#datepicker").val();
	 //value= Date.parse(value);
	 value=new Date(value);
	 //value= substring(value,4,2);
	alert(value.getDate() +"/"+ (value.getMonth()+1) + "/" + value.getFullYear());
	//$("#datepicker").innerhtml(value);
	//alert($("#datepicker").val($.format.date(new Date(), 'dd M yy')));
	//alert($('#datepicker').val());
	//alert($("#datepicker").val($.datepicker.formatDate('dd M yy', new Date())));
	
}
  </script>
<div class='container-fluid ftim'>
	<div class='row' >
		<div class="col-12 text-left">
			<label class="info">Thông tin đơn vị : <?php echo $ttdv[0]['Tendvi']; ?></label>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12">
			<input class="hidden" type=input name='madvith' id='madvith' onchange="madvichangeth(this)" value="<?php echo $ttdv[0]['user']; ?>"  /> 
			<label onclick="layngay()">Từ ngày :</label> <input type="text" id='datepicker' />

			<label >Đến ngày :</label> <input type="text" id='datepickerdn' />

			<input class="btn btn-info" type="button" value="Tổng hợp C12"  name="tracuuth" id="tracuuth" onClick="load_thc12()"/>
		</div>
	</div>
</div>
<div class="container-fluid padding" id="resultthc12">

</div>