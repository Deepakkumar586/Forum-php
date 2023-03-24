<?php
$showError = false;
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db_connect.php';
    $user_email = $_POST['signupEmail'];
    $user_password = $_POST['password'];
    $cpass = $_POST['cpassword'];

    //check weather this email exist

    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn,$existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "user_Email already use";
    }
    else{
        if(($user_password == $cpass)){
            $hash = password_hash($user_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ('$user_email','$hash',current_timestamp())";
            $result = mysqli_query($conn,$sql);
            
            if($result){
                $showAlert = true;
                header("location:/Forum/index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match";
            
        }
    }
    header("location:/Forum/index.php?signupsuccess=false&error= $showError");



 }


?>