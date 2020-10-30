<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function timso(){
            	//alert("load C12");
            	//alert("Sổ cần tìm " + $("input[name='sobhxh']").val());
                $.ajax({
                    url : "get.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 sobhxh : $("input[name='sobhxh']").val(),	
						 
                    },
                    success : function (result){
						$('#resultso').html(result);
                        //$('#result').html(result);
                    }
                });
            }
			
        </script>
<div class="container-fluid ftim">
	<input type="text" name="sobhxh" >
	<input type="button" class="btn btn-primary" name="btntim" value="Tìm ảnh Sổ BHXH" onclick="timso()">
</div>
<div class="container-fluid kqt anhso" id="resultso"></div>
