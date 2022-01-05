<?php 
    include('../config/constants.php');
?>




<html>
    <head>
        <title>Login - Food Ordering System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br>
            <!-- Login form starts here -->
                <form action="" method="POST" class="text-center">
                    Username:
                    <input type="text" name="username" placeholder="Enter Username"><br><br>
                
                    Password:  
                    <input type="password" name="password" placeholder="Enter Password"><br><br>
                
                    <!-- <a href="manage-admin.php" class="btn-primary btn-gapfix">Cancel</a> -->
                    <input type="submit" name="submit" value="Login" class="btn-primary">
                </form>
            <!-- Login form ends here -->
        </div>
    </body>
</html>


<?php 
    //check if submitted
    if(isset($_POST['submit'])) {
        //porcess for login
        //1 get data from the form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2 create sql to check if user is in record or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

        //3 exe query
        $res = mysqli_query($conn, $sql);

        //4 check count see if we have the user
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //available
            $_SESSION['login'] = "<div class='success text-center'>Login Successful!</div>";
            $_SESSION['user'] = $username;
            header("location:".SITEURL.'admin/');
        } else {
            //not available
            $_SESSION['login'] = "<div class='error text-center'>Username or password did not match our record!</div>";
            header("location:".SITEURL.'admin/login.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>