<?php 
    //SUtorization
    //check if the user is logged in
    if(!isset($_SESSION['user'])) { // if user session not set - not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin panel!</div>";
        header("location:".SITEURL.'admin/login.php');
    }
?>