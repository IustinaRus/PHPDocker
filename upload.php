<?php
require_once 'connect.php';
require_once 'insert_trigger.php';

// Drop the existing stored procedure if it exists
$sqlDrop = "DROP PROCEDURE IF EXISTS InsertImage";
$conn->exec($sqlDrop);

// Create the new stored procedure for image insertion
$sqlCreate = "
CREATE PROCEDURE InsertImage(
    IN strImg VARCHAR(255),
    IN strDetails VARCHAR(255)
)
BEGIN
    INSERT INTO items (image, details) VALUES (strImg, strDetails);
END";
$conn->exec($sqlCreate);

if (isset($_POST['submit'])) {
    $details = $_POST['details'];
    $folder = 'upload\ ';
    $image_file = $_FILES['image']['name'];
    $file = $_FILES['image']['tmp_name'];
    $target_file = $folder . basename($image_file);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check file type
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error[] = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed!';
    }

    // Check file size
    if ($_FILES['image']['size'] > 1048576) {
        $error[] = 'Sorry, your image is too large. Upload less than 1 MB';
    }

    // If no errors, upload the image and insert details into database
    if (!isset($error)) {
        move_uploaded_file($file, $target_file);
        $stmt = $conn->prepare("CALL InsertImage(:image, :details)");
        $stmt->bindParam(':image', $image_file);
        $stmt->bindParam(':details', $details);

        try {
            $stmt->execute();
            $image_success = true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Display errors if any
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<div class="message">' . $error . '</div><br>';
        }
    }
}

if (isset($image_success)) {
    echo '<div class="success">Image uploaded successfully!</div>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Business Casual - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles.css" rel="stylesheet" />
</head>
<body>
<header>
    <h1 class="site-heading text-center text-faded d-none d-lg-block">

    </h1>
</header>


<br/><a href="products.php">Back</a>

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Insert section</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>


