<?php 

/*if(isset($_POST['submit'])){
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    
    
$connection=mysqli_connect('localhost','root', '','loginapp');
    
    if($connection){
echo "username and password registered successfully";
        
    }
    else{
        die("Database connection failed");
    }
    
$query="INSERT INTO users(username,password)";
    $query.="VALUES ('$username', '$password')";
    
   $result= mysqli_query($connection, $query);
    
    if(!$result){
        
        die("Query failed" . mysqli_error());
    }
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journal</title>
    
    
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <h1><center>My Journal</center></h1>
</head>
<body>
   <div class="container">
    <div class="col-xs-6">
       <form action="new_user.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
           <input type="text" name="username" class="form-control">
           </div>
            <div class="form-group">
            <label for="password">Password</label>
           <input type="text" name="password" class="form-control">
           
           </div>
           <div class="form-group">
            <label for="password">Confirm Password</label>
           <input type="text" name="cpassword" class="form-control">
           
           </div>
        <input class="btn btn_primary" type="submit" name="ok" value="OK">
          
        
        </form>  
               </div>

    
    
    
    </div>
    
    </body>
</html>