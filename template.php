<?php
// Initialize the session
//session_start();

 
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your personal journal.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a><br><br>

        <a href="welcome.php" class="btn btn-warning">Register Wake up time</a>
        <a href="view.php" class="btn btn-danger ml-3">View & modify Wake Up Time</a>
       <!-- <a href="modify.php" class="btn btn-warning">Modify Wake up time</a>-->
       <a href="addwaketime.php" class="btn btn-danger ml-3">View missed wake up Time</a>
        <a href="report.php" class="btn btn-warning">Report</a>
       <!-- <a href="graph.php" class="btn btn-danger ml-3">Graph</a>-->

        <!--<h3><p>Date: <span id="datetime"></span></p></h3>

<script>
var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleDateString();

</script>-->



    
                    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<p><a href="welcome.php"></a>.</p>
    </p>
</body>
</html>