<?php
require_once '../config/config.php';
$mysqli = new mysqli("localhost", "root", "","social") or die(mysqli_error($mysqli));


if(isset($_POST["reactivate_account"])){
    //Get the passed fields
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Query the database with the passed email
    $result = $mysqli->query("SELECT * FROM User WHERE email='$email'") or die($mysqli->error);
    $num_rows = mysqli_num_rows($result);

    //If there is no row, then the email is invalid
    if($num_rows < 1) {
        $_SESSION['activation_error'] = "Invalid credentials";
        header('location: ../views/activate_account.php');
    }else{
        while($row = $result->fetch_assoc()){
            $hashed_password = $row["user_password"];
            $active_account = $row["is_active"];
            $user_id = $row["id"];
            if(md5($password) == $hashed_password){
                if(!$active_account){// Check if the acount is deactivated
                    $mysqli->query("UPDATE User SET is_active =1 WHERE id=$user_id") or die($mysqli->error);
                    $_SESSION['activation_success'] = "Your account has been successfully activated. You can now login";
                    header("location: ../register.php");
                }else{// if the account is active
                    $_SESSION['activation_error'] = "The credentials are for a valid account";
                    header('location: ../views/activate_account.php');
                }
                
            }else{
                $_SESSION['activation_error'] = "Invalid credentials";
                header('location: ../views/activate_account.php');
            }
        }
    }
}