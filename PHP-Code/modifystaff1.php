<?php
session_id("session4");
session_start();
include 'dbcon.php';
//header("location:modifydrugs.php");
if(isset($_POST['modify'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phno=$_POST['phno'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    // $pincode=$_POST['pincode'];
    $state=$_POST['state'];
    $joiningdate=$_POST['joiningdate'];
    $password=$_POST['password'];
     
    // $sql5="SELECT `street`,`city`,`state`,`pincode`
    //        FROM `pharmacy`.`address`;"; 
           
    //        $result5 = $con->query($sql5);
    //        if($result5->num_rows>0){
    //        while ($rows = $result5->fetch_assoc()){
    //            $street1=$rows['street'];
    //            $city1=$rows['city'];
    //            $pincode1=$rows['pincode'];
    //            $state1=$rows['state'];
    //        }
    //       }
    //       else{
    //         echo "Error: ". $sql ."<br>". $con->error;
    //       }

    // $sql="REPLACE INTO `pharmacy`.`address` (`STREET`,`CITY`,`STATE`,`PINCODE`) 
    //       SET `street`='$street',
    //           `city`='$city',
    //           `state`='$state',
    //           `pincode`='$pincode';";

    $sql1="UPDATE `pharmacy`.`staff` 
           SET `PHONE`='$phno', `PASSWORD`='$password', `GENDER`='$gender',`DOB`='$dob',`STREET`='$street',`CITY`='$city',`STATE`='$state'  
           WHERE (`EMAIL`='{$_SESSION['email']}') and (`NAME`='$name');";
   
    
  
       if($con->query($sql1)==true){
         //echo "<script>alert('SUCCESSFULLY UPDATED !!!');window.location='modifystaff.php'</script>";
         echo "Error: ". $sql1 ."<br>". $con->error;
   }
   else{
    //echo "<script>alert('UPDATE UNSUCCESSFULL !!!');window.location='modifystaff.php'</script>";
    echo "Error: ". $sql1 ."<br>". $con->error;
   }
}

session_write_close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHARMACY MANAGEMENT SYSTEM-STAFF</title>
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs2.css?v=<?php echo time(); ?>">
</head>
<body style="background-image: url(img/medicines.jpg);background-size:cover;">
    <div id="div1">
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.php" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <div id="sidebar-wrapper">
        <ul class="nav-list">
        <br><br>
            <li id="change">STAFF</li>
           <br><br>
           <li><a href="modifystaff.php" style="color: white;">UPDATE STAFF DETAILS</a></li>
           <br><br>
           <li><a href="deletestaff.php">DELETE STAFF</a></li>
           <br><br>
           <li><a href="viewstaff.php">VIEW STAFF</a></li>
        </ul>
</div>
        </div>
    <div id="div2" style="height:400px;">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <br>
            <p>NAME :</p>
            <input type="text" name="name" id="adtext" placeholder="Enter Name"><br>
            <p>E MAIL:</p> 
            <input type="text" name="email" id="adtext" placeholder="Enter E-mail"><br>
           
            <br><br><button  type="submit" class="btn" name="next"><b>NEXT</b></button><br>
        </form>
    </div>

    <?php
    session_id("session4");
    session_start();
    include 'dbcon.php';

     if(isset($_POST['next'])){
         $name=$_POST['name'];
         $email=$_POST['email'];
        
         $sql="SELECT `phone`,`gender`,`dob`,`staff`.`street`,`staff`.`city`,`staff`.`state`,`password`,`joiningdate` 
               FROM `pharmacy`.`staff` 
               WHERE `pharmacy`.`staff`.`name`='$name' AND `pharmacy`.`staff`.`email`='$email';";
     $result = $con->query($sql);
     if($result->num_rows>0){
     while ($rows = $result->fetch_assoc()){
         $phone=$rows['phone'];
         $gender=$rows['gender'];
         $dob=$rows['dob'];
         $street=$rows['street'];
         $city=$rows['city'];
        //  $pincode=$rows['pincode'];
         $state=$rows['state'];
         $password=$rows['password'];
         $joiningdate=$rows['joiningdate'];
     }
    }
    else{
        //echo "<script>alert('STAFF NOT FOUND!!!');window.location='modifystaff.php'</script>";
        //echo "Error: ". $sql ."<br>". $con->error;
        echo "Error in ".$query."<br>".$db->error;
    }
     $_SESSION['email']=$email;
    ?>
     <div id="div2" style="height:800px;">
        <form action="<?php $_PHP_SELF ?>" method="POST">
        <br>
        <p>Name :</p>
            <input type="text" name="name" id="adtext" placeholder="Enter Name" value="<?php echo "$name";?> " readonly><br>
        <p>Email :</p>
            <input type="email" name="email" id="adtext" placeholder="Enter E-mail" value="<?php echo "$email";?> " readonly><br>
        <p>Mobile number :</p>
            <input type="text" name="phno" id="adtext" placeholder="Enter Mobile Number" required maxlength="10" value="<?php echo "$phone";?>"><br>
        <p>Gender :</p>
            <input type="radio" name="gender" value="M" <?php echo ($gender== 'M') ?  "checked" : "" ;  ?> id="adtext"><span id="male">&nbsp; Male</span>&nbsp;&nbsp;
            <input type="radio" name="gender" value="F" <?php echo ($gender== 'F') ?  "checked" : "" ;  ?> id="adtext"><span id="male">&nbsp; Female</span>&nbsp;&nbsp;
            <input type="radio" name="gender" value="O" <?php echo ($gender== 'O') ?  "checked" : "" ;  ?> id="adtext"><span id="male">&nbsp; Other</span>&nbsp;&nbsp;<br>
        <p>Date of Birth :</p>
            <input type="date" name="dob" id="adtext" value="<?php echo "$dob";?>" required><br>
        <p>Joining Date :</p>
            <input type="date" name="joiningdate" id="adtext" value="<?php echo "$joiningdate";?>" readonly><br>
        <p><h3>Address :</h3></p>
        <p>Street :</p>
            <input type="text" name="street" id="adtext" placeholder="Enter Street" value="<?php echo "$street";?> " required><br>
        <p>City :</p>
            <input type="text" name="city" id="adtext" placeholder="Enter City" value="<?php echo "$city";?> " required><br>
        <!-- <p>Pincode :</p>
            <input type="text" name="pincode" id="name" placeholder="Enter Pincode" value="<?php echo "$pincode";?> " required maxlength="6"><br><br> -->
        <p>State :</p>
            <input type="text" name="state" id="adtext" placeholder="Enter State" value="<?php echo "$state";?> " required><br>
        <p>Password :</p>
            <input type="password" name="password" id="adtext" placeholder="XXXXXXXXXX" value="<?php echo "$password";?> " required maxlength="10"><br>

        <br>  <button type="submit" class="btn" name="modify"><b>UPDATE</b></button><br>
        </form>
        </div>
        <?php
     }
     ?>
</body>
</html>
