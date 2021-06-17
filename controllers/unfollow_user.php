<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 

    if(isset($_GET["user_id"])){
        $following_user_id = $_SESSION["user_id"];
        $user_id = $_GET["user_id"];
        $mysqli->query("UPDATE FollowUser SET followed = 0 WHERE following_user_id='$following_user_id' AND followed_user='$user_id'") or die($mysqli->error);
        header("location: ../views/others_user_account.php?user_id=$user_id");
    }
?>