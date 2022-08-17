<?php
session_start();
if(isset($_POST['logout-btn'])){
    // session_destroy();

    unset( $_SESSION['user_id']);

    $_SESSION['message'] = "Logged Out Successfully";
    header('location: login.php');
    exit(0);
}


?>