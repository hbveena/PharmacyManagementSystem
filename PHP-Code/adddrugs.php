<?php
include 'dbcon.php';
if(isset($_POST['add'])){
$drugcode=$_POST['drugcode'];
$drugname=$_POST['drugname'];
$categoryname=$_POST['categoryname'];
$mrp=$_POST['mrp'];
$mfgdate=$_POST['mfgdate'];
$expdate=$_POST['expirydate'];
//$avail="YES";
$result="SELECT `categoryid` FROM  `pharmacy`.`category` WHERE `categoryname`='$categoryname';";
$resultSet=$con->query($result);
 while($rows=$resultSet->fetch_assoc()){
     $categoryid=$rows['categoryid'];
 }
//$rows=$resultSet->fetch_assoc();
//$categoryid=$rows['categoryid'];
 $sql="INSERT INTO `pharmacy`.`drugs` (`DRUGCODE`,`DRUGNAME`) VALUES ('$drugcode','$drugname');";
 $sql1="INSERT INTO `pharmacy`.`drugsinfo`(`DRUGCODE`,`CATEGORYID`,`EXPIRYDATE`,`MFGDATE`,`MRP`) VALUES ('$drugcode','$categoryid','$expdate','$mfgdate','$mrp');";
 $sql3="INSERT IGNORE INTO `pharmacy`.`stock` (`DRUGCODE`,`CATEGORYID`,`QUANTITY`) VALUES ('$drugcode','$categoryid','0');";
// if(($con->query($sql)==true)&&($con->query($sql1)==true)){
//    // echo"successfully inserted";
//    echo "<script>alert('SUCCESSFULLY INSERTED!!!');window.location='adddrugs.php'</script>";
// }
// else{
//    // echo"Error: $sql<br> $con->error";
//    echo "<script>alert('INVALID INSERTION!!!');window.location='adddrugs.php'</script>"; 
// }
if(($con->query($sql)==true)||($con->query($sql)==false)){
    if(($con->query($sql1)==true)&&($con->query($sql3)==true)){
        echo "<script>alert('SUCCESSFULLY INSERTED!!!');window.location='adddrugs.php'</script>";
    }
    else{
        echo "<script>alert('ALREADY EXISTS!!!');window.location='adddrugs.php'</script>";
    }
}

$con->close();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-DRUGS</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/drugs.css"> -->
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
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
           
        <li><a href="adddrugs.php" style="color: white;" >ADD DRUGS</a></li>
          
          <li><a href="modifydrugs.php">CHANGE DRUG DETAILS</a></li>
          
          <li><a href="deletedrugs.php">REMOVE DRUGS</a></li>
         
          <li><a href="viewdrugs.php">DRUG DETAILS</a></li>
          <li><a href="expire.php">DRUGS ABOUT TO EXPIRE</a></li>
        </ul>
</nav>
</div>
    <div id="div2" class="scroll">
        <form action="adddrugs.php" method="POST">
            <br>
           <p>DRUG CODE:</p>
            <input type="text" name="drugcode" id="adtext" placeholder="DCxxxx" required><br>
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
          
          <p>MANUFACTURING DATE:</p><input type="date" name="mfgdate" id="adtext" placeholder="Enter Mfg Date" required><br>
          <p>EXPIRY DATE:</p><input type="date" name="expirydate" id="adtext" placeholder="Enter Expiry Date" required><br>
          <p>MRP:</p><input type="text" name="mrp" id="adtext" placeholder="Enter MRP" required><br>
          <br>  <button type="submit" class="btn" name="add"><b>ADD</b></button><br><br>
         
        </form>
    </div>
</body>
</html>