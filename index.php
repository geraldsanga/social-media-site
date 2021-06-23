<?php  
require 'config/config.php';

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
    <link href="assets/css/home_page_styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">SoCiAlSiTe.com!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="views/create_post.php">Post</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" aria-current="page"
                            href="views/user_account.php">Account</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">SoCiAlSiTe.com!</h1>
                <p class="lead mb-0">You just can't go somewhere else!!!</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row justify-content-center">
            <?php if(isset($_SESSION['login_success_message']) || isset($_SESSION['post_sucess'])):?>
            <?php if(isset($_SESSION['login_success_message'])):?>
            <div class="alert alert-dismissible alert-success text-center" sytle="width:100%">
                <?php echo $_SESSION['login_success_message']; 
                                  unset($_SESSION['login_success_message']);
                            ?>
            </div>
            <?php elseif(isset($_SESSION['post_sucess'])): ?>
            <div class="alert alert-success text-center" sytle="width:100%">
                <?php echo $_SESSION['post_sucess'];
                              unset($_SESSION['post_sucess']);
                        ?>
            </div>
            <?php endif ?>
            <?php endif ?>
            <?php if(isset($_SESSION['empty_search_error'])): ?>
            <div class="alert alert-danger text-center" sytle="width:100%">
                <?php echo $_SESSION['empty_search_error'];
                              unset($_SESSION['empty_search_error']);
                        ?>
            </div>
            <?php endif ?>
                <!-- Blog entries-->
                <div class="col-lg-6">
                    <!-- Search widget-->
                    <form class="form-inline" action="views/search_result.php" method="POST">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Eg: Programming" aria-label="Enter search term..." name="search_string"/>
                            <button class="btn btn-warning" id="button-search" type="submit" name="search_string_button">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8">
                    <?php $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 
                    $result = $mysqli->query("SELECT p.id id, p.date_created date_created, p.title title, p.picture picture, u.username username, u.id user_id FROM Post as p INNER JOIN User as u ON p.user_id=u.id ORDER BY p.id DESC") or die($mysqli->error);
                    $email = $_SESSION['email'];
                    ?>
                <!-- Featured blog post-->
                <?php while($row = $result->fetch_assoc()):?>
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="<?php echo $row['picture']; ?>" alt="..." /></a>
                    <div class="card-body">
                        <p class="card-text mb-0"><b><?php echo strtoupper($row['title']);?></b></p>
                        <div class="small text-muted"><?php echo $row['date_created'];?> </div>
                        <div class="small">Posted by: <b><a style="text-decoration: none;"
                                    href="views/others_user_account.php?user_id=<?php echo $row["user_id"]?>"><?php echo $row['username'];?></a></b>
                        </div>
                        <a class="btn btn-primary" href="views/post_details.php?post_id=<?php echo $row["id"]?>">Read
                            more →</a>
                    </div>
                </div>
                <?php endwhile; ?>
                <!-- Nested row for non-featured blog posts-->
                <!-- Pagination-->
                <nav aria-label="Pagination">
                    <hr class="my-0" />
                    <ul class="pagination justify-content-center my-4">
                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                aria-disabled="true">Newer</a></li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                        <li class="page-item"><a class="page-link" href="#!">15</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Side widgets-->
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Social Media Site 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/home_page.js"></script>
</body>

</html>
    <!-- written by Helen -->