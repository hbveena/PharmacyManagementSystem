<?php
session_id("session2");
session_start();

//echo ($_SESSION['invoiceno']);
//echo ($_SESSION['custid']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>
     <!-- <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/drugs2.css?v=<?php echo time(); ?>"> -->
    <link rel="stylesheet" type="text/css" href="css/print.css?v=<?php echo time(); ?>">
</head>  
<body>   
<div class="heading">
			<label class="h">PHARMACARE</label>
        </div>
<div class="address">
<pre class="font">PharmaCare
NO-7,PART-1,
GROUND FLOOR,1ST MAIN,
GANDHI NAGAR,OFF,MYSORE ROAD,
BANGALORE - 561235</pre>
</div>
<br>
<div class="address">
    <label class="font">Invoice No:   <?php echo ($_SESSION['invoiceno']);?></label>&emsp;&emsp;&emsp;&emsp;&emsp;
 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<label class="font">Invoice Date:  <?php echo (date("d/m/y"));?></label>
</div>
<br>
<div class="address">
<label class="font">MEMBERSHIP ID : <?php echo ($_SESSION['custid']); ?></label><br>
<?php
include 'dbcon.php';
$sql="SELECT `CUSTNAME`,`phone` FROM `pharmacy`.`customer` WHERE `custid`='{$_SESSION['custid']}';";
$result = $con->query($sql);
if($result->num_rows>0){
while ($rows = $result->fetch_assoc()){
    $custname=$rows['CUSTNAME'];
    $phoneno=$rows['phone'];
}
}
?>
<label class="font">NAME : <?php echo "$custname"; ?></label><br>
<label class="font">PHONE NO : <?php echo "$phoneno"; ?></label>
</div>
<br>
<div>
    <br>
    <label style="margin-left:200px;font-size:25px;">DRUGS PURCHASED</label>
    <div>

</div>
<table>
           <tr>
               <br><br>
           <!-- <th>S.NO</th>       -->
           <!--change-->
           <th>DRUG NAME</th>
           <th>CATEGORY</th>
           <th>QTY</th>
           <th>MRP</th>
           <th>EXPIRY DATE</th>
           <th>PRICE</th>
        </tr>
        <?php
        include 'dbcon.php';
       

        $sql="SELECT D.`DRUGNAME`,C.`CATEGORYNAME`,S3.`QUANTITY`,I.`MRP`,I.`EXPIRYDATE`,S3.`TOTALPRICE`
                FROM `pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C,`pharmacy`.`DRUGSINFO` I,`pharmacy`.`SALES3` S3
                WHERE  S3.`INVOICENO`='{$_SESSION['invoiceno']}'
                AND I.`DRUGCODE`=S3.`DRUGCODE`
                AND I.`CATEGORYID`=S3.`CATEGORYID`
                AND D.`DRUGCODE`=S3.`DRUGCODE`
                AND C.`CATEGORYID`=S3.`CATEGORYID`"; //changes
        // $sql="SELECT S2.`DRUGCODE`,S2.`CATEGORYID`,S2.`QUANTITY`,I.`MRP`,I.`EXPIRYDATE`,S2.`TOTALPRICE`
        //       FROM `pharmacy`.`SALES2` S2 INNER JOIN `pharmacy`.`SALES3` S3 INNER JOIN `pharmacy`.`DRUGSINFO` I
        //        WHERE  S3.`INVOICENO`='{$_SESSION['invoiceno']}'";



        $result=$con->query($sql);
        $amount=0;
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){  //change
                echo "<tr><td>".$row["DRUGNAME"]."</td><td>".$row["CATEGORYNAME"]."</td><td>".$row["QUANTITY"]."</td><td>".$row["MRP"]."</td><td>".$row["EXPIRYDATE"]."</td><td>".$row["TOTALPRICE"]."</td><td>";
                   $amount= $amount+$row["TOTALPRICE"];
            }
            echo "<tr><td>"."</td><td>";
            echo "<tr><td>"."</td><td>";
            echo "<tr><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."AMOUNT"."</td><td>".$amount."</td><td>";
            echo "</table>";
        }
        else{
            echo "0 result";
        }
        $con->close();
        ?>

       </table> 

</div>
</body>
</html>