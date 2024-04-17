<?php
require_once 'connect.php';

// Verifică dacă trigger-ul există și îl șterge înainte de a crea unul nou
$triggerName = "BeforeDeleteTrigger";
$stmt = $conn->prepare("DROP TRIGGER IF EXISTS $triggerName");
$stmt->execute();

// Crează trigger-ul pentru operațiile de ștergere
$sql = "CREATE TRIGGER $triggerName BEFORE DELETE ON items FOR EACH ROW
        BEGIN
            INSERT INTO items_update(image, details, edtime) VALUES (OLD.details, 'DELETED', NOW());
        END;";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>
