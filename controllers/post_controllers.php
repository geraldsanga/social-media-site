<?php

require_once "../config/config.php";

$mysqli = new mysqli("localhost", "root", "","social") or die(mysqli_error($mysqli));

if(isset($_POST["save_post"])){
   $caption = $_POST["caption"];
   $user_id = 1;
   echo($caption);

   $mysqli->query("INSERT INTO Post (user_id, caption) VALUES ('$user_id', '$caption')") or die($mysqli->error);
   header("location: ../index.php");
//    $file_temp_location = $_FILES['image']['tmp_name'];
//    $file_store = "upload/" . $file_name;

//    if (move_uploaded_file($file_temp_location, $file_store)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
//     } else {
//     echo "Sorry, there was an error uploading your file.";
//     }
}
?>