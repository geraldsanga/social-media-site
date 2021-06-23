<?php
// End current user session
    require '../config/config.php';

    if(isset($_SESSION['user_logged_in'])){
        session_destroy();
        header('location: ../register.php');
    }else{
        session_destroy();
        header('location: ../register.php');
    }
?>