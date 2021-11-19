<?php

session_start();

require_once("config/dbconnect.php");
require_once('classes/Class.User.php');

$user = new User($conn);

if (!$user->isLoggedIn()) 
{
    $user->redirect('login.php');
}


?>

<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <title>Welkom</title>
</head>

<body>
    <p>Hi, <?php echo $_SESSION['userName']; ?>. Je bent succesvol ingelogd!</p>
    <p><a href="logout.php?logout">Login</a></p>
</body>
</html>