<?php
    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 

    if(isset($_GET["post_id"])){
        $user_id = $_SESSION["user_id"];
        $post_id = $_GET["post_id"];
        $active = true;
        // Query to see if user has already interacted with the Post
        $like_results = $mysqli->query("SELECT active FROM PostLike WHERE post_id='$post_id' AND user_id='$user_id'");
        $num_rows = mysqli_num_rows($like_results);
        if($num_rows > 0) { // If he has interacted with the post already
            while($row = $like_results->fetch_assoc()){
                //if he has already liked the photo simply redirect him back to the post detail page
                if($row['active']){
                header("location: ../views/post_details.php?post_id=$post_id");
                }else{ //if has he liked the picture and later unliked it but he is trying to like it now, update the active button
                $mysqli->query("UPDATE PostLike SET active = 1 WHERE user_id='$user_id' AND post_id='$post_id'") or die($mysqli->error);
                header("location: ../views/post_details.php?post_id=$post_id");
                }
            }
        }else{ // If he hasn't interacted with the post already, create a like object
            $mysqli->query("INSERT INTO PostLike (user_id, post_id, active) VALUES ('$user_id', '$post_id', '$active')") or die($mysqli->error);
            header("location: ../views/post_details.php?post_id=$post_id");
        }
    }
?>