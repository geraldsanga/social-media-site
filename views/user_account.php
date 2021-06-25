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
                        <li class="nav-item"><a class="nav-link" href="pokes.php">Pokes</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="user_account.php">Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
    <div class="container mt-5">
		<div class="main-body">
		<?php if(isset($_SESSION['account_update_sucess'])):?>
		<div class="alert alert-success text-center" sytle="width:100%">
			<?php 
				echo $_SESSION['account_update_sucess'];
				unset($_SESSION['account_update_sucess']);
			?>
		</div>
		<?php endif ?>
		<?php if(isset($_SESSION['update_error_message'])):?>
		<div class="alert alert-danger text-center" sytle="width:100%">
		<?php 
			echo $_SESSION['update_error_message'];
			unset($_SESSION['update_error_message']);
		?>
		</div>
		<?php endif ?>
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="../assets/images/profile_pics/defaults/head_carrot.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
								<div class="mt-3">
									<?php if($_SESSION['first_name'] || $_SESSION['last_name']):?>
									<h4><?php echo $_SESSION['first_name']. ' ' . $_SESSION['last_name']?></h4>
									<?php endif; ?>
									<p class="text-muted font-size-sm"><?php if($_SESSION['address']){echo $_SESSION['address'];}?></p>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deactivate_account_modal">
									Deactivate Account
									</button>
									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#logout_modal">
									LogOut
									</button>
								</div>
							</div>
							<hr class="my-4">
							<ul>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h5 class="mb-2">Number of Posts: <?php if($_SESSION['number_of_posts']){echo $_SESSION['number_of_posts'];}else{echo 0;}?></h6>
							</li>				
							</ul>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-2">I am also available via:</h6>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
									<span class="text-secondary"><?php if(isset($_SESSION['twitter_username'])){ echo $_SESSION['twitter_username'];}?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
									<span class="text-secondary"><?php if(isset($_SESSION['instagram_username'])){ echo $_SESSION['instagram_username'];}?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
									<span class="text-secondary"><?php if(isset($_SESSION['facebook_username'])){ echo $_SESSION['facebook_username'];}?></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
				<form action="../controllers/update_info.php" method="POST">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">First Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="first_name" value="<?php if($_SESSION['first_name']){echo $_SESSION['first_name'];}?>" placeholder="Enter First Name" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
								<h6 class="mb-0">Last Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="last_name" value="<?php if($_SESSION['last_name']){echo $_SESSION['last_name'];}?>" placeholder="Enter Last Name" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="email" value="<?php if($_SESSION['email']){echo $_SESSION['email'];}?>" placeholder="Eg: neema@mail.com" required>
								<input type="text" name="user_id" class="form-control" value="<?php if($_SESSION['user_id']){echo $_SESSION['user_id'];}?>" hidden>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Username</h6>
								</div>
								<div class="col-sm-9 text-secondary">
								<input type="text" class="form-control" name="user_name" value="<?php if($_SESSION['user_name']){echo $_SESSION['user_name'];}?>" placeholder="Eg: neema" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="phone_number" class="form-control" value="<?php if($_SESSION['phone_number']){echo $_SESSION['phone_number'];}?>" placeholder="Eg: +255 623 095 550" required>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="address" value="<?php if($_SESSION['address']){echo $_SESSION['address'];}?>" placeholder="Eg: Machava, Kigamboni, Dar es Salaam" required>
								</div>
							</div>
              				<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Twitter</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="twitter_username" value="<?php if($_SESSION['twitter_username']){echo $_SESSION['twitter_username'];}?>" placeholder="Twitter Username" >
								</div>
							</div>
              				<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Instagram</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="instagram_username" value="<?php if($_SESSION['instagram_username']){echo $_SESSION['instagram_username'];}?>" placeholder="Instagram Username" >
								</div>
							</div>
              				<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Facebook</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" name="facebook_username" value="<?php if($_SESSION['facebook_username']){echo $_SESSION['facebook_username'];}?>" placeholder="Facebook Username" >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<button type="submit" class="btn btn-primary px-4" name="update_button">Update Information</button>
								</div>
							</div>
						</div>
					</div>
				</form>	
				</div>
			</div>
		</div>
	</div>

	
	<!-- Deactivate Account Modal -->
	<div class="modal fade" id="deactivate_account_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">Deactivate Account</h5>
				<button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center">
				Are you sure you wish to deactivate your account
				</div>
				<form action="../controllers/deactivate_account.php" method="POST">
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger" name="deactivate_account">Deactivate</button>
				</div>
				</form>
			</div>
			</div>
		</div>
	</div>
	<!-- LogOut Modal -->
	<div class="modal fade" id="logout_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">LogOut</h5>
				<button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="text-center">
				Are You sure you wish to logout!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a class="btn btn-danger" href="../controllers/logout.php" role="button">LogOut</a>
				</div>
			</div>
			</div>
		</div>
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
<!-- written by Neema-->