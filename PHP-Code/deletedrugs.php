<?php
include 'dbcon.php';
if(isset($_POST['delete'])){
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
    $sql="CALL pharmacy.checkavailability('$drugcode','$categoryid');";
    $result=$con->query($sql);
    if($result==FALSE){
        echo "<script>alert('NOT AVAILABLE!!!');window.location='addsales2.php'</script>";
    }
else{
  while ($row=mysqli_fetch_row($result))
    {
        $q=$row[0];
    }
 mysqli_free_result($result);
 mysqli_close($con);
 include 'dbcon.php';
 if($q>0){
    echo "<script>alert('INVALID DELETION : STOCK AVAILABLE : $q!!!');window.location='deletedrugs.php'</script>";
}
if($q==NULL){
    echo "<script>alert('DRUG NOT AVAILABLE!!!');window.location='deletedrugs.php'</script>";
}
 if($q==0){
 $sql2="DELETE FROM `pharmacy`.`stock` WHERE `drugcode`='$drugcode' AND `categoryid`='$categoryid';";
    $sql1="DELETE FROM `pharmacy`.`drugsinfo`  WHERE `drugcode`='$drugcode' AND `categoryid`='$categoryid';";
    if($con->query($sql2)==true){
        if($con->query($sql1)==true){
        echo "<script>alert('SUCCESSFULLY DELETED!!!');window.location='deletedrugs.php'</script>";
        }
    
    else{
        echo "<script>alert('DRUG NOT AVAILABLE!!!');window.location='deletedrugs.php'</script>";
        //echo"Error: $sql1<br> $con->error";
    }
    }
    else{
        echo "<script>alert('DRUG NOT AVAILABLE!!!');window.location='deletedrugs.php'</script>";
        //echo"Error: $sql2<br> $con->error";  
    }
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
           
            <li><a href="adddrugs.php">ADD DRUGS</a></li>
          
          <li><a href="modifydrugs.php">CHANGE DRUG DETAILS</a></li>
          
          <li><a href="deletedrugs.php" style="color: white;">REMOVE DRUGS</a></li>
         
          <li><a href="viewdrugs.php">DRUG DETAILS</a></li>
          <li><a href="expire.php">DRUGS ABOUT TO EXPIRE</a></li>
        </ul>
        </nav>
    </div>
    <div id="div2" style="height:400px;" class="scroll">
        <form action="deletedrugs.php" method="POST">
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
            <br><br><br><button type="submit" class="btn" name="delete"><b>DELETE</b></button><br>
        </form>
    </div>
</body>
</html>