<?php
ob_start(); //Turns on output buffering 
session_start();

$timezone = date_default_timezone_set("Africa/Dar_es_Salaam");

$con = mysqli_connect("localhost", "root", "Root*123", "social"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>