
<?php
session_start();
include "template.php";
require_once "config.php";
$view_dt=$view_dt_err=$view_dt_to="";
$pid=$_SESSION['id'];



?>

<!DOCTYPE html>
<html lang="=en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, intial-scale=1.0">
<title>Graph
</title>


</head>
<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                         unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-5">
                              
                    <div class="card-header">
                    <a href="graph_yymm.php" ><p style="text-align:left">Back</p></a> <h4>Graph View</h4>
                    </div>
                    <div class="card-body">
<canvas id="chartjs_bar"></canvas>





<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<?php

                  


if (isset($_POST['submit']))
 {

if ((empty(trim($_POST["view_dt"]))) or (empty(trim($_POST["view_dt_to"])))) {
$_SESSION['view_dt_err'] = "Please select date.";
header ("location: graph_home.php");


} else {
$view_dt = trim($_POST["view_dt"]);
$view_dt_to = trim($_POST["view_dt_to"]);
echo "No data to show";
}

if (empty($view_dt_err)) {
//Prepare the SELECT Query

/*$sql="SELECT dt, time_status, waketime from dt_time where dt BETWEEN '$view_dt' AND '$view_dt_to' and id='$pid' and time_status!='null' order by dt ASC";*/
$sql="SELECT dt, time_status, waketime from dt_time where MONTH(dt)='$view_dt_to' AND YEAR(dt)='$view_dt' and id='$pid' and time_status!='null' order by dt ASC";
    $result=mysqli_query($link,$sql) or die(mysqli_error($link));
    $chart_data="";
    while ($row = mysqli_fetch_array($result)){
        $dt[]=$row['dt'];
        $time_status[]=$row['time_status'];
        $wtime[]=$row['waketime'];

      }
}
//Execute the SELECT Query
}
if (!($selectRes = mysqli_query($link, $sql))) {
echo 'No record found';
} 
else { 
?>
<script type="text/javascript">
 
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
      
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($dt); ?>, 
                        datasets: [{
                            //backgroundColor: backgroundcolor,
                                 
                            data:<?php echo json_encode($time_status); ?>,
                            fill:false,
                           borderColor: 'rgb(75, 192, 192)',
                        }]
                    },
                    options: {
                        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize:10,
                    min:0,
                    max:40

                }
            }]
                        },
                     
                        tooltips: {

                          callbacks: {
                               

                                label:function(tooltipItems, data){
                                    const wtime=<?php echo json_encode($wtime);?>; 
                                    const tstatus=<?php echo json_encode($time_status);?>; 
                                  
                                    
                                    //for (i=0; i<wtime.length; i++) 
                                                                       
                                    return wtime[tooltipItems.index];                                
                                    
                                },
                        afterLabel: function(tooltipItems, data){
                                    const tstatus=<?php echo json_encode($time_status);?>; 
                                    if (tstatus[tooltipItems.index]==10){
                                      var display="Too Early";
                                      return display;

                                    }
                                    else if (tstatus[tooltipItems.index]==20){
                                      var display="Early";
                                      return display;

                                    }
                                    else if(tstatus[tooltipItems.index]==30){
                                      var display="Late";
                                      return display;

                                    }
                                    else if(tstatus[tooltipItems.index]==40){
                                      var display="Too Late";
                                      return display;

                                    }
                                    
                                                            }    
                                        
                        }
                        },
                        
                           legend: {
                        display: false,
                        
                       
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 16,
                            
                        }
                    },
 
                        
                    }
    });

  </script>
  <?php } ?>
   </div>
                </div>
            </div>
        </div>
        
    </div>
  </body>
</html>