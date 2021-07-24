<?php
if(isset($_POST['search'])){
$value=$_POST['value5'];
$sql="SELECT D.`DRUGCODE`,`DRUGNAME`,`CATEGORYNAME`,`QUANTITY` FROM STOCK,DRUGS D,CATEGORY
WHERE DRUGNAME=(SELECT `DRUGNAME` FROM DRUGS WHERE `STOCK`.`DRUGCODE`=`DRUGS`.`DRUGCODE`)
AND CATEGORYNAME=(SELECT `CATEGORYNAME` FROM CATEGORY WHERE `STOCK`.`CATEGORYID`=`CATEGORY`.`CATEGORYID`)
-- AND D.`DRUGNAME`='$value';
AND CONCAT(D.`DRUGCODE`,`DRUGNAME`,`CATEGORYNAME`,`QUANTITY`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql="SELECT D.`DRUGCODE`,`DRUGNAME`,`CATEGORYNAME`,`QUANTITY` FROM STOCK,DRUGS D,CATEGORY
    WHERE DRUGNAME=(SELECT `DRUGNAME` FROM DRUGS WHERE `STOCK`.`DRUGCODE`=`DRUGS`.`DRUGCODE`)
    AND CATEGORYNAME=(SELECT `CATEGORYNAME` FROM CATEGORY WHERE `STOCK`.`CATEGORYID`=`CATEGORY`.`CATEGORYID`);";
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
    <title>PharmaCare-STOCK</title>
    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
</head>
<body>
    <div id="div1">
    <h1>PharmaCare</h1>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
   
    <div id="div2" class="scroll">
    <br><br>
    
        <form action="stock.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value5">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>
   <button type="submit" id="viewbtn">VIEW ALL</button>
    <br>
       <table style="margin-left:140px;">
           <tr>
               <br>
           <th>DRUG CODE</th> <!--change-->
           <th>DRUG NAME</th>
           <th>CATEGORY</th>
           <th>QUANTITY</th>
           
           
        </tr>
        <?php
       
      
        //changes
        // $result=$con->query($sql);
        // if($result->num_rows>0){
            while($row=$sresult->fetch_assoc()){  //change
                echo "<tr><td>".$row["DRUGCODE"]."</td><td>".$row["DRUGNAME"]."</td><td>".$row["CATEGORYNAME"]."</td><td>".$row["QUANTITY"]."</td><td>";

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
    </div>
</body>
</html>