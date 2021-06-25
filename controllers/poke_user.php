<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 

    if(isset($_POST["poke_user"])){
        $pokee_user = $_POST["user_id"];
        $poking_user = $_SESSION["user_id"];
        echo "pokee_id: $pokee_user" . "<br>";
        echo "poker: $poking_user" . "<br>";
        $mysqli->query("INSERT INTO UserPoke (pokee_id, poker_id) VALUES ('$pokee_user', '$poking_user')") or die($mysqli->error);
        $_SESSION["poking_success"] = "Poked :)";
        header("location: ../views/others_user_account.php?user_id=$pokee_user");
    }