<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Ndugu Jamaa!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php  

	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				<h1>Ndugu Jamaa!</h1>
				Login or sign up below!
			</div>
			<br>
			<div id="first">

				<form action="user_controllers.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="" required>
					<br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>

				</form>

			</div>

			<div id="second">

				<form action="controllers/user_controllers.php" method="POST">
					<input type="text" name="first_name" placeholder="First Name" value="" required>
					<br>
					<input type="text" name="last_name" placeholder="Last Name" value="" required>
					<br>
					<input type="text" name="user_name" placeholder="User Name" value="" required>
					<br>
					<input type="email" name="email" placeholder="Email" value="" required>
					<br>
					<input type="password" name="password_1" placeholder="Password" required>
					<br>
					<input type="password" name="password_2" placeholder="Confirm Password" required>
					<br>
					<input type="submit" name="register_button" value="Register">
					<br>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
				</form>
			</div>

		</div>

	</div>


</body>
</html>