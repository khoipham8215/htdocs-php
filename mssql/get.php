<style type="text/css">
* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 80%;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}
.active {
  display: block;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
  text-shadow: 2px 2px 4px #000000;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 0.5s;
  animation-name: fade;
  animation-duration: 0.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>
<script type="text/javascript">
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
<?php
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
     $tsql = "SELECT * FROM IMAGES WHERE SOBHXH like '%".$sobhxh."%'";
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
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  
	 
	 <?php
     $a="";
     //header("Content-type: image/jpeg");
     while ($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)) {
    if($productCount==0){
        $a=" active";
    }else $a="";
        echo '<div class="mySlides fade '.$a.'">';     
         //echo($row['SOBHXH'].' - '.$row['TENFILE']);
         //echo "<a href=get.php?keysl='".$row['KEYSL']."'>".$row['TENFILE']."</a>";
         //echo "<img width='500px' height='300px' src=".$row['IMAGES'].">";
        //echo $row['IMAGES'];
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['IMAGES']).'">';
        //echo("<br/>");
         $productCount++;
         echo '<div class="text">Trang '.$productCount.'</div></div>';
     }
?>
     <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
  <br>
<!-- The dots/circles -->
<div style="text-align:center">
<?php 
    for($i=1; $i<=$productCount;$i++){
        echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
    }
 ?>  
</div>
<?php 
     echo "</div><h2>Sổ BHXH :".$_POST['sobhxh']." có ".$productCount." ảnh</h2><br><br>";
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
