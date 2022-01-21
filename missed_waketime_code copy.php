<?php
session_start();
include "template.php";
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
                    <a href="addwaketime.php" ><p style="text-align:left">Back</p></a><h4>Missed Wake up Time on the Following dates</h4>
                    </div>
                    
         
                    <?php

                    


                    if (isset($_POST['submit'])) {
                        if ((empty(trim($_POST["dt_from"]))) || (empty(trim($_POST["dt_to"])))) {
                            $_SESSION['view_dt_err'] = "Please select date.";
                            header ("location: addwaketime.php");

                        } else {
                            $dt_from = trim($_POST["dt_from"]);
                            $dt_to = trim($_POST["dt_to"]);
                        }

                        if (empty($view_dt_err)) {
                            //Prepare the SELECT Query

                            $selectSQL="SELECT dt FROM dt_time WHERE dt BETWEEN '$dt_from' AND '$dt_to' and id='$pid'";
                        }
                        //Execute the SELECT Query
    
                        if (!($selectRes = mysqli_query($link, $selectSQL))) {
                            echo 'No record found';
                        } else { ?>
                        <div class="card-body">
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
                }
                
                foreach ($missing_dates as $mdates) {?>
               <table class="card-table table">
                    <tr>
                        <td>
                    <?php echo $mdates;?><br><br>
                    
                </td>
                <td>
            <?php $day_retrieve = strtotime($mdates);
            $day = date('D', $day_retrieve);
            echo $day;?>
            
                </td>
<td>
<a href="add.php?dt_add=<?php echo "$mdates"; ?>">Add</a>

                  

    </td>

                </tr>
                
                </table>
                    
                       <?php
                }
                     
                    }
                }
            }
        
                              
                    ?>


                    
                  
                   <!-- <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->

                        <form action="" method="">
                            
                        

                            
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