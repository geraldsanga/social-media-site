<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 

    if(isset($_GET["user_id"])){
        $user_id = $_GET["user_id"];
        $current_user = $_SESSION["user_id"];
        $follow_results = $mysqli->query("SELECT followed FROM FollowUser WHERE followed_user_id='$user_id' AND following_user_id='$current_user'");
        $num_rows = mysqli_num_rows($follow_results);
        $followed = true;
        if($num_rows > 0) { // If he has Interected with the user already
            echo "if 1 echoed";
            $number_of_loops = 0;
            while($row = $follow_results->fetch_assoc()){
                $number_of_loops++;
                echo "      $number_of_loops";
                //if he has already followed the user simply redirect him back to the user account page
                if($row['followed']){
                header("location: ../views/others_user_account.php?user_id=$user_id");
                }else{ //if has he unfollowed but wish to follow again this user, update the followe number of the folowee
                $mysqli->query("UPDATE FollowUser SET followed = 1 WHERE followed_user_id='$user_id' AND following_user_id='$current_user'") or die($mysqli->error);
                header("location: ../views/others_user_account.php?user_id=$user_id");
                }
            }
        }else{ // If he hasn't interacted with the post already, create a Follow object
            $mysqli->query("INSERT INTO FollowUser (followed_user_id, following_user_id, followed) VALUES ('$user_id', '$current_user', '$followed')") or die($mysqli->error);
            header("location: ../views/others_user_account.php?user_id=$user_id");
        }
    }
?>