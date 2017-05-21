<?php 
session_start();

if(isset($_SESSION['userID'])) {
	session_destroy();
	unset($_SESSION['userID']);
	header("Location: index.php");
	exit;
} else {
	header("Location: index.php");
	exit;
}

?>