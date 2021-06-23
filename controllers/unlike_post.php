<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 

    if(isset($_GET["post_id"])){
        $user_id = $_SESSION["user_id"];
        $post_id = $_GET["post_id"];
        $active = true;
        $mysqli->query("UPDATE PostLike SET active = 0, inactive = 1 WHERE user_id='$user_id' AND post_id='$post_id'") or die($mysqli->error);
        header("location: ../views/post_details.php?post_id=$post_id");
    }
?>