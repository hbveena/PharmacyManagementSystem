<?php
include 'dbcon.php';
if(isset($_POST['add'])){
$custid=$_POST['custid'];
$customername=$_POST['customername'];
$phoneno=$_POST['phoneno'];
$sql="INSERT INTO `pharmacy`.`customer` VALUES ('$custid','$customername','$phoneno');";
if($con->query($sql)==true){
    echo "<script>alert('SUCCESSFULLY INSERTED!!!');window.location='addcustomer.php'</script>";
}
else{
   echo "<script>alert('INVALID INSERTION!!!');window.location='addcustomer.php'</script>";
    //echo"Error: $sql<br> $con->error";
}
}
$con->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-CUSTOMER</title>
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
</head>
<body>
    <div id="div1">
    <h1>PharmaCare</h1>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a> 
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
           
            <li id="change">SALES</li>   <!--change-->
           
            <li><a href="addcustomer.php"  style="color: white;">ADD CUSTOMER </a></li>
          
           
          <li><a href="viewcustomer.php">CUSTOMER DETAILS</a></li>
          
          <li><a href="addsales.php">SALES</a></li>
          
          <li><a href="viewsales.php">SALES DETAILS</a></li>
        </ul>
        </nav>
       </div> 
       <div id="div2" class="scroll">
        <form action="addcustomer.php" method="POST">
            <br>
            <p>CUSTOMER ID:</p>
            <input type="text" name="custid" id="adtext" placeholder="CTxxxxx" required><br>
          <p>CUSTOMER NAME:</p> <input type="text" name="customername" id="adtext" placeholder="Enter Customer Name" required><br>
          <p>PHONE:</p> <input type="text" name="phoneno" id="adtext" placeholder="Enter Customer Contact no" required><br>
         
          <br>  <button type="submit" class="btn" name="add"><b>ADD</b></button><br>
         
        </form>
    </div>
</body>
</html>