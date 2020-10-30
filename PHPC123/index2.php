<style>
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    position: absolute;
}
 
.topnav {
    width: 100%;
    overflow: hidden;
    background-color: #333;
    position: fixed;
}
 
.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
}
 
.topnav a:hover {
    background-color: #ddd;
    color: black;
}
 
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
.wrap{
	border: 1px solid blue;
	display:block;
	float:left;
	margin:55px 20px;
	width:auto;
	background-color: #ddd;
}
.content{
	display:none;
	width:auto;
	height:auto;
	padding:20px;
	
}
.content Button{
	float:right;
	font-size:1.2em;
	margin-left:5px;
}
.content label{
	font-size:1.2em;
	margin-left:5px;
}
.cta{
	float:left;
	
	margin-right:30px;
}
.ctb{
	float:left;
	
	margin-right:30px;
}
.ctc{
	float:left;
	border:2px solid red;
	margin-right:30px;
	color:blue;
	padding:5px;
}
.ctd{
	float:left;
	border:2px solid red;
	margin-right:30px;
	color:blue;
	padding:5px;
}
#tachthx{
	float:left;
	border:1px solid blue;
	padding:2px;
}
#tachthx ul{
	list-style-type: decimal;
}
#txthc{
	float:left;
}
#dmhc table td{
	border:1px solid blue;
	margin:0;
}
#dmhc{
	float:left;
}
.ktt{
	color:red;
}
</style>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
 $(function(){
	var content=document.getElementsByClassName("content");
	content[0].style.display="block";
	content[0].fadeIn();
 });
 function loadTab(obj){
		
		var i;
		//var atab=document.getElementsByClassName("topnav a");
		var atab=document.getElementsByTagName("a");
		var content=document.getElementsByClassName("content");
		
		for(i=0;i<atab.length;i++)
		{
			atab[i].style.backgroundColor="#333";
			//alert(content[i].innerHTML);
			content[i].style.display="none";
			
		}
		
		obj.style.backgroundColor="#4CAF50";
		if(obj.innerHTML=="Tìm dữ liệu lệch"){
			content[1].style.display="block";
			content[1].fadeIn();
		}
		if(obj.innerHTML=="Tìm mã DM hành chính"){
			content[0].style.display="block";
			content[0].fadeIn();
		}
		if(obj.innerHTML=="Liên hệ"){
			content[2].style.display="block";
			content[2].fadeIn();
		}
		if(obj.innerHTML=="Giới thiệu"){
			content[3].style.display="block";
			content[3].fadeIn();
		}
	}
	function kiemtradl(){
		var txta=$("#txta").val();
		//alert(txta);
		var manga=txta.split("\n");
		var mangb=$("#txtb").val().split("\n");
		var arrc= new Array();
		var arrd= new Array();
		var dodaimang,i,j,kq=0;
		if(manga.length>mangb.length){
			dodaimang=manga.length;
		}else {dodaimang=mangb.length;}
		//alert(dodaimang);
		for(i=0;i<manga.length;i++){
			for(j=0;j<mangb.length;j++){
				if(manga[i].trim()===mangb[j].trim()){
					kq+=1;
				}else{ 
				//kq=0;
				//alert(manga[i].trim() +"!=" + mangb[j].trim());
				}
			}
			if(kq==0){arrc.push(manga[i])};
			kq=0;
		}
		//alert("mang c co so phan tu la " + arrc.length);
		var result="";
		for(i=0;i<arrc.length;i++){
			result+=arrc[i] + "<br/>";
		}
		$("#txtc").html(result);
		// tim tiep cac phan tu tap D
		kq=0;
		for(i=0;i<mangb.length;i++){
			for(j=0;j<manga.length;j++){
				if(mangb[i].trim()===manga[j].trim()){
					kq+=1;
					//alert(mangb[i].trim() +"!=" + manga[j].trim());
				}//else alert(mangb[i].trim() +"!=" + manga[j].trim());
			}
			//alert("ket qua =" + kq + " Add vao D " + mangb[i]);
			if(kq==0){arrd.push(mangb[i])};
			kq=0;
		}
		//alert("mang D co so phan tu la " + arrc.length);
		var resultd="";
		for(i=0;i<arrd.length;i++){
			resultd+=arrd[i] + "<br/>";
		}
		$("#txtd").html(resultd);
	}
	//var resultdt
	function timmaHC(){
		$.ajax({
			url:"timdmhc.php",
			type:"POST",
			dataType: "text",
			data:{
				dmhc: $("#txthc").val()
			},
			success:function(response){$("#dmhc").html(response);}
		});
	
	//alert(resultdt);
	}
	function kiemtrathx(obj){
		//alert(obj.value);
		var dong=obj.value.split("\n");
		var kq="<label> Tách mã theo Thôn - Xã - Huyện - Tỉnh (Phân cách bằng dấu , hoặc -) </label>";
		var i,sldau,xa,huyen,tinh,thon;
		for(i=0;i<dong.length;i++){
			//kq+="<li>"+dong[i]+"</li>";
			dong[i]=dong[i].replace("-",",");
			sldau=dong[i].split(',').length-1;
			thon=dong[i].split(",")[0];
			xa=dong[i].split(",")[1];
			huyen=dong[i].split(",")[2];
			tinh=dong[i].split(",")[3];
			kq+="<li>"+thon+" - "+xa+" - "+huyen+" - "+tinh+"</li>";
			//alert(sldau);
			//alert(dong[i]);
			//kq+="<li>"+dong[i]+"</li>";
		}
		kq="<ul>"+kq+"</ul";
		$("#tachthx").html(kq);
	}
</script>
<div class="topnav">
	<a  class="active" href="#" onClick="loadTab(this)">Tìm mã DM hành chính</a>
    <a  href="#" onClick="loadTab(this)">Tìm dữ liệu lệch</a>
    <a  href="#" onClick="loadTab(this)">Liên hệ</a>
    <a  href="#" onClick="loadTab(this)">Giới thiệu</a>
</div>
 
<div class="wrap" >
	<div class="content">
		<label>Tìm mã danh mục hành chính ( dữ liệu phải đủ 4 phần: <br/>thôn, xã, huyện, tỉnh phân cách bởi dấu , hoặc - )</label><br/>
		<textarea  id ="txthc" name="txthc" class="txthc" rows="30" cols="60" > </textarea>
		<div id="tachthx"> </div>
		<Button name="timmahc" onClick="timmaHC()" value="Kiểm tra" >Tìm mã DM hành chính</Button>
		<div id="dmhc"> </div>
	</div>
	<div class="content">
		<div class="cta">
		<label>Dữ liệu tập A</label><br/>
		<textarea  id ="txta" name="txta" class="txta" rows="20" cols="60" > </textarea>
		</div><div class="ctb">
		<label>Dữ liệu tập B</label><br/>
		<textarea  id ="txtb" name="txtb" class="txtb" rows="20" cols="60" > </textarea>
		</div>
		<div class="ctc">
		<label><b>Có trong A không trong B</b></label><br/>
		<div  id ="txtc" name="txtc" class="txtc"  > </div>
		</div>
		<div class="ctd">
		<label><b>Có trong B không trong A</b></label><br/>
		<div  id ="txtd" name="txtd" class="txtd"  > </div>
		</div>
	<Button name="kiemtra" onClick="kiemtradl()" value="Kiểm tra" >Kiểm tra </Button>
	</div>
	
	<div class="content">
		<p>Liên hệ : khoipnv@gialai.vss.gov.vn</p>
	</div>
	<div class="content">
		<p>Coppyright@:khoipnv@gialai.vss.gov.vn</p>
	</div>
</div>