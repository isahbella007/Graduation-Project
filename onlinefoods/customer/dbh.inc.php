<?php
session_start();
$serverName = "localhost";
$DBUserename = "root";
$DBName = "onlinefoods";
$DBPassword = "";

$conn = mysqli_connect($serverName, $DBUserename, $DBPassword, $DBName );

if(!$conn){
	die("connection failled:".mysqli_connect_error());
	
}

 


 
