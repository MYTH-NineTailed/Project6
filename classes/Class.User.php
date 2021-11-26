<?php
require '../config/dbconnect.php';

Class User {
    
    private $db;
    
    public function __construct ($pdo) {  
    
        $this->db = $pdo;  
        
    }
    
    //Registreer nieuwe gebruiker in de database
    public function register($uname, $email, $pass) {  
    
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("INSERT INTO users (userName, userEmail, userPasswordHash) VALUES (?,?,?)");
        $stmt->bind_param("sss", $uname, $email, $passHash);
        
        if($stmt->execute()) {
            return true;
        } else {
            return $stmt->error;
        }
          
    }
    
    //kijk naar bestaande gebruiker in de database
    public function login($user, $pass) {
        
        //Query database for info based on username or email
        $stmt = $this->db->prepare("SELECT userName, userEmail, userPasswordHash FROM users WHERE userName = ? OR userEmail = ?");
        $stmt->bind_param("ss", $user, $user);
        $stmt->execute();
        $stmt->store_result();
        
        //als informatie bestaat haal het op, anders een error
        if ($stmt->num_rows == 1) {            
            $stmt->bind_result($uname, $email, $passHash);
            $result = $stmt->fetch();
            
            //als wachtwoord overeenkomt start session, anders error
            if (password_verify($pass, $passHash)) {
                $_SESSION['userName'] = $uname;
                $_SESSION['userEmail'] = $email;
                $_SESSION['userLoginStatus'] = 1;
                
                return true;
            } else {
                return 'Wrong password';
            }
            
        } else {
            return 'Wrong username or email';
        }
        
    }
    
    //Check of de gebruiker is ingelogd
    public function isLoggedIn() {
        
        //Return true als de session is gezet, false als het niet zo is
        if(isset($_SESSION['userLoginStatus'])) {
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

?>