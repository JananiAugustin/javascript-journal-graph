<?php
// Initialize the session
session_start();
include "template.php";
require_once "config.php";

//$_SESSION['view_dt_err']="";
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
                    <h4>Choose to Year and Month to view your wakeup graph</h4>

                    </div>
                    <div class="card-body">
                    
                    
                   
                   
                    <!--<form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">-->

                        <form action="index2.php" method="POST">
                            
                <div class="form-group mb-3">

                <label>Year</label>

                <select id="year" name="view_dt">
    <option>year</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>

                </select>

                <?php if (isset($_SESSION['view_dt_err'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['view_dt_err']; 
			        unset($_SESSION['view_dt_err']);
		            ?>
                    
	                </div>
                    <?php endif ?>
                    <label>Month</label>
                    <select id="month" name="view_dt_to">
    <option>month</option>
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>

<?php if (isset($_SESSION['view_dt_err'])): ?>
	                <div class="msg">
		            <?php 
			        echo $_SESSION['view_dt_err']; 
			        unset($_SESSION['view_dt_err']);
		            ?>
                    
	                </div>
                    <?php endif ?>     


                            <div class="form-group">
                               
                            <input type="submit" name="submit" class="btn btn-primary" value="Graph View">
                                
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