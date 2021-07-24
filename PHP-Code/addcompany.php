<?php
session_id("session1");
session_start();
include 'dbcon.php';

if(isset($_POST['add'])){
    $cid=$_POST['cid'];
    $companyname=$_POST['companyname'];
    $branch=$_POST['branch'];
    $salesexecutive=$_POST['salesexecutive'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $sid=$_POST['sid'];
    $sql="INSERT INTO `pharmacy`.`company1` (`cid`,`companyname`) VALUES ('$cid','$companyname');";
    $sql1="INSERT INTO `pharmacy`.`company2`(`cid`,`branch`,`sales_executive`,`email`,`phone`,`sid`) VALUES ('$cid','$branch','$salesexecutive','$email','$phone','$sid');";
    //$sql3="INSERT INTO `pharmacy`.`company3` (`cid`,`branch`,`phone`) VALUES ('$cid','$branch','$phone');";
    if(($con->query($sql)==true)||($con->query($sql)==false)){
        if($con->query($sql1)==true){
            echo "<script>alert('SUCCESSFULLY INSERTED!!!');window.location='addcompany.php'</script>";
        }
        else{
            echo "<script>alert('ALREADY EXISTS!!!');window.location='addcompany.php'</script>";
            //echo"Error: $sql1<br> $con->error";
        }   
    }

}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-COMPANY</title>
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
           
            <li id="change">COMPANY</li>   <!--change-->
         
            <li><a href="addcompany.php"  style="color: white;">ADD COMPANY </a></li>
         
         <li><a href="modifycompany.php">CHANGE COMPANY DETAILS</a></li>
         <!-- <br><br>
         <li><a href="deletecompany.html"></a></li> -->
        
         <li><a href="viewcompany.php">COMPANY DETAILS</a></li>
         
         <li><a href="purchase.php">PURCHASE</a></li>
        
         <li><a href="viewpurchases.php">PURCHASE DETAILS</a></li>

        </ul>
</nav>
</div>
<!--900px-->
        <div id="div2" class="scroll">
            <form action="addcompany.php" method="POST">
            <br>
            <p>COMPANY ID:</p>
            <input type="text" name="cid" id="adtext" placeholder="Enter Company ID" required><br>
            <p>COMPANY NAME:</p> <input type="text" name="companyname" id="adtext" placeholder="Enter Company Name" required><br>
            <p>BRANCH:</p> <input type="text" name="branch" id="adtext" placeholder="Enter Branch" required><br>
            <p>SALES EXECUTIVE:</p> <input type="text" name="salesexecutive" id="adtext" placeholder="Enter Sales Executive name" required><br>
            <p>E MAIL ID:</p> <input type="text" name="email" id="adtext" placeholder="Enter e-mail id" required><br>
            <p>PHONE NUMBER:</p> <input type="text" name="phone" id="adtext" placeholder="Enter Phone number" required><br>
            <!-- <p>PHONE NUMBER2(if any):</p> <input type="text" name="phone2" id="adtext" placeholder="Enter Phone number"><br>
            <p>PHONE NUMBER3(if any):</p> <input type="text" name="phone3" id="adtext" placeholder="Enter Phone number"><br> -->
            <p>STAFF ID:</p> <input type="text" name="sid" id="adtext" value="<?php echo($_SESSION['SID']);?>" readonly><br>
            <br>  <button type="submit" class="btn" name="add"><b>ADD</b></button><br><br>
            </form>
            
        </div>
</body>
</html>
<?php
session_write_close();
?>