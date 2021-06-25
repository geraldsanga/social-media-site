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
                <!-- Blog Search Results-->
                <?php 
                 $search_string = $_POST["search_string"];
                  $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 
                  $post_result = $mysqli->query("SELECT * FROM Post WHERE title LIKE '%$search_string%' OR description LIKE '%$search_string%' ORDER BY id DESC") or die($mysqli->error);
                  $post_num_rows = mysqli_num_rows($post_result);
                  if($post_num_rows > 0): 
                ?>
                 <div class="my-2 col-lg-8">
                <h3>Posts related to: '<?php echo $_POST["search_string"]?>'</h3>
                </div>
                <div class="col-lg-8 mt-5">
                    <!-- Featured blog post-->
                    <?php while($post_row = $post_esult->fetch_assoc()):?>
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="../<?php echo $post_row['picture']; ?>" alt="..." /></a>
                        <div class="card-body">
                            <p class="card-text mb-0"><b><?php echo strtoupper($post_row['title']);?></b></p>
                            <div class="small text-muted"><?php echo $post_row['date_created'];?> </div>
                            <div class="small">Posted by: <b><a style="text-decoration: none;" href="others_user_account.php?user_id=<?php echo $post_row["user_id"]?>"><?php echo $post_row['username'];?></a></b></div>
                            <a class="btn btn-primary" href="../views/post_details.php?post_id=<?php echo $post_row["id"]?>">Read more →</a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <!-- Nested row for non-featured blog posts-->
                    <!-- Pagination-->
                </div>
                <?php endif ?>
                <!-- User Search Results -->
                <?php 
                 $search_string = $_POST["search_string"];
                  $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 
                  $user_result = $mysqli->query("SELECT * FROM User WHERE username LIKE '%$search_string%' OR first_name LIKE '%$search_string%' OR last_name LIKE '%$search_string%' ORDER BY id DESC") or die($mysqli->error);
                  $user_num_rows = mysqli_num_rows($user_result);
                  if($user_num_rows > 0): 
                ?>
                 <div class="my-2 col-lg-8">
                <h3>Users related to: '<?php echo $_POST["search_string"]?>'</h3>
                </div>
                <div class="col-lg-8 mt-5">
                    <!-- Featured blog post-->
                    <?php while($row = $user_result->fetch_assoc()):?>
                    <div class="card mb-4">
                        <div class="card-body">
                        <img src="../assets/images/profile_pics/defaults/head_carrot.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="50">  <a style="text-decoration: none;" href="others_user_account.php?user_id=<?php echo $row["id"];?>"><?php echo $row["username"];?></a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif ?>
                <?php if($user_num_rows <= 0 && $post_num_rows <= 0 ): ?>
                <div class="my-2 col-lg-8">
                    <h3>Sorry nothing matches your search '<?php echo $_POST["search_string"] ?>'</h3>
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