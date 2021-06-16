<?php 
require_once '../config/config.php';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../assets/css/activate_account.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <form class="form-signin" action="../controllers/activate_account.php" method="POST">
  <?php if(isset($_SESSION['activation_error'])):?>
    <div class="alert alert-danger text-center">
      <?php
        echo $_SESSION['activation_error'];
        unset($_SESSION['activation_error']);
      ?>
    </div>
	<?php endif ?>
  <h1 class="h3 mb-3 font-weight-normal">Activate Account</h1>
  <p>To reactivate your account, please enter the credentials you last used</p>
  <input type="text" id="inputEmail" class="form-control mb-3" placeholder="Email" name="email" required autofocus>
  <input type="password" id="inputPassowrd" class="form-control mb-3" placeholder="Password" name="password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="reactivate_account">Reactivate</button>
</form>
</body>
</html>
