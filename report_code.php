<?php 
session_start();
//include "template.php";
require_once "config.php";
$view_dt=$view_dt_err=$view_dt_to="";
$pid=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    </head>
    <body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                    <a href="report.php" ><p style="text-align:left">Back</p></a> <h4>Report</h4>
                   
                    </div>
                   
                     <?php
               if (isset($_POST['submit']))
                     {

    if ((empty(trim($_POST["view_dt"]))) || (empty(trim($_POST["view_dt_to"])))) {
        $_SESSION['view_dt_err'] = "Please select date.";
header("location: report.php");
    } else {
        $view_dt = trim($_POST["view_dt"]);
        $view_dt_to = trim($_POST["view_dt_to"]);
    }

    if (empty($view_dt_err)) {
        //Prepare the SELECT Query

        $selectSQL = "SELECT dt, DATE_FORMAT(t.waketime,'%h:%i %p') AS waketime FROM dt_time as t WHERE dt BETWEEN '$view_dt' AND '$view_dt_to' and id='$pid' order by dt ASC";
        //Execute the SELECT Query

    }
    if (!($selectRes = mysqli_query($link, $selectSQL))) {
        echo 'No record found';
    } else { ?>
     <div class="card-body">
     
     <?php $month1 = date("F",strtotime($view_dt));
     $month2 = date("F",strtotime($view_dt_to));?>
     <?php if ($month1==$month2): ?>
     <h3><label><b><?php echo $month1; ?></b></label></h3>
     <?php else: ?>
        <h3><label><b><?php echo $month1; ?></b> - <b><?php echo $month2; ?></b></label></h4>

        <?php endif ?>
         
<h4><label>From <b><?php echo $view_dt; ?></b> to <b><?php echo $view_dt_to; ?></b></label></h4>
    
          <h5><u><a href="missed_dates_report.php?dt_from=<?php echo "$view_dt"; ?>&dt_to=<?php echo "$view_dt_to";?>">Missed Dates</a></u></h5>

                 <table class="card-table table">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Day</th>
            <th scope="col">Wake Up Time</th>
           
          </tr>
        </thead>
        <tbody>
          <?php
            if (mysqli_num_rows($selectRes)==0) {
                echo '<tr><td colspan="4">Wake up time not registered</td></tr>';
            } else {
                while ($row = mysqli_fetch_assoc($selectRes)) {
?> 
<tr>
    <td> 
        <?php echo $row['dt']?>
        </td>
        <td>
            <?php $day_retrieve = strtotime($row['dt']);
            $day = date('D', $day_retrieve);
            echo $day;?>
                </td>
        <td>
            <?php echo $row['waketime'];?>
           
            </td> 
           
            
        </tr><br>
                  <?php 
                }
            } ?>
        </tbody>
      </table>
          
          
          <?php
    }
}
 ?>   



                       <form action="" method="POST">                            
                       
                            </div>

                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </body>
    </html>

    <!--<a name="missed_dates">-->

<?php
            /*if (mysqli_num_rows($selectRes)==0) {
                echo "No missed Date";
            } else {
                while ($row = mysqli_fetch_assoc($selectRes)) {
                    ?> 
                    <?php
                     $reg_dates[]=$row['dt'];
                }
                $dateStart = date_create("$view_dt");
                $dateEnd   = date_create("$view_dt_to");
                $interval  = new DateInterval('P1D');
                $period    = new DatePeriod($dateStart, $interval, $dateEnd);
                foreach ($period as $day) {
                    $formatted = $day->format("Y-m-d");
                    if (!in_array($formatted, $reg_dates)) {
                        $missing_dates[] = $formatted;
                    }
                }
                
                foreach ($missing_dates as $mdates) {?>
               <table class="card-table table">
               <thead>
          <tr>
            <th scope="col">Missed Date</th>
            <th scope="col">Day</th>
            
          </tr>
        </thead>
        <tbody>
                        <td>
                    <?php echo $mdates;?><br><br>
                    
                </td>
<td>
                      
<?php $day_retrieve = strtotime($row['dt']);
            $day = date('D', $day_retrieve);
            echo $day;?> 

                       
    </td>

                </tr>
                </tbody>
                </table>
              <?php }
            }
              ?>      
    
     </a>*/