<?php
include 'connect.php';
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
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="pagina1.html">Your Happy Place</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                                                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="pagina1.php">Home</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">About</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Book Club</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.php">A piece of happiness</a></li>
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
                            <span class="section-heading-upper">Happiness</span>
                            <span class="section-heading-lower">Learn how to find it</span>
                        </h2>
                        <p class="mb-3">"Happiness consists more in small conveniences or pleasures that occur every day, than in great pieces of good fortune that happen but seldom."</p>
                        <p class="mb-3">Meik Wiking</p>  
                        <div class="container">
                            <button class="btn btn-primary my-5"><a href="products.php" class="text-light">Add product</a>
                            </button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">The Number of products</th>
                                        <th scope="col">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql="Select * from `produse`";
                                    $result=mysqli_query($con,$sql);
                                    if($result){
                                        while($row=mysqli_fetch_assoc($result)){
                                            $id=$row['id'];
                                            $name=$row['name'];
                                            $price=$row['price'];
                                            $number=$row['number'];
                                            
                                            echo '<tr>
                                        <th scope="row">'.$id.'</th>
                                        <td>'.$name.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$number.'</td>
                                        <td>
                                    <button><a href="update.php?updateid='.$id.'">Update</a></button>
                                    <button><a href="delete.php?deleteid='.$id.'">Delete</a></button>
                                    </td>
                                    </tr>';
                                        }
                                    }
                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section">
            <div class="container my-5">
                <div class="product-item-description d-flex me-auto">
                    <div class="bg-faded p-5 rounded"><p class="mb-0"> 
                            Are you looking for a book? Give it a chance! It might be your lucky day!
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Id</td>
                                                <td>Name</td>
                                                <td>Price</td>
                                                <td>Number</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $con=mysqli_connect("localhost","root","","produse");
                                            
                                            if(isset($_GET['search'])){
                                                $filtervalues=$_GET['search'];
                                                $query="SELECT * FROM `produse` WHERE CONCAT(name,price,number) LIKE '%$filtervalues%'";
                                                $query_run=mysqli_query($con,$query);
                                                
                                                if(mysqli_num_rows($query_run)>0){
                                                    foreach($query_run as $items){
                                                        ?>
                                                            <tr>
                                                                <td><?=$items['id'];?></td>
                                                                <td><?=$items['name'];?></td>
                                                                <td><?=$items['price'];?></td>
                                                                <td><?=$items['number'];?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                        <tr>
                                                            <td colspan="4">No record found!</td>
                                                        </tr> 
                                                    <?php
                                                    
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </p>
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
                    </script></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>

</html>