<?php 
//echo grab_page("http://learning.ehou.edu.vn/course/view.php?id=6776&section=8");
set_time_limit(360000);
require "simple_html_dom.php";
require "database.php";
$db=new Database();
function luudn($html,$db){
    $dn=$html->find("div[class='search-results']");
   
    $data=[];
    $i=0;
    foreach ($dn as $key => $value) {
        # code...
        //echo $value."<hr/>";
        $data[$i]["tendn"]=$value->find("a")[0]->innertext;
        $data[$i]["link"]=$value->find("a")[0]->href;
        $data[$i]["mst"]=$value->find("a")[1]->innertext;
        $s1=$value->find("p")[0]->innertext;
        $pos1=strpos($s1,"Đại diện pháp luật");
        //$pos2=strpos($s1, "br");
        $pos3=strpos($s1, "Địa chỉ");
        $data[$i]["cdn"]=strip_tags(substr($s1, $pos1,$pos3-$pos1));
        
        $data[$i]["dc"]=substr($s1, $pos3,strlen($s1)-$pos3);
        $i++;
    }
    
    foreach ($data as $key => $value) {
        # code...
        $db->insert("ttdn",$value);
    }
    //echo var_dump($data);
    echo "Lưu thành công ".(count($data))." doanh nghiệp vào database!<br>";
    //echo $html;
}
for ($j=5405; $j < 24919; $j++) { 
    # code...
    //$j=2;
    echo "Đang lưu trang ".$j;
    $html=file_get_html("https://www.thongtincongty.com/?page=".$j);
    $btnqc=$html->find("div[id='dismiss-button']");
    if(isset($btnqc)){
        $html=file_get_html("https://www.thongtincongty.com/?page=".$j);
    }
    luudn($html,$db);
    //sleep(1);
    //$j++;
    
}
    

 ?>