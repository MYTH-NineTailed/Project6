<?php 

session_start();

require_once('../config/dbconnect.php');
require_once('../classes/Class.User.php');

$user = new User($conn);

//als je al bent ingelogd, ga dan naar de home pagina
if ($user->isLoggedIn()) 
{
    $user->redirect('../index.php');
}

//Wanneer de login knop is ingedrukt, login
if (isset($_POST['login'])) 
{
    $uname = $_POST['user'];
    $pass = $_POST['password'];
    $login = $user->login($uname, $pass);
    
    if ($login === true)
    {
        $user->redirect('../index.php');
    } 
    else 
    {
        echo $login;
    }
}
?>

<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <title>inloggen</title>
    <link rel="stylesheet" href="../scripts/style_login.css">
</head>

<body>
<!-- Achtergrond met shapes -->
<div class="background">
   <div class="shape"></div>
   <div class="shape"></div>
</div>

<form method="post" action="login.php" name="loginform">

<h3>formulier om in te loggen</h3>

    <label><b>Email of gebruikersnaam</b></label>
    <input type="text" name="user" required />
    
    <label><b>Password</b></label>
    <input type="password" name="password" auto_complete="off" required/>
    
    <input class="button" type="submit" name="login" value="Log in"> </input>
    <br>
    <a href="register.php">Registreer nieuw account</a>
    
 </form>
 
 </body>
 </html>