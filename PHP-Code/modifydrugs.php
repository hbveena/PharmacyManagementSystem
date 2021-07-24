<?php
session_id("session3");
session_start();
include 'dbcon.php';
//header("location:modifydrugs.php");
if(isset($_POST['modify'])){
    $drugcode=$_POST['drugcode'];
    $drugname=$_POST['drugname'];
    $categoryname=$_POST['categoryname'];
    $mfgdate=$_POST['mfgdate'];
    $expirydate=$_POST['expirydate'];
    $mrp=$_POST['mrp'];
    $result="SELECT `categoryid` FROM  `pharmacy`.`category` WHERE `categoryname`='$categoryname';";
     $resultSet=$con->query($result);
     while($rows=$resultSet->fetch_assoc()){
     $categoryid=$rows['categoryid'];
    }
     
    $sql="UPDATE `pharmacy`.`drugs` SET `DRUGNAME`='$drugname' WHERE `DRUGCODE`='{$_SESSION['drugcode']}';";
    $sql1="UPDATE `pharmacy`.`drugsinfo` SET `EXPIRYDATE`='$expirydate', `MFGDATE`='$mfgdate', `MRP`='$mrp'  WHERE (`DRUGCODE`='{$_SESSION['drugcode']}') and (`CATEGORYID`='$categoryid');";
   
    
   if($con->query($sql)==true){
       if($con->query($sql1)==true)
    echo "<script>alert('SUCCESSFULLY MODIFIED!!!');window.location='modifydrugs.php'</script>";
     
     
   }
   
}
$con->close();
session_write_close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-DRUGS</title>
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
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
          
          <li><a href="modifydrugs.php" style="color: white;">CHANGE DRUG DETAILS</a></li>
          
          <li><a href="deletedrugs.php">REMOVE DRUGS</a></li>
         
          <li><a href="viewdrugs.php">DRUG DETAILS</a></li>
          <li><a href="expire.php">DRUGS ABOUT TO EXPIRE</a></li>
        </ul>
</nav>
        </div>
    <div id="div2" style="height:400px;" class="scroll">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <br>
            <p>DRUG NAME:</p> <input type="text" name="drugname" id="adtext" placeholder="Enter Drug Name" required><br>
            <p>CATEGORY:</p>
            <?php
            $conn=mysqli_connect("localhost","root","Def@123","pharmacy");
            if($conn->connect_error){
                die("connection failed:".$conn->connect_error);
            }
            $sql="SELECT `categoryname` FROM `pharmacy`.`category`";
            $resultSet=$conn->query($sql);
           
            ?>
            <select value="`pharmacy`.`category`" name="categoryname" id="adtext" style="width:750px;">
            <?php
            echo "<option>select category</option>";
            while($rows=$resultSet->fetch_assoc())
            {
                $categoryname=$rows['categoryname'];
                echo "<option value='$categoryname'>$categoryname</option>";
            }
            ?>
            </select>
            <br><br><button  type="submit" class="btn" name="next"><b>NEXT</b></button><br>
        </form>
    </div>
    <?php
    session_id("session3");
    session_start();
     include 'dbcon.php';
     if(isset($_POST['next'])){
         $drugname=$_POST['drugname'];
         $categoryname=$_POST['categoryname'];
         $result="SELECT `categoryid` FROM  `pharmacy`.`category` WHERE `categoryname`='$categoryname';";
         $resultSet=$con->query($result);
         while($rows=$resultSet->fetch_assoc()){
            $categoryid=$rows['categoryid'];
      }
         $result1="SELECT `drugcode` FROM  `pharmacy`.`drugs` WHERE `drugname`='$drugname';";
         $result2= $con->query($result1);
         while($rows=$result2->fetch_assoc()){
             $drugcode=$rows['drugcode'];
         }
        
         $sql="SELECT `expirydate`,`mfgdate`,`mrp` FROM `pharmacy`.`drugsinfo` WHERE `drugcode`='$drugcode' AND `categoryid`='$categoryid';";
     $result = $con->query($sql);
     if($result->num_rows>0){
     while ($rows = $result->fetch_assoc()){
         $mfgdate=$rows['mfgdate'];
         $expirydate=$rows['expirydate'];
         $mrp=$rows['mrp'];
     }
    }
    else{
        echo "<script>alert('DRUG NOT FOUND!!!');window.location='modifydrugs.php'</script>";
    }
     $_SESSION['drugcode']=$drugcode;
    ?>
     <div id="div2" style="height:800px;">
        <form action="<?php $_PHP_SELF ?>" method="POST">
        <br>
        <p>DRUG CODE:</p>
        <input type="text" id="adtext" name="drugcode" value="<?php echo "$drugcode";?> " readonly><br>
        <p>DRUG NAME:</p> <input type="text" id="adtext" name="drugname" value="<?php echo $drugname;?>"><br>
        <p>CATEGORY:</p>
        <input type="text" id="adtext" name="categoryname" value="<?php echo $categoryname;?>" readonly><br>
                
                <p>MANUFACTURING DATE:</p><input type="date" name="mfgdate" id="adtext" value="<?php echo "$mfgdate";?>"><br>
                <p>EXPIRY DATE:</p><input type="date" name="expirydate" id="adtext" value="<?php echo "$expirydate";?>"><br>
                <p>MRP:</p><input type="text" name="mrp" id="adtext" value="<?php echo "$mrp";?>"><br>
                <br>  <button type="submit" class="btn" name="modify"><b>MODIFY</b></button><br>
        </form>
        </div>
        <?php
     }
     $con->close();
     ?>
</body>
</html>
