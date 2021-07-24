<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-DASHBOARD</title>
     <!-- <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>"> -->
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
    <script src="js/ds.js"></script>
</head>
<body>

<div id="div1" style="height:60px;background-color: rgba(1, 47, 109, 0.1)">
<br>
<text style="font-style: oblique";><h1>PharmaCare</h1></text>
<a href="login.html" style="left: 90%;top: 4%;color:white;">LOG OUT</a>
    </div>
    <div style="background-color:rgba(19, 84, 145,0.6);font-size:26px;font-weight:bold;color:aliceblue;text-shadow: gray;">
        <marquee direction>Welcome to PharmaCare!!!</marquee>
</div>
<div class="topnav" class="myTopnav">
        <nav id="sidebar-wrapper">
        <!-- #15317E -->
        <ul class="nav-list">
        
          <li>DRUGS
                <ul class="option">
                    <li><a href="adddrugs.php">ADD DRUGS</a></li>
                    <li><a href="modifydrugs.php" style="font-size:13px;">CHANGE DRUG DETAILS</a></li>
                    <li><a href="deletedrugs.php">REMOVE DRUGS</a></li>
                    <li><a href="viewdrugs.php">DRUGS DETAILS</a></li>
                    <li><a href="expire.php">DRUGS TO EXPIRE</a></li>
</ul>
</li>  
           <li>PURCHASE
           <ul class="option">
                    <li><a href="addcompany.php">ADD COMPANY</a></li>
                    <li><a href="modifycompany.php" style="font-size:11px;">CHANGE COMPANY DETAILS</a></li>
                    <li><a href="viewcompany.php">COMPANY DETAILS</a></li>
                    <li><a href="purchase.php">PURCHASE <i class="fas fa-caret-down"></i> </a></li>
                    <li><a href="viewpurchases.php">PURCHASE DETAILS</a></li>
</ul>
           </li>
           
           <li>SALES
           <ul class="option">
                    <li><a href="addcustomer.php">ADD CUSTOMER</a></li>

                    <li><a href="viewcustomer.php">CUSTOMER DETAILS</a></li>
                    <li><a href="addsales.php">SALES</a></li>
                    <li><a href="viewsales.php">SALES DETAILS</a></li>
                    <li><a href="salesreport.php">SALES REPORT</a></li>
</ul> 
           </li>
           <li>STOCK
               <ul class="option">
           <li><a href="stock.php">STOCK DETAILS</a></li>
</ul>
           </li>
           <li>STAFF
           <ul class="option">
                    <li><a href="modifystaff.php" style="font-size:13px;">CHANGE STAFF DETAILS</a></li>
                    <li><a href="deletestaff.php">REMOVE STAFF</a></li>
                    <li><a href="viewstaff.php">STAFF DETAILS</a></li>
</ul> 
           </li>
           <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
        </ul>
</nav>
</div>
 <img src="img/dashboard2.jpg" style="width:100%;height:550px;">  
<div>

<div class="grid-container1"> 
    
    
    <div class="grid-child1">
        <p>PHARMACISTS</p>
        <img src="img/salesman.jpg" style="width:50px;height:50px;margin-left:60px;background-color:black;"> 
        <?php
        include 'dbcon.php';
        $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`staff` WHERE `role`='Pharmacist';";
        $result=$con->query($sql);
        while($rows=$result->fetch_assoc()){
            $count=$rows['count'];
        }
        $con->close();
         ?>
         <p style="font-size:20px;"><?php echo $count;?></p>
    
    
    </div>
    <div class="grid-child1">
    <p>SALESMAN</p>
    <img src="img/salesman.jpg" style="width:50px;height:50px;margin-left:60px;background-color:black;"> 
    <?php
        include 'dbcon.php';
        $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`staff` 
        WHERE `role`='Salesman'
        AND `PASSWORD` IS NOT NULL;";
        $result=$con->query($sql);
        while($rows=$result->fetch_assoc()){
            $count=$rows['count'];
        }
        $con->close();
         ?>
         <p style="font-size:20px;"><?php echo $count;?></p>
    </div>
    <div class="grid-child1">
    <p>DRUGS IN STORE</p>
    <img src="img/druglogo.png" style="width:50px;height:50px;margin-left:60px;background:black;"> 
    <?php
        include 'dbcon.php';
        $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`DRUGS`;";
        $result=$con->query($sql);
        while($rows=$result->fetch_assoc()){
            $count=$rows['count'];
        }
        $con->close();
         ?>
         <p style="font-size:20px;"><?php echo $count;?></p>
    
    </div>

    <!-- <div class="grid-child1">
    <p>CUSTOMERS</p>
    <img src="img/customerlogo.png" style="width:50px;height:50px;margin-left:60px;background-color:black;">  -->
    <?php
        // include 'dbcon.php';
        // $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`customer`;";
        // $result=$con->query($sql);
        // while($rows=$result->fetch_assoc()){
        //     $count=$rows['count'];
        // }
        // $con->close();
         ?>
          <!-- <p style="font-size:20px;"><?php //echo $count;?></p>
    
    </div> -->

    <div class="grid-child1">
    <p>COMPANIES</p>
    <img src="img/companylogo.jpg" style="width:50px;height:50px;margin-left:60px;background-color:black;"> 
    <?php
        include 'dbcon.php';
        $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`company1`;";
        $result=$con->query($sql);
        while($rows=$result->fetch_assoc()){
            $count=$rows['count'];
        }
        $con->close();
         ?>
          <p style="font-size:20px;"><?php echo $count;?></p>
    </div>
    <br>
