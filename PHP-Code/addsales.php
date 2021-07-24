<?php
session_id("session1");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-Sales</title>
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/print.css?v=<?php echo time(); ?>" media="print">
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
</head>
<body>
    <div id="div1">
    <h1>PharmaCare</h1>
    <form action="refresh.php">
 <button type="submit" name="refresh" style="margin-left:950px;margin-top:20px;border-radius:70%;background-color:rgba(225,225,225,0.2);">
 <img src="img/refresh1.jpg" alt="user" width="34px" height="34px" style="border-radius:80%;margin-top:2px;cursor:pointer;"></button>
 </form> 
 <?php
 include 'dbcon.php';
 if($_SESSION['ROLE']=="Pharmacist"){
    ?>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>
<?php
 }
 ?>
<?php
if($_SESSION['ROLE']=="Salesman"){
    ?>
    <a href="login.html" style="left: 80%;top: 6%;">LOG OUT</a>
    <?php
 }
 ?>

    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
            <br><br>
            <li id="change">SALES</li>   <!--change-->
            <br><br>
          <li><a href="addcustomer.php">ADD CUSTOMER </a></li>
          <!-- <br><br>
           <li><a href="modifycompany.php">MODIFY COMPANY</a></li> -->
           <!-- <br><br>
           <li><a href="deletecompany.html"></a></li> -->
           <br><br>
           <li><a href="viewcustomer.php">CUSTOMER DETAILS</a></li>
           <br><br>
           <li><a href="addsales.php" style="color: white;">SALES</a></li>
           <br><br>
           <li><a href="viewsales.php">SALES DETAILS</a></li>
        </ul>
        </nav>
       </div> 
       <!--1000px-->
       <div id="div2" class="scroll">
        <form action="as1.php" method="POST">
            <br>
            <p>CUSTOMERID:</p>
            <input type="text" name="custid" id="adtext" placeholder="Enter Customer id" required><br>
            <p>DRUGNAME:</p>
            <input type="text" name="drugname" id="adtext" placeholder="Enter drug name" required><br>
            
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
          <p>QUANTITY:</p> <input type="text" name="quantity" id="adtext" placeholder="Enter Quantity" required><br>
          <p>DISCOUNT:</p> <input type="text" name="discount" id="adtext" placeholder="Enter Discount" value="0"><br>
          <p>INVOICE NO:</p>
            <input type="text" name="invoiceno" id="adtext" value="<?php echo($_SESSION['invoiceno']);session_write_close();?>"required><br>
            <p>INVOICE DATE:</p>
            <input type="date" id="adtext" name="invoicedate" required><br>
          <p>STAFF ID:</p> <input type="text" name="sid" id="adtext" value="<?php echo($_SESSION['SID']);?>" readonly><br>
          <br><button type="submit" class="btn" name="add" style="margin-left:300px;"><b>ADD</b></button>
          <iframe src="print.php" style="display:none;" name="frame"></iframe>
<button onclick="frames['frame'].print();" class="btn btn-primary" id="print-btn" style="margin-left:90px;"><b>PRINT</b></button>
<br><br><br>
        </form>
        
    </div>
</body>
</html>
