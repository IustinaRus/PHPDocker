<?php
require_once 'connection.php';

// Verificăm dacă s-a trimis un fișier
if(isset($_FILES['file'])) {
    // Verificăm dacă nu există erori la încărcarea fișierului
    if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Obținem informații despre fișier
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];

        // Definim un director de destinație pentru încărcarea imaginilor
        $destination = 'upload\ ' . $fileName;

        // Mutăm fișierul încărcat în directorul de destinație
        if(move_uploaded_file($fileTmpName, $destination)) {
            // Inserează detaliile imaginii în baza de date
            $insertQuery = "INSERT INTO img (image, details) VALUES ('$fileName','')";
            $insertResult = $conn->query($insertQuery);
            if($insertResult) {
                echo "Data was successfully inserted!";
            } else {
                echo "Error inserting data into database!";
            }
        } else {
            echo "Error moving uploaded file!";
        }
    } else {
        echo "Error uploading file!";
    }
}
?>
<br/><a href="about.php">Back</a>
