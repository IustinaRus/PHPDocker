<?php
// Conectați-vă la baza de date folosind PDO
$dsn = 'mysql:host=mysql_db;dbname=img';
$username = 'root';
$password = 'toor';

try {
    $conn = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

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
            // Definim detaliile imaginii pentru inserare în baza de date
            $imageDetails = 'Detalii despre imagine'; // Aici puteți seta detalii despre imagine

            // Prevenim SQL injection
            $fileName = $conn->quote($fileName);
            $imageDetails = $conn->quote($imageDetails);

            // Inserează detaliile imaginii în baza de date folosind PDO prepared statements
            $insertQuery = "INSERT INTO img (image, details) VALUES ($fileName, $imageDetails)";
            $insertResult = $conn->exec($insertQuery);
            if($insertResult) {
                echo "Fișierul a fost încărcat cu succes și detaliile au fost inserate în baza de date!";
            } else {
                echo "Eroare la inserarea detaliilor în baza de date!";
            }
        } else {
            echo "Eroare la mutarea fișierului încărcat!";
        }
    } else {
        echo "Eroare la încărcarea fișierului!";
    }
}
?>
<?php

class Book {

    public $name;
    public $author;
    private $year;

    public function setYear($year) {
        $this->year = $year;
    }

    public function getYear() {
        return $this->year;
    }

}

$bookoftheday = new Book();
$bookoftheday->name = '"Me before you"';
$bookoftheday->author = 'Jojo Moyes';
$bookoftheday->setYear(2013);
?>
<?php 
$connect=mysqli_connect('mysql_db', 'root','toor','img');
if(!$connect){
    echo 'Error Code: '.mysqli_connect_errno().'<br>';
    echo 'Error Message:'.mysqli_connect_error().'<br>';
    exit();
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
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="pagina1.php">Your Happy Place</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                                                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about_client.php">About</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products_client.php">Book Club</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store_client.php">A piece of happiness</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="page-section cta">

            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                           Let's watch together the most interesting cat preparing himself to become the best football player in the world!
                            <video width="600" height="400" controls>
                                <source src="audio/video.mp4" type="video/mp4">
                            </video>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section about-heading">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.6540022311406!2d27.569709948155324!3d47.173735196494135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sUniversitatea%20%E2%80%9EAlexandru%20Ioan%20Cuza%E2%80%9D!5e0!3m2!1sro!2sro!4v1684871725419!5m2!1sro!2sro" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto">
                            <div class="bg-faded rounded p-5">
                                <h2> 
                                    <span class="section-heading-lower">The happy gallery!</span>
                                </h2>
                                <h2>
                                    <span class="section-headind-upper">   
                                    <?php
                                        $res = $conn->query("SELECT * FROM img ORDER BY id DESC");
                                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<br><tr>
                                                <td><img src="upload/' . $row['image'] . '" height="200"></td>
                                                </tr>';
                                        }                                        
                                        ?>
                                    </span>
                                </h2>
                                <p class="mb-0">
                                    We guarantee that you will fall in love with our gallery. This is "the piece of happiness" that you need for today!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section about-heading">
            <div class="container">
                <div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto">
                            <div class="bg-faded rounded p-5">
                                <h2>
                                    <span class="section-heading-upper">Are you curious to find out which is the book of the day?</span>
                                    <span class="section-heading-lower">Say no more!</span>
                                </h2>
                                <h2>
                                    <span class="section-headind-upper">   
                                        <?php
                                            echo $bookoftheday->name;
                                            echo "  by  ";
                                            echo $bookoftheday->author;
                                            echo "<br>";
                                            echo "Apparition year? ";
                                            echo $bookoftheday->getYear();
                                        ?>
                                    </span>
                                </h2>
                                <p class="mb-0">
                                    A Love Story for this generation and perfect for fans of John Green’s The Fault in Our Stars, Me Before You brings to life two people who couldn’t have less in common—a heartbreakingly romantic novel that asks, What do you do when making the person you love happy also means breaking your own heart?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">
                    <button id="like" onclick="liked()">
                        <i class="fa fa-thumbs-up"></i>
                        <span class="icon">Like</span>
                    </button>
                    <script>
                        function liked() {
                            var element = document.getElementById("like");
                            element.classList.toggle("liked");
                        }
                    </script>
                    <button id="share" onclick="shared()">
                        <i class="fa fa-thumbs-up"></i>
                        <span class="icon">Share</span>
                    </button>
                    <script>
                        function shared() {
                            var element = document.getElementById("share");
                            element.classList.toggle("shared");
                        }
                    </script>
                </p>
                
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
