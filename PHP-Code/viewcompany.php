<?php
if(isset($_POST['search'])){
$value=$_POST['value1'];
$sql="SELECT C.`CID`,C.`COMPANYNAME`,C1.`BRANCH`,C1.`SALES_EXECUTIVE`,C1.`EMAIL`,C1.`PHONE`,C1.`SID` 
FROM `pharmacy`.`company1` C,`pharmacy`.`company2` C1
WHERE C1.`CID`= C.`CID`
-- AND D.`DRUGNAME`='$value';
AND CONCAT(C.`CID`,C.`COMPANYNAME`,C1.`BRANCH`,C1.`SALES_EXECUTIVE`,C1.`EMAIL`,C1.`PHONE`,C1.`SID`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql="SELECT C.`CID`,C.`COMPANYNAME`,C1.`BRANCH`,C1.`SALES_EXECUTIVE`,C1.`EMAIL`,C1.`PHONE`,C1.`SID` 
        FROM `pharmacy`.`company1` C,`pharmacy`.`company2` C1
        WHERE C1.`CID`= C.`CID`
        ORDER BY `CID`;";
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
    <title>PharmaCare-Company</title>
    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
</head>
<body>
    <div id="div1">
      <!--<button id="duser">
    <img src="img/user.png" alt="user" width="50px" height="50px">
</button>-->
<h1>PharmaCare</h1>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
            
            <li id="change">COMPANY</li>   <!--change-->
           
          <li><a href="addcompany.php">ADD COMPANY </a></li>
          
           <li><a href="modifycompany.php">CHANGE COMPANY DETAILS</a></li>
           <!-- <br><br>
           <li><a href="deletecompany.html"></a></li> -->
           
           <li><a href="viewcompany.php" style="color: white;">COMPANY DETAILS</a></li>
           
           <li><a href="purchase.php">PURCHASE</a></li>
         
           <li><a href="viewpurchases.php">PURCHASE DETAILS</a></li>
        </ul>
        </nav>
        </div>
        <div id="div2" class="scroll">
        <br>
    <form action="viewcompany.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value1">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>
       <table>
           <tr>
               <br><br>
           <th>Company ID</th> <!--change-->
           <th>Company name</th>
           <th>Branch</th>
           <th>Sales Executive</th>
           <th>email ID</th>
           <th>Phone</th>
           <th>Staffid</th>
           
           
        </tr>
        <?php
       
       // $result=$conn->query($sql);
        //if($result->num_rows>0){
            while($row=$sresult->fetch_assoc()){  //change
                echo "<tr><td>".$row["CID"]."</td><td>".$row["COMPANYNAME"]."</td><td>".$row["BRANCH"]."</td><td>".$row["SALES_EXECUTIVE"]."</td><td>".$row["EMAIL"]."</td><td>".$row["PHONE"]."</td><td>".$row["SID"]."</td><td>";

            }
        //     echo "</table>";
        // }
        // else{
        //     echo "0 result";
        // }
        // $conn->close();
        ?>

       </table> 
       <br><br>
       </form>
    </div>
</body>
</html>