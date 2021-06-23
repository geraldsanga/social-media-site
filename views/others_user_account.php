<?php
	require_once '../config/config.php';
	if(!isset($_SESSION['user_logged_in']))   
    header("location: register.php");
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
        <!-- Core theme CSS includes Bootstrap-->
        <link href="../assets/css/post_styles.css" rel="stylesheet" />
        <link href="../assets/css/user_account_styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">SoCiAlSiTe.com!</a>
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
    <?php if(isset($_GET['user_id'])): ?>
		<div class="main-body">
			<div class="row">
				<div class="col-lg-12">
                <?php
                    $user_id = $_GET['user_id'];
                    $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli));
                    $result = $mysqli->query("SELECT * FROM User WHERE id=$user_id") or die($mysqli->error);
                ?>
                    <?php while($row = $result->fetch_assoc()):?>
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="../assets/images/profile_pics/defaults/head_carrot.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                               
								<div class="mt-3">
									<?php if($row['first_name'] || $row['last_name']):?>
									<h4><?php echo $row['first_name']. ' ' . $row['last_name']?></h4>
									<?php endif; ?>
									<p class="text-muted font-size-sm"><?php if($row['address']){echo $row['address'];}?></p>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deactivate_account_modal">
									Follow
									</button>
								</div>
							</div>
							<hr class="my-4">
							<ul>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h5 class="mb-2">Number of Posts: <?php if($row['number_of_posts']){echo $row['number_of_posts'];}else{echo 0;}?></h6>
							</li>				
							</ul>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-2">I am also available via:</h6>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
									<span class="text-secondary"><?php if(isset($row['twitter_username'])){ echo $row['twitter_username'];}?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
									<span class="text-secondary"><?php if(isset($row['instagram_username'])){ echo $row['instagram_username'];}?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
									<span class="text-secondary"><?php if(isset($row['facebook_username'])){ echo $row['facebook_username'];}?></span>
								</li>
							</ul>
						</div>
					</div>
                    <?php endwhile ?>
				</div>
			</div>
		</div>
    <?php endif ?>
	</div>
        <!-- Footer-->
        <footer class="py-5 bg-dark" style="margin-top:195px;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Social Media Site 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="../assets/js/jquery-slim.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>