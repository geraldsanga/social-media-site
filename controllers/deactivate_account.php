<?php
require_once '../config/config.php';
$mysqli = new mysqli("localhost", "root", "", "social") or die(mysqli_error($mysqli)); 

if(isset($_POST['deactivate_account'])){
    $user_id = $_SESSION['user_id'];
    echo('The use id is:' . $user_id .  '<br>');
    $mysqli->query("UPDATE User SET is_active =0 WHERE id=$user_id") or die($mysqli->error);
    session_destroy();
    header("location: ../index.php");
}
