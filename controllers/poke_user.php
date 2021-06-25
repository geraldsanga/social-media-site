<?php

    require_once "../config/config.php";
    $mysqli = new mysqli("localhost", "root", "Root*123", "social") or die(mysqli_error($mysqli)); 

    if(isset($_POST["poke_user"])){
        $pokee_user = $_POST["user_id"];
        $poking_user = $_SESSION["user_id"];
        $results = $mysqli->query("SELECT pokee_id, poker_id from UserPoke WHERE pokee_id = $pokee_user && poker_id = $poking_user");
        if(mysqli_num_rows($results) > 0){ // if there is a poke already
            $_SESSION["poking_success"] = "Poked :)";
            header("location: ../views/others_user_account.php?user_id=$pokee_user");
        }else{ // if the user hasn't poked this user yet
            $mysqli->query("INSERT INTO UserPoke (pokee_id, poker_id) VALUES ('$pokee_user', '$poking_user')") or die($mysqli->error);
            $_SESSION["poking_success"] = "Poked :)";
            header("location: ../views/others_user_account.php?user_id=$pokee_user");
        }
    }