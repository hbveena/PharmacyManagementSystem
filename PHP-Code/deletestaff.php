<?php

include 'dbcon.php';

if(isset($_POST['delete'])){
    $name=$_POST['name'];
    $email=$_POST['email'];

    $sql="UPDATE `pharmacy`.`staff` 
          SET `password`=NULL
          WHERE `email`='$email';";
    if($con->query($sql)==true){
        echo "<script>alert('SUCCESSFULLY DELETED!!!');window.location='deletestaff.php'</script>";
    }
    else{
        // echo "<script>alert('INVALID DELETION!!!');window.location='deletestaff.php'</script>";
        echo "Error: ". $sql ."<br>". $con->error;
    }
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaCare-STAFF</title>
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
        
            <li id="change">STAFF</li>
            <li><a href="modifystaff.php">CHANGE STAFF DETAILS</a></li>
           
           <li><a href="deletestaff.php" style="color: white;">REMOVE STAFF</a></li>
           
           <li><a href="viewstaff.php">STAFF DETAILS</a></li>
        </ul>
        </nav>
    </div>
    <div id="div2" style="height:400px;" class="scroll">
        <form action="deletestaff.php" method="POST">
        <br>
            <p>NAME :</p>
            <input type="text" name="name" id="adtext" placeholder="Enter Name"><br>
            <p>E MAIL:</p> 
            <input type="text" name="email" id="adtext" placeholder="Enter E-mail"><br>
            <br><br><br><button type="submit" class="btn" name="delete"><b>DELETE</b></button><br>
        </form>
    </div>
</body>
</html>