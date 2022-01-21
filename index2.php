
<?php
$con=mysqli_connect("localhost","root","","loginapp");
if(!$con){
    echo "Problem in database connection! Contact administrator!" . mysqli_error();

}else{
    $sql="SELECT dt, time_status, waketime from dt_time where id='5'";
    $result=mysqli_query($con,$sql);
    $chart_data="";
    while ($row = mysqli_fetch_array($result)){
        $dt[]=$row['dt'];
        $time_status[]=$row['time_status'];
        $wtime[]=$row['waketime'];

      }
}
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
    <div style="width:30%;height:20%;text-align:center">
<h2 class="page-header">My Journal</h2>
<div>Wake Up time</div>
<canvas id="chartjs_bar"></canvas>
</div>

</body>


<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  
<script type="text/javascript">


      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($dt); ?>, 
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                               "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                            
                            ], 
                            data:<?php echo json_encode($time_status); ?>,
                            
                        }]
                    },
                    options: {
                        tooltips: {
                            callbacks: {
                                label:function(tooltipItem){
                                                                     
                                   
                                    return  <?php echo json_encode($wtime); ?>;
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
</html>