<?php

require_once "../config/config.php";

$mysqli = new mysqli("localhost", "root", "Root*123","social") or die(mysqli_error($mysqli));

if(isset($_POST["save_post"])){
   $description = $_POST["description"];
   $title = $_POST["title"];
   $user_id = $_SESSION['user_id'];
   $file_name = $_FILES['image']['name'];
   $file_temp_location = $_FILES['image']['tmp_name'];
   $file_store = "./" . $file_name;
   $upload_location = "controllers/". $file_name;
   $mysqli->query("INSERT INTO Post (user_id, title, description, picture) VALUES ('$user_id', '$title', '$description', '$upload_location')") or die($mysqli->error);
   $mysqli->query("UPDATE User SET number_of_posts=number_of_posts + 1 WHERE id=$user_id") or die($mysqli->error);
   $_SESSION['post_sucess'] = "Your Post was Successfully Uploaded";
   $_SESSION['number_of_posts']++;
   header("location: ../index.php");
   if (move_uploaded_file($file_temp_location, $file_store)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      } else {
      echo "Sorry, there was an error uploading your file.";
      }
}
?>