<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function load_c12(){
            	//alert("load C12");
                $.ajax({
                    url : "controllers/tracuuc12aj.php",
                    type : "POST",
                    dataType:"text",
                    data : {
                         
						 cqql : $("select[name='cqql']").val(),	
						 madvi : $("input[name='madvi']").val(),
						 thangps : $("select[name='thangps']").val()
                    },
                    success : function (result){
						$('#resultc12').html(result);
                        //$('#result').html(result);
                    }
                });
            }
			
        </script>
<?php
require_once 'database.php';
$db= new Database();
$db->connect();
$sql3="select * from dmdv where madvi like '".$_SESSION['user']."'";
$ttdv=$db->query($sql3);
?>

<div class='container-fluid ftim'>
	<div class='row' >
		
	
		<div class="col-12 text-left">
			<label class="info">Thông tin đơn vị : <?php echo $ttdv[0][2]; ?></label>
		</div>
		
		
		<div class="col-lg-4 col-sm-12 col-md-4">
			<input class="hidden" type=input name='madvi' id='madvi' value="<?php echo $ttdv[0][1]; ?>" />  
			<label>Chọn tháng phát sinh</label> <select class="thangps" name="thangps" id="thangps">
			<?php
				$sql2="SELECT DISTINCT(`thangps`) FROM `c12` ORDER BY `ThangPS` DESC";
				$ds=$db->query($sql2);
				if(isset($ds)){
					foreach($ds as $d){
						$t=substr($d['thangps'],5,2);
						if($t<10) $t="0".$t;
					echo "<option >".$t."/".substr($d['thangps'],0,4)."</option>";
					}		
				}
			?>
			</select>
		</div>
		<div class="col-lg-8 col-sm-12 col-md-6">
			<label>Chọn cơ quan BHXH quản lý</label> <select class="maql" name="cqql" id="cqql">
			<option id=0> Tất cả </option>
			<?php
				$sql1="select * from cqbhxh";
				$dm=$db->query($sql1);
				if(isset($dm)){
					foreach($dm as $d){
					echo "<option >".$d['macqql']."-".$d['tencqql']."</option>";
					}		
				}
			?>
			</select>
			<input class="btn btn-primary" type="button" value="Tra cứu C12"  name="tracuu" id="tracuu" onClick="load_c12()"/>
		</div>
		
		
	</div>
</div>
<div class="container-fluid padding" id="resultc12"></div>