<?php
if(isset($_POST['search'])){
$value=$_POST['value6'];
$sql="SELECT `NAME`,`PHONE`,`EMAIL`,`GENDER`,`DOB`,S.`STREET`,S.`CITY`,A.`PINCODE`,S.`STATE`,S.`ROLE`,S.`JOININGDATE`,R.`SALARY`
FROM `pharmacy`.`staff` S,`pharmacy`.`address` A,`pharmacy`.`roles` R
WHERE `PASSWORD` IS NOT NULL
AND S.`role`=R.`role`
 AND S.`street`=A.`street`
-- AND D.`DRUGNAME`='$value';
AND CONCAT(`NAME`,`PHONE`,`EMAIL`,`GENDER`,`DOB`,S.`STREET`,S.`CITY`,A.`PINCODE`,S.`STATE`,S.`ROLE`,S.`JOININGDATE`,R.`SALARY`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql = "SELECT `NAME`,`PHONE`,`EMAIL`,`GENDER`,`DOB`,S.`STREET`,S.`CITY`,A.`PINCODE`,S.`STATE`,S.`ROLE`,S.`JOININGDATE`,R.`SALARY`
            FROM `pharmacy`.`staff` S,`pharmacy`.`address` A,`pharmacy`.`roles` R
            WHERE `PASSWORD` IS NOT NULL
            AND S.`role`=R.`role`
             AND S.`street`=A.`street`
            -- AND S.`city`=A.`city`
            -- AND S.`state`=A.`state`;";
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
    <title>PharmaCare-Staff</title>

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
        <div id="sidebar-wrapper">
        <ul class="nav-list">
        
            <li id="change">STAFF</li>
          
           <li><a href="modifystaff.php">CHANGE STAFF DETAILS</a></li>
           
           <li><a href="deletestaff.php">REMOVE STAFF</a></li>
           
           <li><a href="viewstaff.php" style="color: white;">STAFF DETAILS</a></li>
        </ul>
        </div>
    </div>
    <div id="div2" class="scroll">
    <br>
    
        <form action="viewstaff.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value6">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>
    
    <table style="width:96%;margin-left:40px;">
    <tr>
        <br><br>
        <th>NAME</th>
    <th>MOBILE</th>
    <th>E-MAIL</th>
    <th>GENDER</th>
    <th>DOB</th>
    <th>STREET</th>
    <th>CITY</th>
    <th>PINCODE</th>
    <th>STATE</th>
    <th>ROLE</th>
    <th>JOINING DATE</th>
    <th>SALARY</th>
</tr>
<?php

     $sql = "SELECT `NAME`,`PHONE`,`EMAIL`,`GENDER`,`DOB`,S.`STREET`,S.`CITY`,A.`PINCODE`,S.`STATE`,S.`ROLE`,S.`JOININGDATE`,R.`SALARY`
            FROM `pharmacy`.`staff` S,`pharmacy`.`address` A,`pharmacy`.`roles` R
            WHERE `PASSWORD` IS NOT NULL
            AND S.`role`=R.`role`
             AND S.`street`=A.`street`
            -- AND S.`city`=A.`city`
            -- AND S.`state`=A.`state`;";
  
  //if($result=$con->query($sql)){
  //if($result->num_rows>0){
      while($row=$sresult->fetch_assoc()){
        echo "<tr><td>". $row["NAME"]."</td>";
        echo "<td>". $row["PHONE"]."</td>";
        echo "<td>". $row["EMAIL"]."</td>";
        echo "<td>". $row["GENDER"]."</td>";
        echo "<td>". $row["DOB"]."</td>";
        echo "<td>". $row["STREET"]."</td>";
        echo "<td>". $row["CITY"]."</td>";
        echo "<td>". $row["PINCODE"]."</td>";
        echo "<td>". $row["STATE"]."</td>";
        echo "<td>". $row["ROLE"]."</td>";
        echo "<td>". $row["JOININGDATE"]."</td>";
        echo "<td>". $row["SALARY"]."</td>";
      }
      //echo count(`pharmacy`.`staff`);
//       echo "</table>";
//   }
//   else{
//       echo "No Records Found";
//   }
//   }

  
//   $con->close();
  ?>      
</table>
<br><br>
</form>
</div>

</body>
</html>