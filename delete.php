<?php
require_once 'connect.php';
require_once 'delete_trigger.php';

// Drop the existing stored procedure if it exists
$sql1 = "DROP PROCEDURE IF EXISTS deleteText";
$conn->exec($sql1);

// Create the new stored procedure
$sql2 = "
CREATE PROCEDURE deleteText(
    IN strImage VARCHAR(255)
)
BEGIN
    DELETE FROM items WHERE image = strImage;
END";
$conn->exec($sql2);

// Check if a deletion request has been submitted
if (isset($_POST['submit'])) {
    $imageToDelete = $_POST['imageToDelete']; // Image you want to delete

    // Delete the specified image
    $stmt = $conn->prepare("CALL deleteText(:image)");
    $stmt->bindParam(':image', $imageToDelete, PDO::PARAM_STR);
    $stmt->execute();

    echo "Data was successfully deleted!";
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
                        

<!-- Form for selecting the image to delete -->
<form method="post">
    <div class="form-group">
        <label>Select Image to Delete</label>
        <select class="form-control" name="imageToDelete">
            <?php
            // Query to get all images from the database
            $res = $conn->query("SELECT image FROM items");
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['image'] . '">' . $row['image'] . '</option>';
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Delete</button>
</form>
<br/><a href="products.php">Back</a>



                        </p></div>
                    </div>
                </div>
            </div>
        </section>
        
                   

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Delete section</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>



