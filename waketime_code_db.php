<?php
 session_start();   

 $pid=$_SESSION['id'];
 $time_add="";
 $wake_time_err="";
 $dt=date('y-m-d');
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
 
require_once "config.php";

if (isset($_POST['submit']))
{
    $sqlselect = "SELECT * FROM dt_time WHERE dt ='$dt' and id='$pid'";
$result = mysqli_query($link, $sqlselect);
if(!$result || mysqli_num_rows($result) > 0){

        
    $_SESSION['waketimeaddedexist']= "Wake Up Time already Added Today.";
    header("location: Welcome.php");
    exit;
}

         if(empty(trim($_POST["wake_time"]))){
        $_SESSION['wake_time_err'] = "Please select time.";
        header("location: Welcome.php");
        exit;
    } else{
        $time_add = trim($_POST["wake_time"]);
      
    }
    }


    //current date have not been inserted, insert it as usual
    
    if (strtotime($time_add)>=$tearlyfrom AND strtotime($time_add)<=$tearlyto)
      {
        //if (empty($_SESSION['wake_time_err'])) {
        $sql = "INSERT INTO dt_time (dt, waketime, time_status, id) VALUES (?, ?, ?, '$pid')";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_tearly);

            $param_dt_add = $dt;
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

            $param_dt_add = $dt;
            $param_time_add = $time_add;
            $param_early=$early;
             }
            }
        elseif(strtotime($time_add)>=$latefrom and strtotime($time_add)<=$lateto) {
            $sql = "INSERT INTO dt_time (dt, waketime,time_status, id) VALUES (?, ?, ?, '$pid')";
            if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_late);

            $param_dt_add = $dt;
            $param_time_add = $time_add;
            $param_late=$late;
            }
             }
             elseif(strtotime($time_add)>=$tlatefrom and strtotime($time_add)<=$tlateto) {
                $sql = "INSERT INTO dt_time (dt, waketime,time_status, id) VALUES (?, ?, ?, '$pid')";
                if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_dt_add, $param_time_add, $param_tlate);
    
                $param_dt_add = $dt;
                $param_time_add = $time_add;
                $param_tlate=$toolate;
                }
                 }



            if (mysqli_stmt_execute($stmt)) {
                // display message
                $_SESSION['waketimeadded']= "Wake Up Time Added sucessfully";
              header("location: Welcome.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";

                // Close statement
                mysqli_stmt_close($stmt);
            }
        
        //close link
        mysqli_close($link);
    

?>




