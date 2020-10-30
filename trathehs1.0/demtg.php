<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$bd=time();
function countdown($event,$month,$day,$year) {
$remain = ceil((mktime(0,0,0,$month,$day,$year) - time()) / 86400);
 
if ($remain > 0) {
print "<p><strong>$remain</strong> ngày nữa là đến $event</p>";
}
else {
print "<p>$event has arrived!</p>";
}
}
countdown("Christmas Day", 12, 25, 2020);

echo "<br/>Bây giờ là :".date("d/m/yy h:m:s", time());
sleep(3);
$kt=time();
//$ktg=strtotime($bd)-strtotime($kt);
//$ktg->format('%R%s giây');
$ktg=$kt-$bd;
echo "<br/>Khoảng cách thời gian từ bắt đầu :".$bd." đến kết thúc :".$kt." Là :".$ktg;
?>