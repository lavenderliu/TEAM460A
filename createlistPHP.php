<?php 
session_start();  //check login
if ($_SESSION['user']=="yes") {  

//get values from form

      	
echo "<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css'/>";

// Connect to MySQL, select database
$link = mysql_connect('localhost', 'root', '')
    or die('Could not connect: ' . mysql_error());
echo 'Connected successfully.<br/>';
mysql_select_db('cs460teama') or die('Could not select database');

// Perform SQL query


// Close connection
mysql_close($link);


//if not logged in, go back to login page
}  else header("Location: home.html");
?>