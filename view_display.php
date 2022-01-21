<?php 
session_start();
include "template.php";
require_once "config.php";
$view_dt=$view_dt_err=$view_dt_to="";
$pid=$_SESSION['id'];

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
                    <a href="view.php" ><p style="text-align:left">Back</p></a> <h4>View</h4>
                    </div>
                    <div class="card-body">
                   
                   <?php

                    


                    if (isset($_POST['submit']))
                     {

    if ((empty(trim($_POST["view_dt"]))) or (empty(trim($_POST["view_dt_to"])))) {
        $_SESSION['view_dt_err'] = "Please select date.";
        header ("location: view.php");
    
    
    } else {
        $view_dt = trim($_POST["view_dt"]);
        $view_dt_to = trim($_POST["view_dt_to"]);
    }

    if (empty($view_dt_err)) {
        //Prepare the SELECT Query

        $selectSQL = "SELECT dt, waketime FROM dt_time WHERE dt BETWEEN '$view_dt' AND '$view_dt_to' and id='$pid' order by dt ASC";
        //Execute the SELECT Query
    }
    if (!($selectRes = mysqli_query($link, $selectSQL))) {
        echo 'No record found';
    } else { 
        ?>
        <?php $month1 = date("F",strtotime($view_dt));
                    $month2 = date("F",strtotime($view_dt_to));?>
                    <?php if ($month1==$month2): ?>
                    <h3><label><b><?php echo $month1; ?></b></label></h3>
                     <?php else: ?>
                        
                     <h3><label><b><?php echo $month1; ?></b> - <b><?php echo $month2; ?></b></label></h4>

        <?php endif ?>
        <h4><label>From <b><?php echo $view_dt; ?></b> to <b><?php echo $view_dt_to; ?></b></label></h4>
        <table class="card-table table" >
        <thead>
          <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Wake Up Time</th>
           <th>Action</th>
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
            <td> 
                <a href="update.php?dt_edit=<?php echo $row['dt']; ?>" class="edit_btn" >Edit</a>
            </td>
        </tr><br>
                  <?php 
                }
            } ?>
        </tbody>
      </table></center>
          
          
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