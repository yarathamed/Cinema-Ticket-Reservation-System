<?php

//This PHP script is responsible for intiating a database connection
session_start();

//Host name
$host = "localhost";
//User
$user = "root";
//Password
$password = "";
//Database name
$database = "cinema_ticket_reservation";
$mysqli = new mysqli('localhost', 'root', '', 'car_rental_system');

$conn= mysqli_connect($host, $user, $password, $database);

//If connection is not initiated show error and kill session
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>