<?php

require "DbCon.php";

class User
{
    static function isLoggedIn(){
        if(isset($_SESSION['login_id'])){
            return $_SESSION['login_id'];
        }
        
        if(isset($_COOKIE['login_key']) and $_COOKIE['login_key']!==""){
            $key=$_COOKIE['login_key'];
            $key=htmlspecialchars($key);
            global $db;
            $smt="SELECT email FROM login WHERE login_key='$key' LIMIT 1";
            $smt=$db->query($smt);
            
            if($smt->num_rows){
                $smt=$smt->fetch_array()['email'];
                return $smt;
            }
        }
        return FALSE;
    }
    static function details(): array
{
    global $con; // Accesează variabila globală $con definită în DbCon.php
    $datails=[];
    $login_id=self::isLoggedIn();
    
    $smt="SELECT fullname, email FROM login WHERE email = :email LIMIT 1";
    $query=$con->prepare($smt);
    $query->bindValue(':email', $login_id, PDO::PARAM_STR); // Legă parametrul :email
    
    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $datails['username'] = $result['fullname'];
            $datails['email'] = $result['email'];
        }
    }
    
    return $datails;
}

static function remember($email)
{
    global $con; // Accesează conexiunea la baza de date definită în DbCon.php
    
    // Generare cheie aleatoare
    $randkey = bin2hex(random_bytes(8));

    // Interogare pentru a actualiza cheia de conectare
    $smt = "UPDATE User SET login_key = :login_key WHERE email = :email";
    $query = $con->prepare($smt);
    $query->bindParam(':login_key', $randkey, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);

    if ($query->execute()) {
        // Setare cookie cu cheia de conectare pentru următoarele 30 de zile
        $next30days = 60 * 60 * 24 * 30;
        setcookie('login_key', $randkey, time() + $next30days, "/");
    } else {
        echo "error";
    }
}

    
    static function accountExit($email, $password=null)
{
    global $con; // Accesează conexiunea la baza de date definită în DbCon.php

    $smt = "SELECT email FROM login WHERE email = :email"; // Utilizează parametri numiți în loc de concatenarea directă a valorilor pentru a preveni SQL injection

    if($password){
        $smt .= " AND `password` = :password";
    }

    $stmt = $con->prepare($smt);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if($password){
        $password=crypt($password,"my-key");
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    }

    $stmt->execute();
    $total = $stmt->rowCount();
    
    return $total;
}

    
static function create($details=[])
{
    global $con; // Accesează conexiunea la baza de date definită în DbCon.php
    $details['created_at'] = date('Y-m-d H:i:s');


    $smt="INSERT INTO login(fullname, email, `password`, created_at) VALUES (:fullname, :email, :password, :created_at)";
    
    $stmt = $con->prepare($smt);
    $stmt->bindParam(':fullname', $details['fullname'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $details['email'], PDO::PARAM_STR);
    $stmt->bindParam(':password', $details['password'], PDO::PARAM_STR);
    $stmt->bindParam(':created_at', $details['created_at'], PDO::PARAM_STR); // Legare a variabilei created_at

    if($stmt->execute()){
        return true;
    } else {
        print_r($stmt->errorInfo()); // În loc de echo $stmt->errorInfo();
    }
}

}

