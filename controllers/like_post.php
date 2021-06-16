<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 

    if(isset($_GET["post_id"])){
        $user_id = $_SESSION["user_id"];
        $post_id = $_GET["post_id"];
        $active = true;
        $mysqli->query("INSERT INTO PostLike (user_id, post_id, active) VALUES ('$user_id', '$post_id', '$active')") or die($mysqli->error);
        header("location: ../views/post_details.php?post_id=$post_id");
    }
?>