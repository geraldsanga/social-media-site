<?php
ob_start(); //Turns on output buffering 
session_start(); // Start a session

$timezone = date_default_timezone_set("Africa/Dar_es_Salaam"); // set default timezone to reflect local region

$con = mysqli_connect("localhost", "root", "", "social"); //Connection variable

// Database Connection Error Handling
if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>