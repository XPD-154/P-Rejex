<?php

$serverName="localhost";
$userName="root";
$dbname="preq";

try{

	$connection=new PDO("mysql:host=$serverName", $userName, ''); //PDO database connection
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //set PDO error mode to exception

	$sql = "CREATE DATABASE IF NOT EXISTS $dbname"; //create database
	$connection->exec($sql);

	//echo "database created successfully";

	$sql = "use $dbname"; //connect and use database created
	$connection->exec($sql);
	
	//echo "database in use";

}catch(PDOException $error){
	echo "connection failed".$error->getMessage(); //get error message
}
?>