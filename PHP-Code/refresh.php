<?php

include 'dbcon.php';
$sql1="SELECT `invoiceno` FROM `pharmacy`.`sales3` ORDER BY `invoiceno` DESC LIMIT 1;";
$resultSet=$con->query($sql1);
while($rows=$resultSet->fetch_assoc()){
$invoiceno=$rows['invoiceno'];
}
$invoiceno=$invoiceno+1;
$_SESSION['invoiceno']=$invoiceno;
header("location:addsales.php");
?>