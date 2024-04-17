<?php
require_once 'connect.php';

$sql1 = "DROP TRIGGER IF EXISTS BeforeUpdateTrigger";
$sql2 = "CREATE TRIGGER BeforeUpdateTrigger BEFORE UPDATE ON items FOR EACH ROW
BEGIN
    SET NEW.details = LOWER(NEW.details);
END";

$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$sql3 = "DROP TRIGGER IF EXISTS AfterUpdateTrigger";
$sql4 = "CREATE TRIGGER AfterUpdateTrigger AFTER UPDATE ON items FOR EACH ROW
BEGIN
    INSERT INTO items_update(image, details, edtime) VALUES (NEW.details, 'UPDATED', NOW());
END";

$stmt3 = $conn->prepare($sql3);
$stmt4 = $conn->prepare($sql4);
$stmt3->execute();
$stmt4->execute();
?>

