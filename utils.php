<?php

function auth_error($key){
    if(isset($_SESSION[$key])){
        $error=unserialize($_SESSION[$key]);
        
        if(is_array($error)){
            $error=array_map(function($e){
                return "<small style='color:red'> $e </small> </br>";
            },$error);
            echo implode($error);
        }
        unset($_SESSION[$key]);
    }
}

