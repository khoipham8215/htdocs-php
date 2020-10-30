<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script language="javascript">
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
</script>
<div class="wrap">


	<div class="content2">
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
</div>