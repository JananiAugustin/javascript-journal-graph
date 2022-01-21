<?php
// Initialize the session
session_start();

include "template.php";

// Check if the user is logged in, if not then redirect him to login page
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
                        <h4>Select Your Today's wake Time</h4>
                    </div>
                    <div class="card-body">
                   
                    <?php if (isset($_SESSION['waketimeadded'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['waketimeadded']; 
			        unset($_SESSION['waketimeadded']);
		            ?>
                    <?php elseif (isset($_SESSION['waketimeaddedexist'])): ?>
                    <div class="msg">
		            <?php 
			        echo $_SESSION['waketimeaddedexist']; 
			        unset($_SESSION['waketimeaddedexist']);
		            ?>
	                </div>
                    <?php endif ?>
                   

                        <form action="waketime_code_db.php" method="POST">
                            
                            <div class="form-group mb-3">
                                
                                
                            <input type="time" name="wake_time" class="form-control">
                            <?php if (isset($_SESSION['wake_time_err'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['wake_time_err']; 
			        unset($_SESSION['wake_time_err']);
		            ?>
	                </div>
                    <?php endif ?>
                             </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Save Time">
                            </div>

                            
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