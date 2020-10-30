<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<body>
<?php

    echo "\n";
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
     //Select Query
     $tsql = "SELECT * FROM IMAGES";
     //Executes the query
     $getProducts = sqlsrv_query($conn,$tsql);
     //Error handling
     if ($getProducts == false) {
         die(FormatErrors(sqlsrv_errors()));
     }
     $productCount = 0;
     $ctr = 0;
     ?> 
	 <h1> First 10 results are : </h1>
	 <?php
     //header("Content-type: image/jpeg");
     while ($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC)) {
         if ($ctr>9) {
             break;
         }
         $ctr++;
         echo($row['SOBHXH'].' - '.$row['TENFILE']);
         echo "<a target='_blank' href=get.php?sobhxh='".$row['SOBHXH']."'>".$row['SOBHXH']."</a>";
         //echo $row['IMAGES'];
         echo("<br/>");
         $productCount++;
     }
     /**
     sqlsrv_free_stmt($getProducts);
     
     $tsql = "INSERT INTO SalesLT.Product (Name, ProductNumber, StandardCost, ListPrice, SellStartDate) OUTPUT INSERTED.ProductID VALUES ('SQL New 1', 'SQL New 2', 0, 0, getdate())";
     //Insert query
     $insertReview = sqlsrv_query($conn, $tsql);
     if ($insertReview == false) {
         die(FormatErrors(sqlsrv_errors()));
     }
     ?> 
	 <h1> Product Key inserted is :</h1> 
	 <?php
     while ($row = sqlsrv_fetch_array($insertReview, SQLSRV_FETCH_ASSOC)) {
         echo($row['ProductID']);
     }
     sqlsrv_free_stmt($insertReview);
     //Delete Query
     //We are deleting the same record
     $tsql = "DELETE FROM [SalesLT].[Product] WHERE Name=?";
     $params = array("SQL New 1");
     
     $deleteReview = sqlsrv_prepare($conn, $tsql, $params);
     if ($deleteReview == false) {
         die(FormatErrors(sqlsrv_errors()));
     }
     
     if (sqlsrv_execute($deleteReview) == false) {
         die(FormatErrors(sqlsrv_errors()));
     }
     */
        
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
</body>
</html>