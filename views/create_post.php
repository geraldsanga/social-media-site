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
        <link href="../assets/css/create_post_sytle.css" rel="stylesheet" />
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
                        <li class="nav-item"><a class="nav-link active" href="create_post.php">Post</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="user_account.php">Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-7 offset-lg-1">
                    <form class="create-form" method="post" enctype="multipart/form-data" action="../controllers/post_controllers.php">

                        <!-- Body -->
                        <div class="form-group mb-3">
                        <label for="postTitle"><b>Title</b></label>
                            <input class="form-control mb-3" type="text" name="title" id="postTitle" placeholder="Eg: Python is better than PHP" required>
                            <label for="postBody"><b>Description</b></label>
                            <textarea class="form-control" rows="3" type="text" name="description" id="postBody" placeholder="Further Description.." required></textarea>
                        </div>

                        <!-- Image -->
                        <div class="form-group mb-3">
                            <label for="id_image">Image</label>
                            <input  type="file" name="image" id="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                        <!-- Submit btn -->
                        <button class="submit-button btn btn-lg btn-primary btn-block" type="submit" name="save_post">POST</button>
                        </div>
                    </form>	
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark" style="margin-top:500px;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Social Media Site 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>