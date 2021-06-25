<?php  
require '../config/config.php';

if(!isset($_SESSION['user_logged_in']))   
header("location: register.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Social Media Site</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/home_page_styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="../index.php">SoCiAlSiTe.com!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="../views/create_post.php">Post</a></li>
                        <li class="nav-item"><a class="nav-link" href="pokes.php">Pokes</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="../views/user_account.php">Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <!-- Page content-->  
    <?php if(isset($_POST['search_string_button'])): ?>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Blog entries-->
                <?php 
                 $search_string = $_POST["search_string"];
                  $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 
                  $result = $mysqli->query("SELECT * FROM Post WHERE title LIKE '%$search_string%' OR description LIKE '%$search_string%' ORDER BY id DESC") or die($mysqli->error);
                  $num_rows = mysqli_num_rows($result);
                  if($num_rows > 0): 
                ?>
                 <div class="my-2 col-lg-8">
                <h3>Posts related to: '<?php echo $_POST["search_string"]?>'</h3>
                </div>
                <div class="col-lg-8 mt-5">
                    <!-- Featured blog post-->
                    <?php while($row = $result->fetch_assoc()):?>
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="../<?php echo $row['picture']; ?>" alt="..." /></a>
                        <div class="card-body">
                            <p class="card-text mb-0"><b><?php echo strtoupper($row['title']);?></b></p>
                            <div class="small text-muted"><?php echo $row['date_created'];?> </div>
                            <div class="small">Posted by: <b><a style="text-decoration: none;" href="others_user_account.php?user_id=<?php echo $row["user_id"]?>"><?php echo $row['username'];?></a></b></div>
                            <a class="btn btn-primary" href="../views/post_details.php?post_id=<?php echo $row["id"]?>">Read more →</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <!-- Nested row for non-featured blog posts-->
                    <!-- Pagination-->
                </div>
                <?php else: ?>
                <div class="my-2 col-lg-6">
                <h3 style="color:red;">Sorry Nothing matches your search '<?php echo $search_string?>'</h3>
                </div>
                <?php endif ?>
               
            </div>
        </div>
    <?php endif ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark" style="margin-top:900px;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; SoCiAlSiTe.com! 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/home_page.js"></script>
    </body>
</html>