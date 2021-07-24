
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-STAFF</title>

    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
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
       
            <li id="change">STAFF</li>
         
           <li><a href="modifystaff.php">MODIFY STAFF DETAILS</a></li>
       
           <li><a href="deletestaff.php">DELETE STAFF</a></li>
       
           <li><a href="viewstaff.php" style="color: white;">VIEW STAFF</a></li>
        </ul>
</nav>
    </div>
    <div id="div2" class="scroll">
    <table style="width:1200px; margin-left:40px;">
    <tr>
        <br><br>
    <th>NAME</th>
    <th>MOBILE</th>
    <th>E-MAIL</th>
    <th>GENDER</th>
    <th>DOB</th>
    <th>STREET</th>
    <th>CITY</th>
    <th>STATE</th>
    <th>ROLE</th>
    <th>JOINING DATE</th>
    <th>SALARY</th>
</tr>
<?php
include 'dbcon.php';

$sql = "SELECT `NAME`,`PHONE`,`EMAIL`,`GENDER`,`DOB`,`STREET`,`CITY`,`STATE`,`staff`.`ROLE`,`JOININGDATE`,`SALARY` 
        FROM `pharmacy`.`staff`,`pharmacy`.`roles`
        WHERE `PASSWORD` IS NOT NULL AND `pharmacy`.`staff`.`role`=`pharmacy`.`roles`.`role` ";
  $result=$con->query($sql);
  if($result){
  if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
          echo "<tr><td>". $row["NAME"]."</td>";
          echo "<td>". $row["PHONE"]."</td>";
          echo "<td>". $row["EMAIL"]."</td>";
          echo "<td>". $row["GENDER"]."</td>";
          echo "<td>". $row["DOB"]."</td>";
          echo "<td>". $row["STREET"]."</td>";
          echo "<td>". $row["CITY"]."</td>";
          // echo "<td>". $row["PINCODE"]."</td>";
          echo "<td>". $row["STATE"]."</td>";
          echo "<td>". $row["ROLE"]."</td>";
          echo "<td>". $row["JOININGDATE"]."</td>";
          echo "<td>". $row["SALARY"]."</td>";
      }
      echo "</table>";
  }
  else{
      echo "No Records Found";
  }
  }

  
  $con->close();
  ?>      
</table>
</div>

</body>
</html>