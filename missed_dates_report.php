<?php
session_start();
//include "template.php";
require_once "config.php";
$dt_from=$view_dt_err=$dt_to="";
$reg_dates=array();
$missing_dates=array();
$mdates="";
$pid=$_SESSION['id'];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
                    <a href="report.php" ><p style="text-align:left">Back</p></a><h4>Report</h4>
                    </div>
                    <div class="card-body">
                    <?php

                    


                    if (isset($_GET['dt_from']) && !empty($_GET['dt_from']) and isset($_GET['dt_to']) && !empty($_GET['dt_to'])) {
                       $dt_from=$_GET['dt_from'];
                       $dt_to=$_GET['dt_to'];
                           
                     $retrieve="SELECT dt FROM dt_time WHERE dt BETWEEN '$dt_from' AND '$dt_to' and id='$pid' ";
                           
                        
                    if (!($selectRes = mysqli_query($link, $retrieve))) {
                            echo 'Retrieval of data from Database Failed - #'.mysqli_errno($link, $selectRes).': '.mysqli_error($link, $selectRes);
                        } else 
                        { 

                        ?>
                        <?php $month1 = date("F",strtotime($dt_from));
                    $month2 = date("F",strtotime($dt_to));?>
                    <?php if ($month1==$month2): ?>
                    <h3><label><b><?php echo $month1; ?></b></label></h3>
                     <?php else: ?>

                     <h3><label><b><?php echo $month1; ?></b> - <b><?php echo $month2; ?></b></label></h4>

        <?php endif ?>
        <h4><label>From <b><?php echo $dt_from; ?></b> to <b><?php echo $dt_to; ?></b></label></h4>
        
          <?php
            if (mysqli_num_rows($selectRes)==0) {
                echo "No missed Date";
            } else {
                while ($row = mysqli_fetch_assoc($selectRes)) {
                    ?> 
                    <?php
                     $reg_dates[]=$row['dt'];
                }
                $dateStart = date_create("$dt_from");
                $dateEnd   = date_create("$dt_to");
                $interval  = new DateInterval('P1D');
                $period    = new DatePeriod($dateStart, $interval, $dateEnd);
                foreach($period as $day) {
                  $formatted = $day->format("Y-m-d");
                  if(!in_array($formatted, $reg_dates)) $missing_dates[] = $formatted;
                }?>
                <table class="card-table table">
                <thead>
                    <tr>
                    <th scope="col">Missed Dates</th>
                     <th scope="col">Day</th>
             </tr>
             </thead>
                <?php 
                foreach ($missing_dates as $mdates) {?>
              
                <tbody>
                    <tr>
                        <td>
                    <?php echo $mdates;?><br><br>
                    
                </td>
<td>
                      
             
<?php $day_retrieve = strtotime($mdates);
            $day = date('D', $day_retrieve);
            echo $day;?>
                       
    </td>
<?php } ?>
                </tr>
                </tbody>
                </table>
                    
                       <?php
                
                     
                    }
                }
            }
        
                              
                    ?>

  
                  
                   <!-- <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->

                        <form action="" method="POST">
                            
                        

                            
                        </form>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
                    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<p><a href="welcome.php"></a>.</p>
    </p>
</body>
</html>