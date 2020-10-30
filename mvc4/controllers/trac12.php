<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function load_c12(){
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
			function madvichange(obj){
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
require_once 'database.php';
$db= new Database();
$db->connect();
$sql3="select * from dmdv where madvi like '".$_SESSION['user']."'";
$ttdv=$db->query($sql3);
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
	.ttd{
		margin:0;
	}
	.dkq{
		margin-top:60px;
		padding:5px;
		background-color:#E6E6E6;
	}
	.ftk{
		background-color:#045FB4;
		padding:5px;
	}
	.ftk input{
		width:150px;
		height:30px;
	}
	.ftk select{
		width:250px;
		height:30px;
	}
	#thangps{
		width:100px;
		height:30px;
	}
	.ftk label{
		color:white;
		font-family:arial;
		font-size:1.2em;
	}
	p.kqt {
		font-size:1.2em;
		font-weight:bold;
		color:#045FB4;
	}
	a{
		font-size:1.2em;
		margin:auto;
		
	}
	.inc12 {
		background-color:#4caf50;
		color: white;
		text-decoration:none;
		padding:2px;
		font-size:1em;
		font-weight:bold;
		
	}
	.inc12:hover {
		background-color:#045FB4;
	}	

</style>
<div class='dkq'>
<div class='ftk'>
<form method="post">
<label class="info">Thông tin đơn vị : <?php echo $ttdv[0][2]; ?></label><br/>
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
<input type="button" value="Tra cứu C12"  name="tracuu" id="tracuu" onClick="load_c12()"/>

</form>
</div>
<div id="resultc12">

</div>