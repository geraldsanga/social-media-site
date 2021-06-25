<?php  
require '../config/config.php';

if(!isset($_SESSION['user_logged_in']))   
    header("location: register.php");
    $user_id = $_SESSION['user_id']
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">SoCiAlSiTe.com!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="create_post.php">Post</a>
                    <li class="nav-item"><a class="nav-link active" href="pokes.php">Pokes</a></li>
                    </li>
                    <li class="nav-item"><a class="nav-link" aria-current="page"
                            href="user_account.php">Account</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container">
        <div class="row justify-content-center mt-5">
            <?php if(isset($_SESSION['poke_deleted'])): ?>
            <div class="alert alert-danger text-center" sytle="width:100%">
                <?php echo $_SESSION['poke_deleted'];
                      unset($_SESSION['poke_deleted']);
                ?>
            </div>
            <?php endif ?>
            <!-- Blog entries-->
            <div class="col-lg-8">
            <?php $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 
                $result = $mysqli->query("SELECT up.id, up.date_created, u.id user_id, u.username FROM UserPoke up
                                          JOIN User u on up.poker_id = u.id
                                          WHERE up.pokee_id = $user_id") or die($mysqli->error);
                ?>
            <!-- Featured blog post-->
                <div class="card" >
                
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <div class="card-header">
                            <h3>Your Pokes</h3>
                        </div>
                    <ul class="list-group list-group-flush">
                        <?php while($row = $result->fetch_assoc()):?>
                        <li class="list-group-item"><div class="row fst-italic mb-2">
                        <div class="col-10">
                            <a style="text-decoration: none;" href="others_user_account.php?user_id=<?php echo $row["user_id"];?>"><?php echo $row["username"];?></a> poked you on <?php echo $row["date_created"];?>
                        </div>
                        <div class="col">
                        <form action="../controllers/delete_poke.php" method="POST">
                            <input type="number" hidden value="<?php echo $row['id']?>" name="poke_id">
                            <button class="btn btn-danger" type="submit" name="delete_poke">Delete</button>
                        </form>
                        </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php elseif(mysqli_num_rows($result) == 0 || mysqli_num_rows($result) < 0):?>
                        <div class="card-header">
                            <h3>You have no Pokes.</h3>
                        </div>
                        <li class="list-group-item"><div class="row fst-italic mb-2">
                            <div class="col-10">
                                <p>No one has poked you yet</p>
                            </div>
                        </div>
                        </li>
                    <?php endif ?>
                </div>
            </div>
            <!-- Side widgets-->
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark" style="margin-top:700px;">
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
