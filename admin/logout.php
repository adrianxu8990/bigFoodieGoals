<?php 
    include('../config/constants.php');
    //1 destory the session
    session_destroy();
    //2 redirection to login page
    // $_SESSION['logout'] = "<div class='error text-center'>You have successfully logged out!</div>";
    header("location:".SITEURL.'admin/login.php');
 ?>


