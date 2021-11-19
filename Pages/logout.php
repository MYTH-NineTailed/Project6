<?php

session_start();

require_once("../config/dbconnect.php");
require_once('../classes/Class.User.php');

$user = new User($conn);

//log de gebruiker uit en stuur terug naar index
if (isset($_GET['logout']))
{
    $user->logout();
    $user->redirect('login.php');
} 
//als de gebruiker nog is ingelogd, stuur dan naar index die je weer naar home stuurt
else
{
    $user->redirect('login.php');
}

?>