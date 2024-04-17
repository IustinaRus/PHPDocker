<?php
require_once 'connection.php';
require_once 'insertimg_trigger.php';
#######################################
$sql1="DROP PROCEDURE IF EXISTS InsertImg";
$sql2="CREATE PROCEDURE InsertImg(
    IN strImg varchar(100),
    IN strDetails varchar(100)
    )
    BEGIN
    INSERT INTO img
    ( image, details)
    VALUES (strImg, strDetails);
    END";
$stmt1=$conn->prepare($sql1);
$stmt2=$conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();
###################################

$image='caine.jpeg';
$details='un caine frumos';
$sql="CALL InsertImg('{$image}', '{$details}')";
$q=$conn->query($sql);
?>
