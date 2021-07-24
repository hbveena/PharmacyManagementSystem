<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-DRUGS</title>
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
          
           <li><a href="viewdrugs.php"> DRUG DETAILS</a></li>
           <li><a href="expire.php" style="color: white;">DRUGS ABOUT TO EXPIRE</a></li>
        </ul>
         </nav>
    </div>
    <div style="background-color:rgba(19, 84, 145,0.6);font-size:20px;font-weight:bold;color:aliceblue;text-shadow: gray;">
        <marquee scrollamount = "11">DRUGS ABOUT TO EXPIRE WITHIN A WEEK</marquee>
</div>

        <div id="div2" class="scroll">
       <table>
           <tr>
               <br><br>
           <th>DRUG NAME</th>
           <th>CATEGORY NAME</th>
           <th>TOTAL QUANTITY</th>
           <th>EXPIRY DATE</th>
           
        </tr>
        <?php
        include 'dbcon.php';
        
        $sql="SELECT D.`DRUGNAME`,C.`CATEGORYNAME`,S.`QUANTITY`,I.`EXPIRYDATE`
                FROM `pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C,`pharmacy`.`DRUGSINFO` I,`pharmacy`.`STOCK` S
                WHERE I.`EXPIRYDATE` between curdate() and curdate()+7
                AND S.`DRUGCODE`= I.`DRUGCODE`
                AND S.`CATEGORYID`=I.`CATEGORYID`
                AND S.`DRUGCODE`=D.`DRUGCODE`
                AND S.`CATEGORYID`=C.`CATEGORYID`"; //changes
        $result=$con->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){  //change
                echo "<tr><td>". $row["DRUGNAME"]."</td>";
                echo "<td>". $row["CATEGORYNAME"]."</td>";
                echo "<td>". $row["QUANTITY"]."</td>";
                echo "<td>". $row["EXPIRYDATE"]."</td>";

            }
            echo "</table>";
        }
        else{
            echo "<td></td>"."<td></td>"."<td></td>"."<td></td>";
        }
        $con->close();
        ?>

       </table> 
    </div>
</body>
</html>