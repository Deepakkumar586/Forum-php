<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db_connect.php';
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $address = $_POST['address'];
    $sql = " INSERT INTO `conatctme` (`name`, `email`, `address`) VALUES ('$user_name', '$user_email', '$address')";
    $result = mysqli_query($conn,$sql);
    exit();
    
}
header("location: /forum/index.php");





?>