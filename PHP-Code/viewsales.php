<?php
if(isset($_POST['search'])){
$value=$_POST['value4'];
$sql="SELECT S3.`CUSTID`,CT.`CUSTNAME`,D.`DRUGNAME`,C.`CATEGORYNAME`,S3.`QUANTITY`,S3.`TOTALPRICE`,S3.`INVOICENO`,S1.`INVOICEDATE`,S2.`SID`
FROM `pharmacy`.`SALES1` S1 ,`pharmacy`.`SALES2` S2,`pharmacy`.`SALES3` S3,`pharmacy`.`CUSTOMER` CT,`pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C
WHERE S3.`DRUGCODE`=D.`DRUGCODE`
AND S3.`CATEGORYID`=C.`CATEGORYID`
AND S3.`CUSTID`=CT.`CUSTID`
AND S3.`INVOICENO`=S2.`INVOICENO`
AND S3.`INVOICENO`=S1.`INVOICENO`
-- AND D.`DRUGNAME`='$value';
AND CONCAT(S3.`CUSTID`,CT.`CUSTNAME`,D.`DRUGNAME`,C.`CATEGORYNAME`,S3.`QUANTITY`,S3.`TOTALPRICE`,S3.`INVOICENO`,S1.`INVOICEDATE`,S2.`SID`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql="SELECT S3.`CUSTID`,CT.`CUSTNAME`,D.`DRUGNAME`,C.`CATEGORYNAME`,S3.`QUANTITY`,S3.`TOTALPRICE`,S3.`INVOICENO`,S1.`INVOICEDATE`,S2.`SID`
                FROM `pharmacy`.`SALES1` S1 ,`pharmacy`.`SALES2` S2,`pharmacy`.`SALES3` S3,`pharmacy`.`CUSTOMER` CT,`pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C
                WHERE S3.`DRUGCODE`=D.`DRUGCODE`
                AND S3.`CATEGORYID`=C.`CATEGORYID`
                AND S3.`CUSTID`=CT.`CUSTID`
                AND S3.`INVOICENO`=S2.`INVOICENO`
                AND S3.`INVOICENO`=S1.`INVOICENO`
                ORDER BY `INVOICENO` DESC";
    $sresult=searchtable($sql);
}
function searchtable($sql){
    include 'dbcon.php';
    $qresult=mysqli_query($con,$sql);
    return $qresult;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-Sales</title>
    
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
    
</head>

<body>
    <div id="div1">
    <h1>PharmaCare</h1>
      <!--<button id="duser">
    <img src="img/user.png" alt="user" width="50px" height="50px">
</button>-->
 <a href="dashboard1.php" style="left:80%;top:6%;">HOME</a> 
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
            
            <li id="change">SALES</li>   <!--change-->
            
          <li><a href="addcustomer.php">ADD CUSTOMER </a></li>
          
           
           <li><a href="viewcustomer.php">CUSTOMER DETAILS</a></li>
           
           <li><a href="addsales.php">SALES</a></li>
           
           <li><a href="viewsales.php" style="color: white;">SALES DETAILS</a></li>
        </ul>
        </nav>
       </div> 
       <div id="div2" class="scroll">
       <br>
        <form action="viewsales.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value4">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>
       <table>
           <tr>
               <br><br>
           <th>CUSTOMER ID</th>
           <th>CUSTOMER NAME</th><!--change-->
           <th>DRUG NAME</th>
           <th>CATEGORY</th>
           <th>QUANTITY</th>
           <th>COST</th>
           <th>INVOICE NO</th>
           <th>INVOICE DATE</th>
           <th>STAFF ID</th>
        </tr>
        <?php
        include 'dbcon.php';
        //$sql="SELECT* FROM `pharmacy`.`SALES2`";
        
        //$result=$con->query($sql);
        //if($result->num_rows>0){
            while($row=$sresult->fetch_assoc()){  //change
                echo "<tr><td>".$row["CUSTID"]."</td><td>".$row["CUSTNAME"]."</td><td>".$row["DRUGNAME"]."</td><td>".$row["CATEGORYNAME"]."</td><td>".$row["QUANTITY"]."</td><td>".$row["TOTALPRICE"]."</td><td>".$row["INVOICENO"]."</td><td>".$row["INVOICEDATE"]."</td><td>".$row["SID"]."</td><td>";

            }
        //     echo "</table>";
           
        // }
        // else{
        //     echo "0 result";
        // }
        // $con->close();
        ?>
        
 </table> 
 <br><br>
 </form>
 <br>
    </div>
</body>
</html>