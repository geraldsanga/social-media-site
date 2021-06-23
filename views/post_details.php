<?php
	require_once '../config/config.php';
	if(!isset($_SESSION['user_logged_in']))   
    header("location: register.php");

    $user_id = $_SESSION['user_id'];

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
        <!-- Query to get the following: Post details, Number of likes and dislikes, check if the current user has liked this post or not-->
        <?php     $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 
                  $post_id = $_GET['post_id'];
                  $post_result = $mysqli->query("SELECT p.id, p.title,p.picture, p.date_created, p.description, u.username, u.id user_id , p_likes.likes, p_likes.dislikes, userLiked.active
                                                FROM Post p 
                                                JOIN User u ON p.user_id=u.id 
                                                LEFT OUTER JOIN (SELECT post_id, sum(if(active = 1, 1,0)) likes, sum(if(active = 0,1,0)) dislikes from PostLike WHERE post_id = $post_id) as p_likes on p_likes.post_id = p.id
                                                LEFT OUTER JOIN PostLike userLiked on userLiked.post_id = p.id and userLiked.user_id = $user_id
                                                WHERE p.id = $post_id") or die($mysqli->error);
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
                            <h3>Likes: <?php echo $post_row['likes'];?></h3>
                            <h3>Dislikes: <?php echo $post_row['dislikes'];?></h3>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $post_row["date_created"];?> by <a style="text-decoration: none;" href="others_user_account.php?user_id=<?php echo $post_row["user_id"];?>"><?php echo $post_row["username"];?></a></div>
                            <!-- Post categories-->
                            <!-- <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a> -->
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="../<?php echo $post_row['picture'];?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section>
                            <p class="fs-5"><?php echo $post_row["description"];?></p>
                        </section>
                    </article>
                        <section class="mb-2">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <a href="../controllers/like_post.php?post_id=$post_row['id']"><img src="../assets/icons/not_liked.svg" style="width:30px; height:30px;"></a>
                                </div>
                                <div class="col-1">
                                <a href="../controllers/unlike_post.php?post_id=$post_row['id']"><img src="../assets/icons/unlike.svg" style="width:30px; height:30px;"></a>
                                </div>
                            </div>
                        </div>  
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
                                      $comment_result = $mysqli->query("SELECT c.comment, u.username FROM Comment as c INNER JOIN User as u ON u.id=c.user_id WHERE c.post_id=$post_id ORDER BY c.id DESC") or die($mysqli->error);
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