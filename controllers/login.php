<?php

require_once '../config/config.php';

$mysqli = new mysqli("localhost", "root", "","social") or die(mysqli_error($mysqli));


if(isset($_POST["login_button"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $mysqli->query("SELECT * FROM User WHERE email='$email'") or die($mysqli->error);
    $num_rows = mysqli_num_rows($result);
    if($num_rows < 1) {
        $_SESSION['login_error_message'] = "Invalid credentials";
        header('location: ../register.php');
    }else{
        while($row = $result->fetch_assoc()){
            $hashed_password = $row["user_password"];
            $active_account = $row["is_active"];
            
            // Take the hashed password and check if it's hashed version matches the stored password
            if(md5($password) == $hashed_password){
                // Check if the account is active
                if($active_account){
                    $_SESSION['user_id'] = $row["id"];
                    $_SESSION['number_of_posts'] = $row["number_of_posts"];
                    $_SESSION['first_name'] = $row["first_name"];
                    $_SESSION['last_name'] = $row["last_name"];
                    $_SESSION['user_name'] = $row["username"];
                    $_SESSION['address'] = $row["address"];
                    $_SESSION['email'] = $row["email"];
                    $_SESSION["phone_number"]  = $row["phone_number"];
                    $_SESSION["address"]  = $row["address"];
                    $_SESSION["twitter_username"] = $row["twitter_username"];
                    $_SESSION["instagram_username"] = $row["instagram_username"];
                    $_SESSION["facebook_username"] = $row["facebook_username"];
                    $_SESSION['user_logged_in'] = true;
                    $username = $_SESSION['user_name'];
                    $_SESSION['login_success_message'] = "Hello, $username. You are Welcome!";
                    header("location: ../index.php");
                }else{//if the account is not active
                    $_SESSION['not_active'] = true;
                    $_SESSION['login_error_message'] = "This Account Is Deactivated";
                    header('location: ../register.php');
                }
                
            }else{// if the passwords are not the same
                $_SESSION['login_error_message'] = "Invalid credentials";
                header('location: ../register.php');
            }
        }
    }
}