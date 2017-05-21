<?php
//Connection to the database using PDO

$host = "localhost"; //your server host
$user = "root"; // your db username
$pass = ""; //your db pass 
$dbname = "heaven_rental"; //your db name

$connect = mysqli_connect($host, $user, $pass, $dbname)
	or die("Error " . mysqli_error($connect));

?>