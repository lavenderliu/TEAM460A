
<?php
session_start (); // establish session
                  
// get values from form
$email = $_POST ["email"];
$pw = $_POST ["pw"];

// Connect to MySQL, select database
$link = mysqli_connect ( 'frodo.bentley.edu', 'cs460teama', 'Vwg*33k', 'cs460teama' ) or die ( 'Could not connect: ' . mysqli_error () );
// echo 'Connected successfully';

// Perform SQL query
$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query ( $link, $query ) or die ( 'Query failed: ' . mysqli_error () );
$rows = mysqli_num_rows ( $result );

// if userid not in login table, go to login page and try again
if ($rows < 1)
	header ( "Location: login.html" );
	
	/*
 * //print contents of login table to webpage, useful when debugging
 * echo "<table>\n";
 * //loop over result set. Print a table row for each record
 * while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
 * echo "\t<tr>\n";
 * //inner loop. Print each table field value for a record
 * foreach ($line as $col_value) {
 * echo "\t\t<td>$col_value</td>\n";
 * }
 * echo "\t</tr>\n";
 * }
 * echo "</table>\n";
 */
	
// get login table record for userid
$line = mysqli_fetch_array ( $result, MYSQL_ASSOC );

// cherck password. If not correct, go to login page and try again
if ($pw != $line ['pw'])
	header ( "Location: home.html" );
	
	// save login record as session data, data persists over entire session
$_SESSION ['userid'] = $line ['userid'];
$_SESSION ['last'] = $line ['lastlogin'];

// Free resultset
mysqli_free_result ( $result );

// update last time logged in
$update = "UPDATE user SET lastlogin=now() WHERE email='$email'";
mysqli_query ( $link, $update ) or die ( 'Login time update failed : ' . mysqli_error () );

// Close connection
mysqli_close ( $link );

// create session variable containing correct login status for use in other pages
$_SESSION ['user'] = "yes";

// echo ", Last login ".$_SESSION['last'];
echo '<html> <body>
		<link href="css/bootstrap.min.css" rel="stylesheet">

      <link href="css/cover.css" rel="stylesheet">
    <body style="background-image:url(img/macaroons.jpg); background-repeat: repeat-y;">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,400italic" rel="stylesheet" type="text/css">
	 <link rel="stylesheet" href="javascripts/stylesheets/jquery.sidr.dark.css">
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Wholefoods Grocery List</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="welcome.php">Create List</a></li>
                  <li><a href="index.html">Home</a></li>
                  <li><a href="#">Saved Lists</a></li>
					<li><a href="#">Leave Us Feedback</a></li>
					<li><a href="#">Log Out </a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
           <div class="jumbotron">
		
		<form action="createlistPHP.php" method="post">
<table align="center">
<tr><td style="color: black">Name your list:</td><td><input type="text" name="listmname" style="color: black"></td></tr><br/>
		<tr><td colspan="2"> <input type="text" name="itemname" style="color: black"></td></tr><br/>
<tr><td colspan="2" > <input type="text" name="itemname" style="color: black"></td></tr><br/>
<tr><td colspan="2" ><input type="text" name="itemname" style="color: black"></td></tr><br/>
<tr><td colspan="2" ><input type="text" name="itemname" style="color: black"></td></tr><br/>
<tr><td colspan="2"><input type="text" name="itemname" style="color: black"></td></tr><br/>
<tr><td ><button class="btn btn-success btn-block " type="submit">Go Shopping</button></td>
		<td><button class="btn btn-success btn-block " type="submit">Save List</button></td>
		</tr>
</table>
</form>

		
		</div>
           		
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>2015 | CS460 Team A</p>
            </div>
          </div>

        </div>
</div>
		</div>
  
        <!-- include jquery -->
        <script src="javascripts/jquery.js"></script>
        <!-- include sidr js for side bar dropdown menu of item categories -->
        <script src="javascripts/jquery.sidr.min.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>';

?>