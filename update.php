<?php
require_once 'connect.php';
require_once 'update_trigger.php';

// Drop the existing stored procedure if it exists
$sql1 = "DROP PROCEDURE IF EXISTS updateText";
$conn->exec($sql1);

// Create the new stored procedure
$sql2 = "
CREATE PROCEDURE updateText(
    IN strDetails VARCHAR(255),
    IN strImage VARCHAR(255),
    IN intID INT
)
BEGIN
    IF strImage IS NOT NULL THEN
        UPDATE items SET details = strDetails, image = strImage WHERE id = intID;
    ELSE
        UPDATE items SET details = strDetails WHERE id = intID;
    END IF;
END";
$conn->exec($sql2);

// Check if an update request has been submitted
if (isset($_POST['submit'])) {
    $idToUpdate = $_POST['id']; // ID-ul rândului pe care utilizatorul dorește să-l actualizeze
    $details = $_POST['details']; // Noile detalii asociate rândului

    $imageToUpdate = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageToUpdate = $_FILES['image']['name'];
        $file = $_FILES['image']['tmp_name'];
        $folder = 'upload\ '; // Directorul în care se va salva imaginea
        move_uploaded_file($file, $folder . $imageToUpdate);
    }

    // Call the stored procedure to update the item
    $stmt = $conn->prepare("CALL updateText(:details, :image, :id)");
    $stmt->bindParam(':details', $details, PDO::PARAM_STR);
    $stmt->bindParam(':image', $imageToUpdate, PDO::PARAM_STR);
    $stmt->bindParam(':id', $idToUpdate, PDO::PARAM_INT);
    $stmt->execute();

    echo "Data was successfully updated!";
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

<section class="page-section">
    <div class="container">
        <div class="product-item">
            <div class="product-item-title d-flex">
                <div class="bg-faded p-5 rounded"><p class="mb-0">


                    <!-- Formular pentru actualizare -->
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group">
                            <label>New Details</label>
                            <input type="text" class="form-control" name="details" required>
                        </div>
                        <div class="form-group">
                            <label>New Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </form>
                    <br/><a href="products.php">Back</a>


                </p></div>
            </div>
        </div>
    </div>
</section>


<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Update section</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
