<?php

require_once "../config/config.php";

// HANDLING USER REGISTRATION
$mysqli = new mysqli("localhost", "root", "","social") or die(mysqli_error($mysqli));

if(isset($_POST["register_button"])){
   $first_name = $_POST["first_name"];
   $last_name = $_POST["last_name"];
   $user_name = $_POST["user_name"];
   $email = $_POST["email"];
   $password1 = $_POST["password_1"];
   $password2 = $_POST["password_2"];

   // validating_variables
   $password_is_valid = false;
   $first_name_is_valid = false;
   $last_name_is_valid = false;
   $user_name_is_valid = false;
   
   //validation 1: check if the two passwords match and length of the password
   if($password1 == $password2){
      if(strlen($password2) > 5){
         $password_is_valid = true;
      }else{
         $_SESSION['msg_type'] = "danger";
         $_SESSION['message'] = "The password is too short";
      }
      
   }else{
      $_SESSION['msg_type'] = "danger";
      $_SESSION['message'] = "The two passwords do not match";
   }

   //validation 2: check length of the first name
   if(strlen($first_name) > 3 || strlen($first_name < 25)){
      $first_name_is_valid = true;

   }else{
      $_SESSION['msg_type'] = "danger";
      $_SESSION['message'] = "Names must be between 3 and 25 characters";
   }

   //validation 3: check length of the last name
   if(strlen($last_name) > 3 || strlen($last_name < 25)){
      $last_name_is_valid = true;
   }else{
      $_SESSION['msg_type'] = "danger";
      $_SESSION['message'] = "Names must be between 3 and 25 characters";
   }

   //validation 4:  length of the user name and it's existance int he database
   if(strlen($user_name) > 2 || strlen($user_name < 25)){
      if(preg_match('/[^A-Za-z0-9]/', $user_name)){
      }else{
      $result = $mysqli->query("SELECT username FROM User WHERE username='$user_name'") or die($mysqli->error);

      $num_rows = mysqli_num_rows($result);
      if($num_rows > 0) {
         $_SESSION['msg_type'] = "danger";
         $_SESSION['message'] = "The username is already in use";
      }else{
         $user_name_is_valid = true;
      }
      }
   }else{
      $_SESSION['msg_type'] = "danger";
      $_SESSION['message'] = "User Names must be between 2 and 25 characters";
   }

   //validation 5: check email's existance in the database
   function email_is_available($email, $mysqli){
      $result = $mysqli->query("SELECT email FROM User WHERE email='$email'") or die($mysqli->error);
      $num_rows = mysqli_num_rows($result);
      if($num_rows > 0) {
         echo("you cant use the email: ".$email. " since it's already in use");
         $_SESSION['msg_type'] = "danger";
         $_SESSION['message'] = "The email is already in use";
         return false;
      }else{
         return true;
      }
   }

   $email_is_available = email_is_available($email, $mysqli);

   // Save the user in the database with the password hashed
   if($first_name_is_valid && $last_name_is_valid && $user_name_is_valid && $password_is_valid && $email_is_available){
      $hashed_password = md5($password2);
      $mysqli->query("INSERT INTO User (first_name, last_name, username, email, user_password) VALUES ('$first_name', '$last_name', '$user_name', '$email', '$hashed_password')") or die($mysqli->error);
      $_SESSION['msg_type'] = "success";
      $_SESSION['message'] = "Account is successfully Created";
      header("location: ../index.php");
   }
   
}
?>