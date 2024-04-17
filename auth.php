<?php

session_start();
require "User.php";

if(isset($_POST['create_account'])){
    extract($_POST);
    
    $error=[];
    
    $details=[];
    if(!empty($fullname)){
        $details['fullname']=$fullname;
    }else{
        $error[]="Full name is required!";
    }
    
    if(!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(User::accountExit($email, $password)){
            $error[]="This email has been used.";
        }else{
            $details['email']=$email;
        }
    }else{
        $error[]='Provide a valid email address';
    }
    if(!empty($password)){
        $password=crypt($password,"my-key");
        $details['password']=$password;
    }else{
        $error[]="Password can't be left blank!";
    }
    if(!$error){
        $create=User::create($details);
        if($create){
            header("Location:login.php");
        }
    }else{
        $errorStr=serialize($error);
        $_SESSION['auth_error']=$errorStr;
        header("Location:register.php");
    }
}

if(isset($_POST['login'])){
    extract($_POST);
    $login_error=false;
    $emails="iustina@yahoo.com";
    $pass="iustina";
    $captcha=$_REQUEST['captcha'];
    $captcharandom=$_REQUEST['captcha-rand'];
    if(!empty($email) and !empty($password) and ($captcha==$captcharandom)){
        if(User::accountExit($email,$password)){
            if(isset($remember)){
                User::remember($email);
            }
            $_SESSION['login_id']=$email;
            if($password == $pass and $email==$emails){
                
                header("location: pagina1.php");
            }else{
               
                header("Location: index.php");
            }
            exit();
        }else{
            $login_error=true;
        }
    }else{
        $login_error=true;
    }
    if($login_error){
        $error[]="Provide your email and password coresponding with your account or the correct captcha code";
        $_SESSION['auth_errors']=serialize($error);
        header("Location: login.php");
        exit();
    }
}