</div>
<div class="grid-container"> 

<!-- <div class="div"> -->
 <div class="grid-child">
        <p>Sales</p>
    <?php
    include 'dbcon.php';
    $sql="SELECT SUM(`TOTALPRICE`) AS `sum` FROM `PHARMACY`.`sales3` S3,`pharmacy`.`sales1` S1
          WHERE S3.`INVOICENO`=S1.`INVOICENO`
          AND `INVOICEDATE`= CURDATE();";
    $result=$con->query($sql);
    while($rows=$result->fetch_assoc()){
        $sum=$rows['sum'];
    }
    $con->close();
    ?>
    <label><?php echo '₹'.$sum;?></label>
    &emsp;<p id="p1">Today's Total Sales</p>
 </div>

    <div class="grid-child">
        <p>Sales</p>
    <?php
    include 'dbcon.php';
    $sql="SELECT SUM(`TOTALPRICE`) AS `sum` FROM `PHARMACY`.`sales3` S3,`pharmacy`.`sales1` S1
          WHERE S3.`INVOICENO`=S1.`INVOICENO`
          AND MONTH(`INVOICEDATE`)= MONTH(CURDATE());";
    $result=$con->query($sql);
    while($rows=$result->fetch_assoc()){
        $sum=$rows['sum'];
    }
    $con->close();
    ?>
    <label><?php echo '₹'.$sum;?></label>
    <a href="salesreport.php" id="p1" style="margin-left:26px;text-decoration:underline;">Total Sales of the month</a>
    </div>

    <div class="grid-child">
        <p>Expenses</p>
    <?php
    include 'dbcon.php';
    $sql="SELECT SUM(`BUYINGPRICE`) AS `sum` FROM `pharmacy`.`purchase` 
          WHERE  MONTH(`PURCHASEDATE`)= MONTH(CURDATE());";
    $result=$con->query($sql);
    while($rows=$result->fetch_assoc()){
        $sum=$rows['sum'];
    }
    $con->close();
    ?>
    <label><?php echo '₹'.$sum;?></label>
    <p id="p1" style="margin-left:;">Total Expenses of the month</p>
    </div>
    
    <div class="grid-child" style="width:250px;">
    <p id="p1"><a href="expire.php" style="text-decoration:underline;">Drugs About to Expire</a></p>
    <?php
        include 'dbcon.php';
        $sql="SELECT COUNT(*) AS `count` FROM `PHARMACY`.`DRUGSINFO`
                where `EXPIRYDATE` between curdate() and curdate()+7;";
        $result=$con->query($sql);
        while($rows=$result->fetch_assoc()){
            $count=$rows['count'];
        }
        $con->close();
         ?>
         <label style="margin-left:120px;"><?php echo $count;?></label>
    
    </div>
    &emsp;&emsp;
</div>
<br><br>
<div class="">
    <label style="margin-left:530px;font-weight:bold;font-size:20px;color:whitesmoke;">LOW STOCK DRUGS</label>
<table>
           <tr>
               <br><br>
            <!--change-->
           <th>DRUG NAME</th>
           <th>CATEGORY NAME</th>
           <th>TOTAL QUANTITY</th>
          
           
        </tr>
        <?php
        include 'dbcon.php';
        
        $sql="SELECT D.`DRUGNAME`,C.`CATEGORYNAME`,S.`QUANTITY`
                FROM `pharmacy`.`DRUGS` D,`pharmacy`.`CATEGORY` C,`pharmacy`.`DRUGSINFO` I,`pharmacy`.`STOCK` S
                WHERE S.`QUANTITY`<'10'
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
              //  echo "<td>". $row["MRP"]."</td>";

            }
            echo "</table>";
        }
        else{
            echo "<td></td>"."<td></td>"."<td></td>"."<td></td>";
        }
        $con->close();
        ?>

       </table> 
       <br><br>
</div> 
<div style="height:100px;background-color:black;">
    </div>

    
    
   
</body>
</html>