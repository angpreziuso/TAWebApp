<?php

$serverName = "localhost"; //May need to change 
$dbUserName = "root";
$dbPassword = "";
$dbName = "CLEF";

$connection = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName); //Did not add a port??


if(!$connection)
{
    die("Connection Failed: ".mysqli_connect_error());
}

?>