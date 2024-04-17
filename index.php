<?php

session_start();
require "User.php";

if(!User::isLoggedIn()){
    header("Location: login.php");
    exit;
}
list(
    'username'=>$username,
    "email"=>$email   
)= User::details();

?>
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
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.php">Your Happy Place</a>
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
        <section class="page-section clearfix">
            <div class="container">
                <div class="intro">
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/intro.jpg" alt="..." />
                    <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Happiness. Learn how to find it</span>
                
                        </h2>
                        <p class="mb-3">"Happiness consists more in small conveniences or pleasures that occur every day, than in great pieces of good fortune that happen but seldom."</p>
                        <p class="mb-3">Meik Wiking</p>               
                        <h2 style="margin-top:0;">Welcome, <?= $username ?></h2>
                        <p><?=$email?></p>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="page-section clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                           
                                <span class="section-heading-upper">A message for you:</span>
                                <span class="section-heading-lower">Read, Love, Repeat!</span>
                            <svg height="130" width="500">
                            <defs>
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:rgb(200,25,400);stop-opacity:1" />
                                <stop offset="100%" style="stop-color:rgb(25,50,50);stop-opacity:1" />
                            </linearGradient>
                            </defs>
                            <ellipse cx="240" cy="70" rx="100" ry="55" fill="url(#grad1)" />
                            <text fill="#ffffff" font-size="45" font-family="Verdana" x="200" y="86">RLR</text>
                            Sorry, your browser does not support inline SVG.
                            </svg>
                            <p class="mb-0">There is no friend as loyal as a book. They are the first step towards happiness!</p>
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

<?php
if(isset($_COOKIE['username']) and isset($_COOKIE['password'])){
    $username=$_COOKIE['username'];
    $password=$_COOKIE['password'];
    echo "<script>
        document.getElementById('username').value = '$username';
        document.getElementById('password').value = '$password';
    </script";
}

?>
</script>
