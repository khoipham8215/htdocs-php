<?php 
set_time_limit(0);
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.danhba24h.com/danhba_page.html?cate=1633");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
$result=curl_exec($ch);
curl_close($ch);
echo $result;
 ?>