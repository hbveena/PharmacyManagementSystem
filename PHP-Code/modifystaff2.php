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
    // $joiningdate=$_POST['joiningdate'];
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
           SET `PHONE`='$phno', `GENDER`='$gender',`DOB`='$dob',`STREET`='$street',`CITY`='$city',`STATE`='$state'  
           WHERE (`EMAIL`='{$_SESSION['email']}');";
   
    
   
       if($con->query($sql1)==true){
         echo "<script>alert('SUCCESSFULLY UPDATED !!!');window.location='modifystaff.php'</script>";
         //echo "Error: ". $sql1 ."<br>". $con->error;
   }
   else{
   echo "<script>alert('UPDATE UNSUCCESSFULL !!!');window.location='modifystaff.php'</script>";
    //echo "Error: ". $sql1 ."<br>". $con->error;
   }
}

session_write_close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-STAFF</title>
    <link rel="stylesheet" type="text/css" href="css/adddrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div id="div1">
    <h1>PharmaCare</h1>  
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.php" style="left: 90%;top: 6%;">LOG OUT</a>
    </div>
   
    <div id="wrapper">
        <nav id="sidebar-wrapper">
        <ul class="nav-list">
        
            <li id="change">STAFF</li>
        
           <li><a href="modifystaff.php" style="color: white;">UPDATE STAFF DETAILS</a></li>
         
           <li><a href="deletestaff.php">DELETE STAFF</a></li>
           
           <li><a href="viewstaff.php">VIEW STAFF</a></li>
        </ul>
</nav>
        </div>
    <div id="div2" style="height:400px;" class="scroll">
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
        
         $sql="SELECT `phone`,`gender`,`dob`,`staff`.`street`,`staff`.`city`,`pincode`,`staff`.`state`,`password`,`joiningdate` 
               FROM `pharmacy`.`staff`,`pharmacy`.`address` 
               WHERE `pharmacy`.`staff`.`name`='$name' AND `pharmacy`.`staff`.`email`='$email';";
     $result = $con->query($sql);
     if($result->num_rows>0){
     while ($rows = $result->fetch_assoc()){
         $phno=$rows['phone'];
         $gender=$rows['gender'];
         $dob=$rows['dob'];
         $street=$rows['street'];
         $city=$rows['city'];
        //  $pincode=$rows['pincode'];
         $state=$rows['state'];
         $password=$rows['password'];
        //  $joiningdate=$rows['joiningdate'];
     }
    }
    else{
        echo "<script>alert('STAFF NOT FOUND!!!');window.location='modifystaff.php'</script>";
       
        //echo "Error in $sql<br> $con->error";
    }
     $_SESSION['email']=$email;
    ?>
     <div id="div2" style="height:800px;">
        <form action="<?php $_PHP_SELF ?>" method="post" id="register">
        
           <pre><label>Name :</label>         <input type="text" name="name" id="name1" placeholder="Enter Name"  value="<?php echo "$name";?> " readonly><br><br></pre>
<label>Gender :</label>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="gender" value="M" value="M" <?php echo ($gender== 'M') ?  "checked" : "" ;  ?> id="male"><span id="male">&nbsp; Male</span>
               
                <input type="radio" name="gender" value="F" value="F" <?php echo ($gender== 'F') ?  "checked" : "" ;  ?> id="male"><span id="male">&nbsp; Female</span>&nbsp;&nbsp;
                <input type="radio" name="gender" value="O" <?php echo ($gender== 'O') ?  "checked" : "" ;  ?> id="male"><span id="male">&nbsp; Other</span>&nbsp;&nbsp;<br><br>
           <pre><label>Date of Birth :</label>  <input type="text" name="dob" id="name1" placeholder="Enter Date of Birth" value="<?php echo "$dob";?>" required>
<label>Email :</label>           <input type="email" name="email" value="<?php echo "$email";?> " id="name1" placeholder="Enter E-mail"  readonly>      
<label>Mobile number :</label><input type="text" name="phno" id="name1" placeholder="Enter Mobile Number" required maxlength="10" value="<?php echo "$phno";?>"><br><br></pre>
                
                <p><h3>Address :</h3></p><br>
            <pre><label>Street :</label>                                                        <label>City :</label>
<input type="text" name="street" id="name" value="<?php echo "$street";?> " placeholder="Enter Street" required>     <input type="text" name="city" id="name" value="<?php echo "$city";?> " placeholder="Enter City" required><br><br></pre>
<pre><label>Pincode :</label>                                                      <label>State :</label>
<input type="text" name="pincode" id="name" value="<?php echo "$pincode";?> " placeholder="Enter Pincode" required>     <input type="text" name="state" id="name" value="<?php echo "$state";?> " placeholder="Enter State" required><br><br></pre>
                
 
                <pre><label>Password :</label><input type="password" name="password" id="name" value="<?php echo "$password";?> " placeholder="XXXXXXXXXX" required maxlength="10"></pre><br><br>
                <button type="submit" name="modify" id="sub" class="btn" style="margin-left:300px;"><b>MODIFY</b></button><br><br>
                
            </form>
        </div>
        <?php
     }
     ?>
</body>
</html>
