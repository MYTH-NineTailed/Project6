<?php

$DBHOST = "localhost";  //jouw hostnaam
$DBUSER = "root";       //jouw gebruikersnaam
$DBPASS = "";           //jouw wachtwoord
$DBNAME = "project_6";   //jouw database naam

//Create Connection
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>