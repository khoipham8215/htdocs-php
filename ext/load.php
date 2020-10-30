<!DOCTYPE html>
<html>
<head>
	<title>Xuất dữ liệu</title>
</head>
<body>
<table>
<?php 
/** function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f;
        sleep($seconds);
    }
}
*/
function load(){
	if(isset($_POST['data'])){

	 	echo $_POST['data'];
	}else
		echo " Không nhận được dữ liệu !";
}
//setInterval(load(),1000);
while (true) {
	echo " Xin chào ! <br>";
	sleep(1);
}
?>
</table>
</body>
</html>