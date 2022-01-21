<?php 
session_start();
include "template.php";
require_once "config.php";
$dt=$time_add="";
$update="";
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

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

	if (isset($_GET['dt_edit'])) {
		$dt_edit = $_GET['dt_edit'];
		//$update = true;
        $retrieve="SELECT dt, waketime FROM dt_time WHERE dt='$dt'";
		$record = mysqli_query($link,$retrieve);

		if (mysqli_num_rows($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$dt= $n['dt'];
			$time_add = $n['waketime'];
		}
	}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["update"]))) {
            $dt= $_POST['dt_edit'];
            $time_add = $_POST['time_edit'];
        }
            if (strtotime($time_add)>=$tearlyfrom AND strtotime($time_add)<=$tearlyto)
            {
                mysqli_query($link, "UPDATE dt_time SET waketime='$time_add', time_status='$tooearly' WHERE dt='$dt'");
                $_SESSION['message'] = "WakeTime Updated!";
              }
          
              elseif (strtotime($time_add)>=$earlyfrom and strtotime($time_add)<=$earlyto)
               {
                mysqli_query($link, "UPDATE dt_time SET waketime='$time_add', time_status='$early' WHERE dt='$dt'");
                $_SESSION['message'] = "WakeTime Updated!";
                   }
                  
              elseif(strtotime($time_add)>=$latefrom and strtotime($time_add)<=$lateto)
               {
                mysqli_query($link, "UPDATE dt_time SET waketime='$time_add', time_status='$late' WHERE dt='$dt'");
                $_SESSION['message'] = "WakeTime Updated!";
                  }
                   
                   elseif(strtotime($time_add)>=$tlatefrom and strtotime($time_add)<=$tlateto) {
                    mysqli_query($link, "UPDATE dt_time SET waketime='$time_add', time_status='$toolate' WHERE dt='$dt'");
                    $_SESSION['message'] = "WakeTime Updated!";
                      }
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
                    <a href="view.php" ><p style="text-align:left">Back</p></a><h4>Update</h4> 
                    </div>
                    <div class="card-body">
                   
                   
	                </div>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                       <!-- <form action="waketime_code_db.php" method="POST">-->
                            
                        Date : <input type="text" name="dt_edit" value="<?php echo $dt_edit ; ?>" readonly>      
                      Wake Time : <input type="time" name="time_edit" value="<?php echo $time_add; ?>">
                            
                      <br>
	           <center><button class="btn btn-primary" type="submit" name="update" >Update</button></center>
                
           
                        </form>
                        <?php if (isset($_SESSION['message'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['message']; 
			        unset($_SESSION['message']);
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


