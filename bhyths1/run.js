$('#btnadd').click(function(){
		//alert("add item");
		//console.log($('#btnadd'));
		li=document.createElement("li");
		text=document.createTextNode(adddotstr($('#additem').val()));
		li.appendChild(text);
		$('#ul1').append(li);
		console.log(li);
	});
function adddotstr(str){
	if(str==0){return "0";}else{
		var len=str.length;
		var count=3;
		var result="";
		var con="";
		while(len-count>0){
			console.log("con :"+con+"len :"+len+"count :"+count);
			var con=str.substring((len-count),len-count+3);
			result=','+con+result;
			count+=3;
			
		}
	con=str.substring(0,3-(count-len));
	result=con+result;
	return result;
	}
}