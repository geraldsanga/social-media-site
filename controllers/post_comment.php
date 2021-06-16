<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 

    if(isset($_POST["post_comment"])){
        $user_id = $_SESSION["user_id"];
        $post_id = $_POST["post_id"];
        $comment = $_POST["comment"];
        $mysqli->query("INSERT INTO Comment (user_id, post_id, comment) VALUES ('$user_id', '$post_id', '$comment')") or die($mysqli->error);
        $_SESSION["posted_comment"] = "Your comment was successfully posted";
        header("location: ../views/post_details.php?post_id=$post_id");
    }
?>