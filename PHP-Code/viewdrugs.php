<?php
if(isset($_POST['search'])){
$value=$_POST['value'];
$sql="SELECT D.`DRUGCODE`,D.`DRUGNAME`,C.`CATEGORYNAME`,I.`MFGDATE`,I.`EXPIRYDATE`,I.`MRP`
FROM `pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C,`pharmacy`.`DRUGSINFO` I
WHERE I.`DRUGCODE`= D.`DRUGCODE`
AND I.`CATEGORYID`=C.`CATEGORYID`
-- AND D.`DRUGNAME`='$value';
AND CONCAT(D.`DRUGCODE`,D.`DRUGNAME`,C.`CATEGORYNAME`,I.`MFGDATE`,I.`EXPIRYDATE`,I.`MRP`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql="SELECT D.`DRUGCODE`,D.`DRUGNAME`,C.`CATEGORYNAME`,I.`MFGDATE`,I.`EXPIRYDATE`,I.`MRP`
    FROM `pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C,`pharmacy`.`DRUGSINFO` I
    WHERE I.`DRUGCODE`= D.`DRUGCODE`
    AND I.`CATEGORYID`=C.`CATEGORYID`"; 
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
    <title>PharmaCare-Drugs</title>
    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
   
   
</head>
<body>
    <div id="div1">
   <!-- <h1>DRUGS</h1> -->
   <!--<button id="duser">
    <img src="img/user.png" alt="user" width="30px" height="30px">
</button>-->
<h1>PharmaCare</h1>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
        
            <li id="change">DRUGS</li>
           
          <li><a href="adddrugs.php">ADD DRUGS</a></li>
          
           <li><a href="modifydrugs.php">CHANGE DRUG DETAILS</a></li>
           
           <li><a href="deletedrugs.php">REMOVE DRUGS</a></li>
          
           <li><a href="viewdrugs.php" style="color: white;">DRUG DETAILS</a></li>
           <li><a href="expire.php">DRUGS ABOUT TO EXPIRE</a></li>
        </ul>
         </nav>
        </div>
        
    <div id="div2" class="scroll">
    <br>
    <form action="viewdrugs.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>

       <table>
           <tr>
               <br><br>
           <th>DRUG CODE </th> <!--change-->
           <th>DRUG NAME</th>
           <th>CATEGORY</th>
           <th>MFG DATE</th>
           <th>EXPIRY DATE</th>
           <th>MRP</th>
           
        </tr>
        <?php
        
        // if($sresult->num_rows>0){
            while($row=$sresult->fetch_assoc()){  //change
                echo "<tr><td>".$row["DRUGCODE"]."</td><td>".$row["DRUGNAME"]."</td><td>".$row["CATEGORYNAME"]."</td><td>".$row["MFGDATE"]."</td><td>".$row["EXPIRYDATE"]."</td><td>".$row["MRP"]."</td><td>";

            }
        //     echo "</table>";
        // }
        // else{
        //     echo "0 result";
        // }
        
        ?>

       </table>
       <br><br> 
       </form>
       </div>
  
</body>
</html>
