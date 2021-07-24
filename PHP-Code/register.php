<?php
include 'dbcon.php';

if(isset($_POST['add'])){
$name=$_POST['name'];
$email=$_POST['email'];
$phno=$_POST['phno'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$joiningdate=$_POST['joiningdate'];
$street=$_POST['street'];
$city=$_POST['city'];
$pincode=$_POST['pincode'];
$state=$_POST['state'];
$role=$_POST['role'];
$password=$_POST['password'];
$sql="SELECT `sid` FROM `pharmacy`.`staff` ORDER BY `sid` DESC LIMIT 1;";
    $resultSet=$con->query($sql);
    while($rows=$resultSet->fetch_assoc()){
    $sid=$rows['sid'];
    }
   // $sid = substr( $sid, -1)+1;
   // $sid="S".$sid;
    
// $sql="INSERT INTO `pharmacy`.`address` (`STREET`,`CITY`,`STATE`,`PINCODE`) VALUES ('$street','$city','$state','$pincode');";
$sql1="INSERT INTO `pharmacy`.`staff` (`NAME`,`EMAIL`,`PHONE`,`GENDER`,`DOB`,`JOININGDATE`,`STREET`,`CITY`,`STATE`,`ROLE`,`PASSWORD`) 
       VALUES ('$name','$email','$phno','$gender','$dob','$joiningdate','$street','$city','$state','$role','$password');";
$sql2="INSERT INTO `pharmacy`.`address`(`street`,`city`,`state`,`pincode`) VALUES ('$street','$city','$state','$pincode');";
//if($con->query($sql)==true){
    if(($con->query($sql1)==true)&&($con->query($sql2)==true)){
        echo "<script>alert('SUCCESSFULLY REGISTERED !!!');window.location='login.html'</script>";
    }
    else{
        echo "<script>alert('REGISTRATION UNSUCCESSFULL !!!');window.location='register.php'</script>";
      //  echo"Error: $sql2<br> $con->error";
       // echo $sid;
    }
//}
// else{
//     if($con->query($sql1)==true){
//         echo "<script>alert('SUCCESSFULLY REGISTERED !!!');window.location='login.html'</script>";
//     }
//     else{
//         echo "<script>alert('REGISTRATION UNSUCCESSFULL !!!');window.location='register.php'</script>";
//     }
// }
$con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-REGISTER</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/drugs.css"> 
    <link rel="stylesheet" type="text/css" href="css/drugs2.css">
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css"> -->
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    
</head>
<body>
        <!-- <h1>Pharmacy Store</h1> -->
        <div class="register" class="scroll">
          <BR>  <h2>REGISTRATION FORM</h2><BR>
            <form method="post" id="register" action="register.php">
           <pre><label>Name :</label>         <input type="text" name="name" id="name1" placeholder="Enter Name" required><br><br></pre>
<label>Gender :</label>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="gender" value="M" id="male"><span id="male">&nbsp; Male</span>
               
                <input type="radio" name="gender" value="F" id="male"><span id="male">&nbsp; Female</span>&nbsp;&nbsp;
                <input type="radio" name="gender" value="O" id="male"><span id="male">&nbsp; Other</span>&nbsp;&nbsp;<br><br>
           <pre><label>Date of Birth :</label>   <input type="date" name="dob" id="name1" placeholder="Enter Date of Birth" required>
<label>Email :</label>         <input type="email" name="email" id="name1" placeholder="Enter E-mail" required>      
<label>Mobile number :</label> <input type="text" name="phno" id="name1" placeholder="Enter Mobile Number" required maxlength="10"><br><br></pre>
                
                <p><h3>Address :</h3></p><br>
            <pre><label>Street :</label>                                            <label>City :</label>
<input type="text" name="street" id="name" placeholder="Enter Street" required>     <input type="text" name="city" id="name" placeholder="Enter City" required><br></pre>
<pre><label>Pincode :</label>                                            <label>State :</label>
<input type="text" name="pincode" id="name" placeholder="Enter Pincode" required>     <input type="text" name="state" id="name" placeholder="Enter State" required><br></pre> 
                <label>Joining Date :</label><br>
                <input type="date" name="joiningdate" id="name" placeholder="Enter Joining Date" required><br><br> 
               <label>Role :</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="role" id="male" value="Pharmacist"><span id="male">&nbsp; Pharmacist</span>&nbsp;&nbsp;
                <input type="radio" name="role" id="male" value="Salesman"><span id="male">&nbsp; Salesman</span>&nbsp;&nbsp;<br><br>
                <pre><label>Password :</label>       <input type="password" name="password" id="name" placeholder="XXXXXXXXXX" required maxlength="10"></pre><br><br>
                <button type="submit" name="add" id="sub" class="btn"><b>REGISTER</b></button><br><br>
                <!--<input type="submit" value="Register" id="sub">-->
            </form>
        </div>
    </body>
</html>