<?php

session_start();

require_once('../config/dbconnect.php');
require_once('../classes/Class.User.php');
require_once('../classes/Class.Validate.php');

$user = new User($pdo);

$validate = new Validate($pdo);

//als de gebruiker is ingelogd, ga dan naar de home page
if ($user->isLoggedIn()) 
{
    $user->redirect('../index.php');
}

$errors = array();

//wanneer de registreer knop wordt geklikt, registreer het in de database
if (isset($_POST['register'])) 
{
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['passwordrepeat'];
    
    //check de gebruiker input
    if ($validate->usernameValidate($uname) != null) 
    {
        $errors[] = $validate->usernameValidate($uname);
    }
    if ($validate->emailValidate($email) != null) 
    {
        $errors[] = $validate->emailValidate($email);
    }
    if ($validate->passwordValidate($pass, $pass2) != null) 
    {
        $errors[] = $validate->passwordValidate($pass, $pass2);
    }
    
    //als input goed is registreer, zo niet krijg je error
    if (empty($errors)) 
    {
        if($user->register($uname, $email, $pass) === true) 
        {
            $user->redirect('register.php?joined');
        }
        else 
        {
            echo 'Error registering. please try again.';
        }
    }
    else
    {
        foreach ($errors as $error) 
        {
            printf ($error . "<br/>");
        }
    }   
}

?>

<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../scripts/style_login.css">
</head>

<body>

<?php
if (isset($_GET['joined'])) 
{
?>
<p>Succesvol geregistreert. je kan nu <a href="login.php">inloggen</a>.</p>
<?php
}
else 
{

}
?>

<!-- Achtergrond met shapes -->
<div class="background">
   <div class="shape"></div>
   <div class="shape"></div>
</div>

<h3>Registration Form</h3>

<form method="post" action="register.php" name="registerform">

    <label><b>Username</b></label>
    <input type="text" name="username" required />
    
    <label><b>Email</b></label>
    <input type="email" name="email" required />
    
    <label><b>Password</b></label>
    <input type="password" name="password" auto_complete="off" required />
    
    <label><b>Repeat Password</b></label>
    <input type="password" name="passwordrepeat" auto_complete="off" required />

    <input class="button" type="submit" name="register" value="Registreren"/>
    <br>
    <a href="login.php">Al een account?</a>  
 </form>
 </body>
 </html>