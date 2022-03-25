<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bespokedbikes";

$dbc = mysqli_connect($hostname, $username, $password, $dbname) OR die("Could not connect to database, error ".mysqli_connect_error);

?>
