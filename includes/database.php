<?php
DEFINE ('DB_USER', 'eddie');
DEFINE ('DB_PASSWORD', 'root');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'orion');
$dbconnect = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
or die ('Could not connect to MySQL: ' . mysqli_connect_error () );   
// Finally, we set the language encoding as utf-8
mysqli_set_charset($dbconnect, 'utf8');
?>