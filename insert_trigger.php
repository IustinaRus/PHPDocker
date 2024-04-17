<?php

require_once 'connect.php';
$sql1 = "DROP TRIGGER IF EXISTS BeforeInsertTrigger";
$sql2 = "CREATE TRIGGER BeforeInsertTrigger BEFORE INSERT ON items FOR EACH ROW
BEGIN 
SET NEW.details=UPPER(NEW.details);
END";

$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$sql3 = "DROP TRIGGER IF EXISTS AfterInsertTrigger";
$sql4 = "CREATE TRIGGER AfterInsertTrigger AFTER INSERT ON items FOR EACH ROW
BEGIN 
INSERT INTO items_update(image, details,edtime)VALUES(NEW.details, 'INSERTED',NOW());
END";

$stmt3 = $conn->prepare($sql3);
$stmt4 = $conn->prepare($sql4);
$stmt3->execute();
$stmt4->execute();
