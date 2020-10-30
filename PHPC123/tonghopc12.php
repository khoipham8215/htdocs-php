        <script language="javascript">
            function load_thc12(){
				//alert("Tu ngay :" + $('#datepicker').val());
                $.ajax({
                    url : "tracuuc12ajth.php",
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
			function madvichangeth(obj){
				value=obj.value;
				if(value.length!=7){
					$("#tracuu").addClass('hidden');
					//$("#tracuu").onClick=null;
					alert("Mã đơn vị gồm 7 kí tự vd: 'TA0100A', bạn vui lòng nhập lại chính xác, mã bạn nhập : " + value);
				}else
					//$("#tracuu").onClick=null;
					$("#tracuu").removeClass('hidden');
				//$("input[name='cqchon']").val()=value;
				//alert($("select[name='cqql']").val())
				//alert(value);
				//alert($("input[name='file']").val());
			}
			
			
        </script>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'database.php';
$db= new Database();
$db->connect();
?>
<style> 
	.tkq{
		margin:0;
		border-style:solid;
		border-color:#045FB4;
		border-width:1px;
		font-family:arial;
		font-size:0.8em;
		
	}
	.ttr th{
		background-color:#045FB4;
		font-family:arial;
		font-size:1.4em;
		color:white;
		height:30px;
		padding:5px;
	}
	.ttd td{
		margin:0;
		border-width:1px;
		border-style:solid;
		border-color:#848484;
		font-family:helvetica;
		font-size:1.2em;
		color:black;
		padding:2px;
	}
	.ttdt td{
		background-color:#045FB4;
		font-family:arial;
		font-size:1.4em;
		color:white;
		height:30px;
		padding:5px;
	}
	.ttd{
		margin:0;
	}
	.dkq{
		margin-top:40px;
		padding:5px;
		background-color:#E6E6E6;
	}
	.fth{
		background-color:#045FB4;
		padding:5px;
		height:40px;
	}
	.fth input{
		width:150px;
		height:30px;
		float:left;
		margin-left:20px;
	}
	.fth select{
		width:250px;
	}
	
	.fth label{
		
		color:white;
		font-family:arial;
		font-size:1.2em;
		float:left;
		margin-left:20px;
	}
	p.kqt {
		font-size:1.2em;
		font-weight:bold;
		color:#045FB4;
	}
	a{
		font-size:1.2em;
		margin:auto;
		margin-top:10px;
		font-weight:bold;
		
	}
	.hidden{
		display:none;
	}
	
	
</style>
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
<div class='fth'>

<b><label>Nhập vào mã đơn vị</label></b>
<input type=input name='madvith' id='madvith' onchange="madvichangeth(this)"  /> 
<label onclick="layngay()">Từ ngày :</label> <input type="text" id='datepicker' />

<label >Đến ngày :</label> <input type="text" id='datepickerdn' />

<input type="button" value="Tổng hợp C12"  name="tracuuth" id="tracuuth" onClick="load_thc12()"/>

</div>

<?php

?>
<div id="resultthc12">

</div>