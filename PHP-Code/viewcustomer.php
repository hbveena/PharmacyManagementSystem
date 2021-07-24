<?php
if(isset($_POST['search'])){
$value=$_POST['value3'];
$sql="SELECT* FROM CUSTOMER
-- AND D.`DRUGNAME`='$value';
WHERE CONCAT(`CUSTID`,`CUSTNAME`,`PHONENO`)
 LIKE '%".$value."%';";
$sresult=searchtable($sql);

}
else{
    $sql="SELECT* FROM CUSTOMER;";
    $sresult=searchtable($sql);
}
function searchtable($sql){
    include 'dbcon.php';
    $qresult=mysqli_query($con,$sql);
    return $qresult;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacare-Customer</title>
    <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
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
        
            <li id="change">SALES</li>
            
          <li><a href="addcustomer.php">ADD CUSTOMER </a></li>
          <!-- <br><br>
           <li><a href="modifycompany.php">MODIFY COMPANY</a></li> -->
           <!-- <br><br>
           <li><a href="deletecompany.html"></a></li> -->
           
           <li><a href="viewcustomer.php"  style="color: white;">CUSTOMER DETAILS</a></li>
           
           <li><a href="addsales.php">SALES</a></li>
           
           <li><a href="viewsales.php">SALES DETAILS</a></li>
        </ul>
         </nav>
        </div>
    <div id="div2" class="scroll">
    <br>
        <form action="viewcustomer.php" method="POST">
    <input type="text" id="search" placeholder="Search.." name="value3">
    <button type="submit" id="searchbtn" name="search" value="search"><img src="img/search.png" style="width:30px;height:30px;"></button>
       <table>
           <tr>
               <br><br>
           <th>CUSTOMER ID</th> <!--change-->
           <th>CUSTOMER NAME</th>
           <th>PHONE NO</th>
           
           
        </tr>
        <?php
        
         //changes
        //$result=$conn->query($sql);
        //if($result->num_rows>0){
            while($row=$sresult->fetch_assoc()){  //change
                echo "<tr><td>".$row["CUSTID"]."</td><td>".$row["CUSTNAME"]."</td><td>".$row["phone"]."</td><td>";

            }
        //     echo "</table>";
        // }
        // else{
        //     echo "0 result";
        // }
        // $conn->close();
        ?>

       </table> 
       <br><br>
       </form>
    </div>
</body>
</html>