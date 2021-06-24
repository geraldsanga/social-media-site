<?php

require_once "../config/config.php";

$mysqli = new mysqli("localhost", "root", "Root*123","social") or die(mysqli_error($mysqli));

if(isset($_POST["delete_comment"])){
    $comment_id = $_POST["comment_id"];
    echo "comment_id" . $comment_id . "<br>";
    $post_id = $_POST["post_id"];
    echo $post_id . "<br>";
    $mysqli->query("DELETE FROM Comment WHERE id = $comment_id") or die($mysqli->error);
    $_SESSION['comment_delete_success'] = "Your Comment was Successfully Deleted";
    header("location: ../views/post_details.php?post_id=$post_id");
}
?>