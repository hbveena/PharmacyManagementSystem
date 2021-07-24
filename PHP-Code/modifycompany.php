
<?php
session_id("session5");
session_start();
include 'dbcon.php';
//header("location:modifydrugs.php");
if(isset($_POST['modify'])){
    $cid=$_POST['cid'];
    $companyname=$_POST['companyname'];
    $branch=$_POST['branch'];
    $salesexecutive=$_POST['salesexecutive'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    
     
    $sql="UPDATE `pharmacy`.`company1` SET `COMPANYNAME`='$companyname' WHERE `cid`='{$_SESSION['cid']}';";
    $sql1="UPDATE `pharmacy`.`company2` SET `sales_executive`='$salesexecutive', `email`='$email', `phone`='$phone' WHERE (`CID`='{$_SESSION['cid']}') and (`BRANCH`='$branch');";
   
    
   if($con->query($sql)==true){
       if($con->query($sql1)==true){
            echo "<script>alert('SUCCESSFULLY MODIFIED!!!');window.location='modifycompany.php'</script>";
       }
     
   }
   
}

session_write_close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-COMPANY</title>
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css">
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
        
        <li id="change">COMPANY</li>   <!--change-->
           
        <li><a href="addcompany.php">ADD COMPANY </a></li>
         
         <li><a href="modifycompany.php"  style="color: white;">CHANGE COMPANY DETAILS</a></li>
         <!-- <br><br>
         <li><a href="deletecompany.html"></a></li> -->
        
         <li><a href="viewcompany.php">COMPANY DETAILS</a></li>
         
         <li><a href="purchase.php">PURCHASE</a></li>
        
         <li><a href="viewpurchases.php">PURCHASE DETAILS</a></li>
        </ul>
</nav>
        </div>
    <div id="div2" style="height:400px;" class="scroll">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <br>
            <p>COMPANY NAME:</p> <input type="text" name="companyname" id="adtext" placeholder="Enter Company Name" required><br>
            <p>BRANCH:</p>
            <input type="text" name="branch" id="adtext" placeholder="Enter Branch" required><br>
            <br><br><button  type="submit" class="btn" name="next"><b>NEXT</b></button><br>
        </form>
    </div>
    <?php
    session_id("session5");
    session_start();
     include 'dbcon.php';
     if(isset($_POST['next'])){
         $companyname=$_POST['companyname'];
         $branch=$_POST['branch'];
         $result="SELECT `cid` FROM  `pharmacy`.`company1` WHERE `companyname`='$companyname';";
         $resultSet=$con->query($result);
         while($rows=$resultSet->fetch_assoc()){
            $cid=$rows['cid'];
      }
         
         $sql="SELECT `sales_executive`,`email`,`phone` FROM `pharmacy`.`company2` WHERE `cid`='$cid' AND `branch`='$branch';";
     $result1=$con->query($sql);
     if($result1->num_rows>0){
     while($row=$result1->fetch_assoc()){
         $salesexecutive=$row['sales_executive'];
         $email=$row['email'];
         $phone=$row['phone'];
     }
    }
    else{
        //echo "<script>alert('COMPANY DETAILS NOT FOUND!!!');window.location='modifycompany.php'</script>";
        echo"Error: $sql<br> $con->error";
    }
     $_SESSION['cid']=$cid;
    ?>
   
     <div id="div2" style="height:800px;">
        <form action="<?php $_PHP_SELF ?>" method="POST">
        <br>
        <p>COMPANY ID:</p>
        <input type="text" id="adtext" name="cid" value="<?php echo "$cid";?> " readonly><br>
        <p>COMPANY NAME:</p> <input type="text" id="adtext" name="companyname" value="<?php echo $companyname;?>"><br>
        <p>BRANCH:</p>
        <input type="text" id="adtext" name="branch" value="<?php echo $branch;?>" readonly><br>
                
                <p>SALES EXECUTIVE:</p><input type="text" name="salesexecutive" id="adtext" value="<?php echo "$salesexecutive"; ?> "><br>
                <p>EMAIL ID:</p><input type="text" name="email" id="adtext" value="<?php echo "$email"; ?> "><br>
                <p>PHONE NUMBER:</p><input type="text" name="phone" id="adtext" value="<?php echo "$phone"; ?>"><br>
                <!-- <p>STAFF ID:</p> <input type="text" name="sid" id="adtext" value="<?php 
                 session_id("session1");
                 session_start();
                 echo($_SESSION['sid']);
                 session_write_close(); 
                 ?>" readonly><br> -->
                <br>  <button type="submit" class="btn" name="modify"><b>MODIFY</b></button><br>
        </form>
        </div>
        <?php
     }
     ?> 
    
    
</body>
</html>
