<?php
	session_start(); //start session
	session_destroy(); //destroy all session variables
	//setcookie("id","" , time() - 60 * 60);
	//unset($_COOKIE["id"]);
	header('location: index.php'); //return to homepage
?>
