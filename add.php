<?php

session_start();
include "template.php";
require_once "config.php";
$pid=$_SESSION['id'];
$dt_add="";
$time_add="";
$tooearly=10;
$early=20;
$late=30;
$toolate=40;
$tearlyfrom=strtotime('0:00:00');
$tearlyto=strtotime('4:59:00');
$earlyfrom=strtotime('5:00:00');
$earlyto=strtotime('6:59:00');
$latefrom=strtotime('7:00:00');
$lateto=strtotime('9:59:00');
$tlatefrom=strtotime('10:00:00');
$tlateto=strtotime('23:59:00');



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
if (isset($_GET['dt_add'])) {
    $dt_add = $_GET['dt_add'];
    $sqlselect = "SELECT * FROM dt_time WHERE dt ='$dt_add' and id='$pid'";
    $result = mysqli_query($link, $sqlselect);
    if (!$result || mysqli_num_rows($result) > 0) {
        echo "Adding wake time failed";
        header("location: addwaketime.php");
        exit;
    }
}
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    if (trim($_POST["submit"])) {
        $dt_add=trim($_POST["dt_add"]);
        $time_add = trim($_POST["time_add"]);
      
       // $_SESSION['wake_time_err'] = "Please select time.";
        //header("location: add.php");
        
    } 
    
      
     if (strtotime($time_add)>=$tearlyfrom AND strtotime($time_add)<=$tearlyto)
      {
        //if (empty($_SESSION['wake_time_err'])) {
        $sql = "INSERT INTO dt_time (dt, waketime, time_status, id) VALUES (?, ?, ?, '$pid')";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_tearly);

            $param_dt_add = $dt_add;
            $param_time_add = $time_add;
            $param_tearly=$tooearly;
        }
    }
        elseif (strtotime($time_add)>=$earlyfrom and strtotime($time_add)<=$earlyto)
         {
                $sql = "INSERT INTO dt_time (dt, waketime,time_status, id) VALUES (?, ?, ?, '$pid')";
            if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_early);

            $param_dt_add = $dt_add;
            $param_time_add = $time_add;
            $param_early=$early;
             }
            }
        elseif(strtotime($time_add)>=$latefrom and strtotime($time_add)<=$lateto) {
            $sql = "INSERT INTO dt_time (dt, waketime,time_status, id) VALUES (?, ?, ?, '$pid')";
            if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_late);

            $param_dt_add = $dt_add;
            $param_time_add = $time_add;
            $param_late=$late;
            }
             }
             elseif(strtotime($time_add)>=$tlatefrom and strtotime($time_add)<=$tlateto) {
                $sql = "INSERT INTO dt_time (dt, waketime,time_status, id) VALUES (?, ?, ?, '$pid')";
                if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_tlate);
    
                $param_dt_add = $dt_add;
                $param_time_add = $time_add;
                $param_tlate=$toolate;
                }
                 }


            if (mysqli_stmt_execute($stmt)) {
                // display message
                $_SESSION['waketimeadded']= "Wake Up Time Added sucessfully";
              header("location: addwaketime.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";

                // Close statement
                mysqli_stmt_close($stmt);
            }
}
        //close link
        mysqli_close($link);
    
        
    
    
   // $time_add = trim($_POST["time_add"]);
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
                    <a href="addwaketime.php" ><p style="text-align:left">Back</p></a><h4>Add Wake time</h4> 
                    </div>
                    <div class="card-body">
                   

	                </div>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                       <!-- <form action="waketime_code_db.php" method="POST">-->
                            
                        Date : <input type="text" name="dt_add" value="<?php echo $dt_add ; ?>" readonly>      
                      Wake Time : <input type="time" name="time_add">
                      
                      <?php if (isset($_SERVER['wake_time_err'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SERVER['wake_time_err']; 
			        unset($_SERVER['wake_time_err']);
		            ?>
                     <?php endif ?> 
                      <br>
	           <center> <input type="submit" name="submit" class="btn btn-primary" value="ADD"></center>
                
           
                        </form>
                        <?php if (isset($_SESSION['waketimeadded'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['waketimeadded']; 
			        unset($_SESSION['waketimeadded']);
		            ?>
                     <?php endif ?>
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

