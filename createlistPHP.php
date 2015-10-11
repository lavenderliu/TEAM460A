<?php 
session_start();  //check login
if ($_SESSION['user']=="yes") {  

//get values from form

      	
echo "<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>";

// Connect to MySQL, select database
$link = mysqli_connect ( 'frodo.bentley.edu', 'cs460teama', 'Vwg*33k', 'cs460teama' ) 
or die ( 'Could not connect: ' . mysqli_error () );
// echo 'Connected successfully.<br/>';


// Perform SQL query


// Close connection
mysql_close($link);


//if not logged in, go back to login page
}  else header("Location: home.html");
?>