<?php
    echo "\n";
    $serverName = "DB04-WIN2K12.database.windows.net,1433";
    $database = "MISBHXH_IMAGE_01";
    $uid = "sa";
    $pwd = "p@ssw0rdcnttgl#";
    
     //Establishes the connection
     $conn = new PDO("sqlsrv:server=$serverName ; Database = $database", $uid, $pwd);
     
     //Select Query
     $tsql = "SELECT * FROM dbo.IMAGES";
     
     //Executes the query
     $getProducts = $conn->query($tsql);
     
     //Error handling
     FormatErrors($conn->errorInfo());
     
     $productCount = 0;
     $ctr = 0;
     ?> 
	 
	 <h1> First 10 results are : </h1>
	 
	 <?php
     while ($row = $getProducts->fetch(PDO::FETCH_ASSOC)) {
         if ($ctr>9) {
             break;
         }
         $ctr++;
         echo($row['CompanyName']);
         echo("<br/>");
         $productCount++;
     }
     $getProducts = null;
     
     $tsql = "INSERT INTO SalesLT.Product (Name, ProductNumber, StandardCost, ListPrice, SellStartDate) OUTPUT INSERTED.* VALUES ('SQL New 1', 'SQL New 2', 0, 0, getdate())";
     
     //Insert query
     $insertReview = $conn->query($tsql);
     FormatErrors($conn->errorInfo());
     ?> 
	 
	 <h1> Product Key inserted is :</h1> 
	 
	 <?php
     while ($row = $insertReview->fetch(PDO::FETCH_ASSOC)) {
         echo($row['ProductID']."<br/>");
     }
     $insertReview = null;
     
     //Delete Query
     //We are deleting the same record
     $tsql = "DELETE FROM [SalesLT].[Product] WHERE Name=?";
     $param = "SQL New 1";
     
     $deleteReview = $conn->prepare($tsql);
     $deleteReview->bindParam(1, $param);
     
     $deleteReview->execute();
     FormatErrors($deleteReview->errorInfo());
     
     function FormatErrors($error)
     {
         /* Display error. */
         echo "Error information: <br/>";
     
         echo "SQLSTATE: ".$error[0]."<br/>";
         echo "Code: ".$error[1]."<br/>";
         echo "Message: ".$error[2]."<br/>";
     }
?>