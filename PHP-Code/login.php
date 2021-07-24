<?php
session_id("session1");
session_start();
    include 'dbcon.php';
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $sql="SELECT `sid` FROM `pharmacy`.`staff` WHERE `email`='$email' AND `password`='$password';";
    $resultSet=$con->query($sql);
   while($rows=$resultSet->fetch_assoc()){
      $sid=$rows['sid'];
    }
    $_SESSION['SID']=$sid;
    $sql1="SELECT `invoiceno` FROM `pharmacy`.`sales3` ORDER BY `invoiceno` DESC LIMIT 1;";
    $resultSet=$con->query($sql1);
    while($rows=$resultSet->fetch_assoc()){
    $invoiceno=$rows['invoiceno'];
    }
    $invoiceno=$invoiceno+1;
    $_SESSION['invoiceno']=$invoiceno;
    $_SESSION['ROLE']=$role;
    //include 'refresh.php';
    
    if($con->connect_error){
        die("Failed to connect : ".$con->connect_error);
    }
    else{
        $query="select* from pharmacy.staff where email='$email' and password='$password' and role='$role'";
        $result=mysqli_query($con,$query);
        $count=mysqli_num_rows($result);
        
        if($count>0 && $role=="Pharmacist"){
            //echo "login successful";
            //echo"Error: $sql<br> $con->error";
            header("location:dashboard1.php");
           
        }
        else if($count>0 && $role=="Salesman"){
           // echo"Error: $sql<br> $con->error";
           
            header("location:addsales.php");
        }
        else{
            echo "<script>alert('INVALID E-MAIL OR PASSWORD!!!');window.location='login.html'</script>";
           // echo"Error: $sql<br> $con->error";
        }
    }
       
    
?>

