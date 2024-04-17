<?php
$dbms = 'mysql';
$host = 'mysql_db';
$db = 'img';
$user = 'root';
$pass = 'toor';
$dsn = "$dbms:host=$host;dbname=$db";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setează modul de afișare a erorilor
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>
