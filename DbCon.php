<?php 
$dbms = 'mysql';
$host = 'mysql_db';
$db = 'login';
$user = 'root';
$pass = 'toor';
$dsn = "$dbms:host=$host;dbname=$db";

try {
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setează modul de afișare a erorilor
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
