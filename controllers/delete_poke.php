<?php

require_once "../config/config.php";

$mysqli = new mysqli("localhost", "root", "Root*123","social") or die(mysqli_error($mysqli));

if(isset($_POST["delete_poke"])){
    $poke_id = $_POST["poke_id"];
    $mysqli->query("DELETE FROM UserPoke WHERE id = $poke_id") or die($mysqli->error);
    $_SESSION['poke_deleted'] = "Poke Deleted";
    header("location: ../views/pokes.php");
}
?>