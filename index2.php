
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
 const wtime=<?php echo json_encode($wtime);?>;
const tstatus=<?php echo json_encode($time_status);?>;
const backgroundcolor=[];
//var dataset = chartjs_bar.data.datasets[0];
for (i=0; i<tstatus.length; i++) {

   if(tstatus[i]=10){backgroundcolor.push('red')}
    if(tstatus[i]=20){backgroundcolor.push('green')}
   if(tstatus[i]=30){backgroundcolor.push('orange')}
    if(tstatus[i]=40){backgroundcolor.push('yellow')}
}
//console.log(backgroundcolor);

/*$.each(backgroundcolor, function( index,value ) {
  if(value=10){
  	 backgroundcolor[index]="green";
  }else{
  	backgroundcolor[index]="red";
  }
});*/





      var ctx = document.getElementById("chartjs_bar").getContext('2d');
      
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($dt); ?>, 
                        datasets: [{
                            backgroundColor: backgroundcolor,
                                 
                            data:<?php echo json_encode($time_status); ?>,
                            
                        }]
                    },
                    options: {
                        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
                        },
                     
                        tooltips: {

                          callbacks: {
                               

                                label:function(tooltipItems, data){
                                    const wtime=<?php echo json_encode($wtime);?>; 
                                    
                                    //for (i=0; i<wtime.length; i++) 
                                                                       
                                    return wtime[tooltipItems.index];                                
                                    
                                },
                        afterTitle: function(tooltipItems, data){
                                    const tstatus=<?php echo json_encode($time_status);?>; 
                                    
                                
                                        if (tstatus[tooltipItems.index]<10){                             
                                     return  "Too Early" ;
                        }
                        else if(tstatus[tooltipItems.index]<30 && tstatus[tooltipItems.index]>10){
                          return  "Early" ;  
                        }
                        else if(tstatus[tooltipItems.index]<40 && tstatus[tooltipItems.index]>20){
                          return  "Late" ;  
                        }
                        else if(tstatus[tooltipItems.index]<50 && tstatus[tooltipItems.index]>30 ){
                          return  "Too Late" ;  
                        }
                        }
                        }
                        },
                        
                           legend: {
                        display: true,
                        
                       
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 16,
                            
                        }
                    },
 
                        
                    }
    });

    //var colorChangeValue = 50; //set this to whatever is the deciding color change value
    /*const tstatus=<?php echo json_encode($time_status);?>;
var dataset = chartjs_bar.data.datasets[0];
for (var i = 0; i < dataset.data.length; i++) {
  if (dataset.data[i]=10) {
    dataset.backgroundColor[i] = chartColors.yellow;
  }
  else if
  (dataset.data[i]=20) {
    dataset.backgroundColor[i] = chartColors.green;
  }
  else if
  (dataset.data[i]=30) {
    dataset.backgroundColor[i] = chartColors.blue;
  }
  else if
  (dataset.data[i]=40) {
    dataset.backgroundColor[i] = chartColors.red;
  }
}
chartjs_bar.update();*/

</script>
</html>