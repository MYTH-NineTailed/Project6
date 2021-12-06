<?php

require '../config/dbconnect.php';

class Validate {
    
    private $db;
    
    public function __construct($pdo) {
        
        $this->db = $pdo;
        
    }
    
    //Returns validated gebruikersnaam of geef een error
    public function usernameValidate($uname) {
        
        if(empty($uname)) {
            return 'gebruikersnaam is leeg';
        } elseif (strlen($uname) < 2) {
            return'gebruikersnaam is te kort';
        } elseif (strlen($uname) > 64) {
            return 'gebruikersnaam is te lang';
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $uname)) {
            return 'gebruikersnaam kan geen speciale karakters bevatten';
        } else {
            $uname = strip_tags($uname);
           
            //Query database voor duplicate gebruikersnaam
            $stmt = $this->db->prepare("SELECT count(userName) FROM users WHERE userName = ?");
            $stmt->execute(   [  $uname   ]);
            $aantal->fetchColumn(PDO::FETCH_OBJ);

            //$stmt->store_result(); // ?? Er is nergens deze functie gedefinieerd...

            //If duplicate username, throw error, else return username
            // if ($stmt->num_rows !== 0) {
            //     return 'Username is already taken';        
            // }
            
            if($aantal == 1) {
                return 'gebruikersnaam is al in gebruik';
            }
            else {
                return '';
            }
        }
        
    }
    
    //Returns validated email of geef een error
    public function emailValidate($email) {
        
        if(empty($email)) {
            return 'Email is leeg';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'ongebruikelijke email';
        } elseif(strlen($email) > 64) {
            return 'Email is te lang';
        } else {
            $email = strip_tags($email);
            
            //Query database voor duplicate email
            $stmt = $this->db->prepare("SELECT userEmail FROM users WHERE userEmail = ?");
            // $stmt->bind_param("s", $email);
            $stmt->execute([$email]);
            $aantal->fetchColumn(PDO::FETCH_OBJ);
            
            //als duplicate email, geef error, anders return email
            if ($aantal != 0) {
                return 'Email is al in gebruik';        
            }
            
        }
        
    }
    
    //Returns validated wachtwoord of geef een error
    
    public function passwordValidate($pass, $pass2) {
        
        if (empty($pass) || empty($pass2)) {
            return 'wachtwoord is leeg';
        } elseif (strlen($pass) < 6) {
            return 'wachtwoord is te kort';
        } elseif ($pass !== $pass2) {
            return 'wachtwoord komt niet overeen';
        }
        
    }
    
}
