<?php
include 'dbcon.php';
if(isset($_POST['purchase'])){
$drugname=$_POST['drugname'];
$categoryname=$_POST['categoryname'];
$companyname=$_POST['companyname'];
$branch=$_POST['branch'];
$buyingprice=$_POST['buyingprice'];
$quantity=$_POST['quantity'];
$sql="SELECT `drugcode` FROM  `pharmacy`.`drugs` WHERE `drugname`='$drugname';";
    $result= $con->query($sql);
    while($rows=$result->fetch_assoc()){
        $drugcode=$rows['drugcode'];
    }
$sql1="SELECT `categoryid` FROM  `pharmacy`.`category` WHERE `categoryname`='$categoryname';";
$result1=$con->query($sql1);
 while($rows=$result1->fetch_assoc()){
     $categoryid=$rows['categoryid'];
 }
 $sql2="SELECT `cid` FROM  `pharmacy`.`company1` WHERE `companyname`='$companyname';";
$result2=$con->query($sql2);
 while($rows=$result2->fetch_assoc()){
     $cid=$rows['cid'];
 }
 $sql3="INSERT INTO `pharmacy`.`purchase` (`drugcode`,`categoryid`,`cid`,`branch`,`purchasedate`,`buyingprice`,`quantity`) 
        VALUES ('$drugcode','$categoryid','$cid','$branch',CURDATE(),'$buyingprice','$quantity');";
 if($con->query($sql3)==true){
    echo "<script>alert('SUCCESSFULLY PURCHASED!!!');window.location='purchase.php'</script>";
   //echo"Error: $sql3<br> $con->error";
 }
 //here two errors possibilities-same drug from same company can't buy on same day and 
//-if category of that drug is not there in drugs info it should show "this type of drug is not available in store"
 elseif(mysqli_errno($con) == 1062){
    echo "<script>alert('ALREADY PURCHASED TODAY!!!');window.location='purchase.php'</script>";
    //echo"Error:  $con->error";
 }
 else{
    //echo "<script>alert('NOT AVAILABLE!!!');window.location='purchase.php'</script>";
    echo"Error: $sql3<br> $con->error";
 }
 

 $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-PURCHASE</title>
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
</head>
<body>
    <div id="div1">
      <!--<button id="duser">
    <img src="img/user.png" alt="user" width="50px" height="50px">
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
         
         <li><a href="modifycompany.php">CHANGE COMPANY DETAILS</a></li>
         <!-- <br><br>
         <li><a href="deletecompany.html"></a></li> -->
        
         <li><a href="viewcompany.php">COMPANY DETAILS</a></li>
         
         <li><a href="purchase.php" style="color: white;">PURCHASE</a></li>
        
         <li><a href="viewpurchases.php">PURCHASE DETAILS</a></li>

        </ul>
</nav>
</div>
<!--800px-->
        <div id="div2" class="scroll">
            <form action="purchase.php" method="POST">
            <br>
            <p>DRUG NAME:</p>
            <input type="text" name="drugname" id="adtext" placeholder="Enter drug name" required><br>
            <p>CATEGORY:</p>
           <!-- <input type="text" name="categoryname" id="adtext" placeholder="Enter Category">-->
           <!-- dropdownphp -->
           <?php
           include 'dbcon.php';
           $sql="SELECT `categoryname` FROM `pharmacy`.`category`";
           $resultSet=$con->query($sql);
          
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

            <p>COMPANY NAME:</p>
            <input type="text" name="companyname" id="adtext" placeholder="Enter Company Name" required><br>
            <p>BRANCH:</p> <input type="text" name="branch" id="adtext" placeholder="Enter Branch" required><br>
            
            
            <p>QUANTITY:</p> <input type="text" name="quantity" id="adtext" placeholder="Enter Quantity" required><br>
            <p>BUYINGPRICE:</p> <input type="text" name="buyingprice" id="adtext" required><br>
            <br>  <button type="submit" class="btn" name="purchase"><b>PURCHASE</b></button><br><br>
            </form>
            
        </div>
</body>
</html>