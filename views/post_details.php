<?php
	require_once '../config/config.php';
	if(isset($_SESSION['user_logged_in'])){
    
	}else{
		header("location: ../register.php");
	}
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Post Detail</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/post_styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">Social Media Site</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="create_post.php">Post</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="user_account.php">Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
        <!-- Opening query for the post details, date, creator etc...-->
        <?php     $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 
                  $post_id = $_GET['post_id'];
                  $post_result = $mysqli->query("SELECT p.id id, p.title title, p.date_created date_created, p.description post_description, u.username username FROM Post p JOIN User u ON p.user_id=u.id WHERE p.id = $post_id") or die($mysqli->error);
        ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <?php while($post_row = $post_result->fetch_assoc()):?>
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $post_row["title"]; ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $post_row["date_created"];?> by <?php echo $post_row["username"];?></div>
                            <!-- Post categories-->
                            <!-- <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a> -->
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?php echo $post_row["post_description"]; ?></p>
                        </section>
                    </article>
                        <section class="mb-5">
                            <?php if(isset($_SESSION["posted_comment"])):?>
                                <div class="alert alert-success text-center" sytle="width:100%">
                                    <?php
                                            echo $_SESSION['posted_comment'];
                                            unset($_SESSION['posted_comment']);
                                    ?>
                                </div>
                            <?php endif ?>
                        </section>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4" action="../controllers/post_comment.php" method="POST">
                                    <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" name="comment" required></textarea>
                                    <input name="post_id" value="<?php echo $post_row['id'] ?>" hidden></input>
                                    <button class="btn btn-primary mt-3" type="submit" name="post_comment">Post Comment</button>
                                </form>
                                <!-- Query to get all the comments for the related post -->
                                <?php
                                      $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli));
                                      $post_id = $_GET['post_id'];
                                      $comment_result = $mysqli->query("SELECT c.comment comment, u.username username FROM Comment as c INNER JOIN User as u ON u.id=c.user_id WHERE c.post_id=$post_id ORDER BY c.id DESC") or die($mysqli->error);
                                ?>
                                <!-- Single comment-->
                                <?php while($comment_row = $comment_result->fetch_assoc()):?>
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="my-2 mx-3">
                                    <div class="fw-bold"><?php echo $comment_row["username"];?></div>
                                        <?php echo $comment_row["comment"];?>
                                    </div>
                                </div>
                                <?php endwhile ?>
                            </div>
                        </div>
                    </section>
                    <?php endwhile; ?>
                </div>
                <!-- Side widgets-->
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Social Media Site 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>