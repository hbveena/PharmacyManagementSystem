<?php
session_id("session2");
session_start();
?>
<?php
include 'dbcon.php';
if(isset($_POST['add'])){
    $custid=$_POST['custid'];
    $drugname=$_POST['drugname'];
    $categoryname=$_POST['categoryname'];
    $quantity=$_POST['quantity'];
    $discount=$_POST['discount'];
    $invoiceno=$_POST['invoiceno'];
    $per=100;
    $sid=$_POST['sid'];
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
 

 $sql2="SELECT `mrp` FROM `pharmacy`.`drugsinfo` WHERE `drugcode`='$drugcode' AND `categoryid`='$categoryid';";
 $resultSet=$con->query($sql2);
   while($rows=$resultSet->fetch_assoc()){
   $mrp=$rows['mrp'];
  }
$totalprice=($quantity*$mrp)-(($quantity*$mrp)*($discount/$per));
//setcookie('totalprice', $totalprice);
$sql="CALL pharmacy.checkavailability('$drugcode','$categoryid');";
// $result=mysqli_multi_query($con,$sql);

// while($row = mysqli_fetch_assoc($result)){
//     if($con->multi_query($sql)){
//      if($result=$con->use_result()){
//      while ($row = $result->fetch_row()) {
//          $q=$row[0];
//      }
//      $result->close();
//     }
// }
if ($result=mysqli_query($con,$sql))
  {
  
  while ($row=mysqli_fetch_row($result))
    {
        $q=$row[0];
   //echo $row[0];
    }
 }
 
 mysqli_free_result($result);
 mysqli_close($con);
 include 'dbcon.php';
//  if($q==NULL){
//     echo "<script>alert('NOT AVAILABLE!!!');window.location='addsales2.php'</script>";
// }
if($q==NULL){
   echo "<script>alert('NOT AVAILABLE!!!');window.location='addsales2.php'</script>";
}
$sql="SELECT `expirydate` FROM `pharmacy`.`drugsinfo` WHERE `drugcode`='$drugcode' AND `categoryid`='$categoryid';";
     $result = $con->query($sql);
     if($result->num_rows>0){
     while ($rows = $result->fetch_assoc()){
         $expirydate=$rows['expirydate'];
     }
    }
    else{
      echo "<script>alert('DRUG NOT FOUND!!!');window.location='addsales2.php'</script>";
  }
  if($quantity>$q){
     
   echo "<script>alert('OUT OF STOCK!!!AVAILABLE:$q');window.location='addsales2.php'</script>";
   //echo"Error: $sql1<br> $con->error";
}
 // $today=CURDATE();
 $date_now = date("Y-m-d"); 
if(($quantity<=$q)&&($expirydate > $date_now)){
    
$sql1="INSERT IGNORE INTO `pharmacy`.`sales1`(`invoiceno`,`invoicedate`) VALUES ('$invoiceno',CURDATE());";
$sql2="INSERT IGNORE INTO `pharmacy`.`sales2`(`invoiceno`,`sid`) VALUES ('$invoiceno','$sid');";
 $sql3="INSERT INTO `pharmacy`.`sales3`(`invoiceno`,`drugcode`,`categoryid`,`custid`,`quantity`,`totalprice`) VALUES ('$invoiceno','$drugcode','$categoryid','$custid','$quantity','$totalprice');";
 
 
  
if(($con->query($sql1)==true)&&($con->query($sql2)==true)&&($con->query($sql3)==true)){
    echo "<script>alert('SUCCESSFULLY SOLD $expirydate!!!');window.location='addsales2.php'</script>";
   
   }
   else{
       echo "<script>alert('NOT AVAILABLE!!!');window.location='addsales2.php'</script>";
       //echo"Error: $sql1<br> $con->error";
   }
   $arr_var=array($invoiceno,$custid);
//    $_SESSION['drugname']=$drugname;
//    $_SESSION['quantity']=$invoiceno;
//    $_SESSION['categoryname']=$categoryname;
   $_SESSION['invoiceno']=$invoiceno;
   $_SESSION['custid']=$custid;
}
else{
   echo "<script>alert('DRUG IS EXPIRED : Expiry date: $expirydate!!!');window.location='addsales2.php'</script>";
}


}
header("location:addsales2.php");

//$con->close();
?>