<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

</body>
</html>
<?php
    require('database.php');
    $db=new Database();
    $data=[]; // mảng chứa dữ liệu máy khách
    //echo "\n";
    $serverName = "DB02-WIN2K12";
    $connectionOptions = array("Database"=>"MISBHXH_IMAGE_01", "Uid"=>"sa", "PWD"=>"p@ssw0rdcnttgl#");
    //$serverName = "DB02-WIN2K12";
    //$connectionOptions = array("Database"=>"MisCardDB", "Uid"=>"sa", "PWD"=>"p@ssw0rdcnttgl#");
    
     //Establishes the connection
     $conn = sqlsrv_connect($serverName, $connectionOptions);
     if( $conn === false )  
    {  
         echo "Could not connect. <br/>";  
          die(print_r( sqlsrv_errors(), true));  
    }
if($_POST['sobhxh']){
    $sobhxh= trim($_POST['sobhxh']);
     //Select Query
     $tsql = "SELECT * FROM IMAGES WHERE SOBHXH like '".$sobhxh."'";
     //Executes the query
     $getProducts = sqlsrv_query($conn,$tsql);
     //Error handling
     if ($getProducts == false) {
         die(FormatErrors(sqlsrv_errors()));
     }
     $productCount = 0;
     $ctr = 0;
     //$row1 = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC);
     
     ?> 
<!-- carousel bang chuyen-->
<div id="slides" class="carousel slide">
    <div class="carousel-inner">
	 <?php
     $a="";
     //header("Content-type: image/jpeg");
     while ($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)) {
    if($productCount==0){
        $a=" active";
    }else $a="";
        echo '<div class="carousel-item '.$a.'">';
        //echo '<li data-target="#slides" data-slide-to='.$productCount.' '.$a.'></li>';     
         //echo($row['SOBHXH'].' - '.$row['TENFILE']);
         //echo "<a href=get.php?keysl='".$row['KEYSL']."'>".$row['TENFILE']."</a>";
         //echo "<img width='500px' height='300px' src=".$row['IMAGES'].">";
        //echo $row['IMAGES'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['IMAGES']).'">';
        echo '<div class="carousel-caption">';
        echo '<h4>Trang '.($productCount+1).'</h4></div></div>';
        //echo("<br/>");
         $productCount++;
         //echo '<div class="text">Trang '.$productCount.'</div></div>';
     }
     echo '<ul class="carousel-indicators">';
     for($i=0; $i<$productCount;$i++){
        if($i==0){
            $a=" active";
        }else $a="";
        echo '<li data-target="#slides" data-slide-to='.$i.' class='.$a.'></li>';
     }
     echo '</ul>'
?>
       
    </div>
     <!-- Left and right controls -->
      <a class="left carousel-control" href="#slides" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#slides" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
</div>
<?php 
    if($productCount>0){
     echo "<h2>Sổ BHXH :".$_POST['sobhxh']." có ".$productCount." ảnh</h2><br><br>";
    }else echo "<h2>Không tìm thấy ảnh scan của Sổ BHXH :".$_POST['sobhxh']."!</h2><br><br>";
    $data[0]['ip']=$_SERVER['REMOTE_ADDR'];
    $data[0]['sobhxh']=$sobhxh;
    $data[0]['slanh']=$productCount;
    foreach ($data as $key => $value) {
        $db->insert('his',$value);
    }
}

    function FormatErrors($errors)
    {
        /* Display errors. */
        echo "Error information: <br/>";
     
        foreach ($errors as $error) {
            echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
            echo "Code: ".$error['code']."<br/>";
            echo "Message: ".$error['message']."<br/>";
        }
    }
       
?>
