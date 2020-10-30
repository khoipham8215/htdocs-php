<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="css/style1.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style> 
	#fth{
		background-color:#045FB4;
		padding:5px;
		border:1px solid red;
		display:block;
		height:150px;
		
	}
	#fth input{
		width:150px;
		height:30px;
		float:left;
		margin-left:20px;
	}
	#fth select{
		width:250px;
	}
	
	#fth label{
		
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
					$("#tracuuth").addClass('hidden');
					//$("#tracuu").onClick=null;
					alert("Mã đơn vị gồm 7 kí tự vd: 'TA0100A', bạn vui lòng nhập lại chính xác, mã bạn nhập : " + value);
				}else
					//$("#tracuu").onClick=null;
					$("#tracuuth").removeClass('hidden');
				//$("input[name='cqchon']").val()=value;
				//alert($("select[name='cqql']").val())
				//alert(value);
				//alert($("input[name='file']").val());
			}
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
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'database.php';
$db= new Database();
$db->connect();
?>

  <script>
 
  </script>
<div id='fth'>

<b><label>Nhập vào mã đơn vị</label></b>
<input type=input name='madvith' id='madvith' onchange="madvichangeth(this)"  /> 
<label onclick="layngay()">Từ ngày :</label> <input type="text" id='datepicker' />

<label >Đến ngày :</label> <input type="text" id='datepickerdn' />

<input type="button" value="Tổng hợp C12"  name="tracuuth" id="tracuuth" onClick="load_thc12()"/>

</div>

<div id="resultthc12">

</div>
