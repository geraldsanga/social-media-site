<?php
    require_once '../config/config.php';

    $mysqli = new mysqli("localhost", "root", "","social") or die(mysqli_error($mysqli));

    if(isset($_POST['update_button'])){
        //Get all user variables
        $user_id = $_POST["user_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $user_name = $_POST["user_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone_number"];
        $address = $_POST["address"];
        $twitter = $_POST["twitter_username"];
        $instagram = $_POST["instagram_username"];
        $facebook = $_POST["facebook_username"];

        $first_name_is_valid = false;
        $last_name_is_valid = false;
        $user_name_is_valid = false;
         //validation 2: check length of the first name
        if(strlen($first_name) > 3 || strlen($first_name < 25)){
            $first_name_is_valid = true;

            }else{
                $_SESSION['update_error_message'] = "Frist Name must be between 3 and 25 characters";
                header("location: ../views/user_account.php");
            }

            //validation 3: check length of the last name
            if(strlen($last_name) > 3 || strlen($last_name < 25)){
                $last_name_is_valid = true;
            }else{
                $_SESSION['update_error_message'] = "Last Name must be between 3 and 25 characters";
                header("location: ../views/user_account.php");
            }

            //validation 4:  length of the user name and it's existance int he database
            if($user_name == $_SESSION['user_name']){
                $user_name_is_valid = true;
            }else{
                if(strlen($user_name) > 2 || strlen($user_name < 25)){
                    if(preg_match('/[^A-Za-z0-9]/', $user_name)){
                    }else{
                    $result = $mysqli->query("SELECT username FROM User WHERE username='$user_name'") or die($mysqli->error);
    
                    $num_rows = mysqli_num_rows($result);
                    if($num_rows > 0) {
                    $_SESSION['update_error_message'] = "The username is already in use";
                    header("location: ../views/user_account.php");
    
                    }else{
                    $user_name_is_valid = true;
                    }
                    }
                }else{
                    $_SESSION['update_error_message'] = "User Names must be between 2 and 25 characters";
                    header("location: ../views/user_account.php");
    
                }
            }
            

            // //validation 5: check email's existance in the database
            function email_is_available($email, $session_email, $mysqli){
                if($email == $session_email){
                    return true;
                }else{
                    $result = $mysqli->query("SELECT email FROM User WHERE email='$email'") or die($mysqli->error);
                    $num_rows = mysqli_num_rows($result);
                    if($num_rows > 0) {
                    $_SESSION['update_error_message'] = "The email is already in use";
                    header("location: ../views/user_account.php");
                    }else{
                    return true;
                    }
                }
            }

        $email_is_available = email_is_available($email, $_SESSION['email'], $mysqli);
        //Update Session variables

        if($first_name_is_valid && $last_name_is_valid && $user_name_is_valid && $email_is_available){
            $_SESSION["first_name"] = $_POST["first_name"];
            $_SESSION["last_name"] = $_POST["last_name"];
            $_SESSION["user_name"] = $_POST["user_name"];
            $_SESSION["email"]  = $_POST["email"];
            $_SESSION["phone_number"]  = $_POST["phone_number"];
            $_SESSION["address"]  = $_POST["address"];
            $_SESSION["twitter_username"] = $_POST["twitter_username"];
            $_SESSION["instagram_username"] = $_POST["instagram_username"];
            $_SESSION["facebook_username"] = $_POST["facebook_username"];
            $result = $mysqli->query("UPDATE User SET first_name = '$first_name', last_name= '$last_name', username='$user_name', phone_number='$phone_number', email='$email', 
            instagram_username='$instagram', twitter_username='$twitter', facebook_username='$facebook', address='$address' WHERE id=$user_id") or die($mysqli->error);
            $_SESSION["account_update_sucess"] = "Your account has been update successfully";
            header("location: ../views/user_account.php");
        }
    }