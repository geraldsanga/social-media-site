<?php

require_once "../config/config.php";

$mysqli = new mysqli("localhost", "root", "Root*123","social") or die(mysqli_error($mysqli));

if(isset($_POST["delete_post"])){
    $post_id = $_POST["post_id"];
    $mysqli->query("DELETE FROM Post WHERE id = $post_id") or die($mysqli->error);
    $_SESSION['post_delete_sucess'] = "Your Post was Successfully Deleted";
    header("location: ../index.php");
}
?>