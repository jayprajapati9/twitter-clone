<?php
$dbhost	= "localhost"; //Leave this as 'localhost' once uploaded on a server
$dbuser	= "root"; //Username that is allowed to access the database
$dbpass	= ""; //Password
$dbname	= "twitterclonedb"; //Name of the database

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");
mysqli_select_db($conn,$dbname);
//echo date('M Y');
?>