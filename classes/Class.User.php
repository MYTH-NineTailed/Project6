<?php
require '../config/dbconnect.php';

class User {
    
    private $db;
    
    public function __construct ($pdo) {  
        $this->db = $pdo;  
    }
    
    //Registreer nieuwe gebruiker in de database
    public function register($uname, $email, $pass) {  
    
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("INSERT INTO users (userName, userEmail, userPasswordHash) VALUES (?,?,?)");
        
        if($stmt->execute( [ $uname, $email, $passHash ] )) {
            return true;
        } else {
            return false;
        }
    }
    
    //kijk naar bestaande gebruiker in de database
    public function login($user, $pass) {
        

        //Query database for info based on username or email
        $stmt = $this->db->prepare("SELECT userName, userEmail, userPasswordHash FROM users WHERE userName = ? OR userEmail = ?");
       
        $stmt->execute( [ $user, $pass ] );
         
        //als informatie bestaat haal het op, anders een error          
            list($uname, $email, $passHash) = $stmt->fetch(PDO::FETCH_NUM);

            //als wachtwoord overeenkomt start session, anders error
            if (password_verify($pass, $passHash)) {
                $_SESSION['userName'] = $uname;
                $_SESSION['userEmail'] = $email;
                $_SESSION['userLoginStatus'] = 1;
                return true;
            } else {
                return 'verkeerd wachtwoord';
            }
    }
    
    //Check of de gebruiker is ingelogd
    public function isLoggedIn() {
        
        //Return true als de session is gezet, false als het niet zo is
        if(isset($_SESSION['userLoginStatus']) && $_SESSION['userLoginStatus'] == 1) {
            return true;
        } else {
            return false;
        }
        
    }
    
    //stuur naar andere pagina
    public function redirect($url) {
        header("Location: $url");
    }
    
    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
 
}
