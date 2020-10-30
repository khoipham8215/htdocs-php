<?php
require_once 'PHPExcel.php';
require_once 'database.php';
?>
<style> 
.wrap{
	width:80%;
	margin:auto;
	background-color:#73b473;
}
.menu{
	background-color:#00537c;
}
</style>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function load_ajax(obj){
				alert("Xác nhận lưu :"+obj.value);
                $.ajax({
					
                    url : "loadajax.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 maql : obj.value,
						 file : $("input[name='file']").val()
                    },
                    success : function (result){
						//$(".demo").easyOverlay("stop");
						$('#result').html(result);
                        //$('#result').html(result);
                    }
					//$(".demo").easyOverlay("start");
                });
            }
			function cqqlchange(obj){
				value=obj.value;
				//$("input[name='cqchon']").val()=value;
				//alert($("select[name='cqql']").val())
				//alert(value);
				//alert($("input[name='file']").val());
			}
			function loadtime(){
				alert("xin chao !");
				//$(".demo").easyOverlay("start");
			}
        </script>
		
<div class="wrap">
<div class="menu">
menu
</div>
<?php

?>
<div id="content">
Nội dung load
</div>
<div class='demo' onclick="loadtime()">Trạng thái ... </div>
</div>