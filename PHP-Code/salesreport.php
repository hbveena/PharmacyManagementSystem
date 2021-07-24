<?php
if(isset($_POST['generate'])){
    $fromdate=$_POST['finvoicedate'];
    $todate=$_POST['tinvoicedate'];
    $sql="SELECT `invoicedate`,sum(`totalprice`) AS PRICE from `pharmacy`.`sr`
            where `invoicedate` in (select `invoicedate` from SR group by `invoicedate`)
            group by `invoicedate`
            HAVING `INVOICEDATE` BETWEEN '$fromdate' AND '$todate';";
$sresult=searchtable($sql);
}
else{
    $fromdate=date('Y-m-01');
    $todate=date('Y-m-t');
    $sql="SELECT `invoicedate`,sum(`totalprice`) AS PRICE from `pharmacy`.`sr`
    where `invoicedate` in (select `invoicedate` from SR group by `invoicedate`)
    group by `invoicedate`
    HAVING  `INVOICEDATE` BETWEEN '$fromdate' AND '$todate';";
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
   <link rel="stylesheet" type="text/css" href="css/viewdrugs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/drugs.css?v=<?php echo time(); ?>"> 
    <link rel="icon" href="img/favicon1.jpg" type="image/jpg" size="50px">
    <style>
#div2{
    margin-left: 320px;
    margin-top: 30px;
 } 
        </style>
</head>
<body style="background-color: aliceblue;">
<div id="div1">
   
<h1>PharmaCare</h1>
<a href="dashboard1.php" style="left:80%;top:6%;">HOME</a>
<a href="login.html" style="left: 90%;top: 6%;">LOG OUT</a>

    </div>
    <div id="div2">
    <form action="salesreport.php" method="POST">
    <label>FROM</label>
    <input type="date" name="finvoicedate" id="srtext" required>&emsp;&emsp;&emsp;&emsp;
    <label>TO</label>
    <input type="date" name="tinvoicedate" id="srtext" required>&emsp;&emsp;&emsp;&emsp;
    <button type="submit" id="viewbtn" name="generate" value="generate">GENERATE</button>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['INVOICEDATE','PRICE'],
          <?php
          include 'dbcon.php';
          $sql="SELECT `INVOICEDATE`,sum(`totalprice`) AS PRICE from `pharmacy`.`SR`
          where `INVOICEDATE` in (select `INVOICEDATE` from SR group by `INVOICEDATE`)
          group by `INVOICEDATE`
          HAVING `INVOICEDATE` BETWEEN '$fromdate' AND '$todate';";
          $re=mysqli_query($con,$sql);
          while($row=mysqli_fetch_assoc($re)){  //change
            echo "['".$row['INVOICEDATE']."',".$row['PRICE']."],";

        }
          ?>

          ]);

        var options = {
          chart: {
            title: 'SALES REPORT',
            
            backgroundColor: 'none'
          }
        };
        
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <br>
            </form>
            
    </div>
    <div id="columnchart_material" style="width: 1150px; height: 400px;margin:50px 60px;"></div>
</body>
</html>