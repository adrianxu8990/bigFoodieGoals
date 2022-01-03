<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Add Admin</h1>
                <br>

                <?php
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td><input type="text" name="full_name" placeholder="John Smith"></td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" placeholder="johnsmith7"></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder="Do not use your username"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="manage-admin.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                            </td>
                        </tr>

                    </table>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Ends Here -->

 <?php include('partials/footer.php'); ?>


 <?php 
    //process the value from the form into DB
    //check if the submit button is clicked or not 
    if(isset($_POST['submit'])) {
        // echo "Botton clicked";
        //get data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password emcryption w MD5

        //sql query to save data into data base
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // echo "!!!!!";
        // echo $sql;
        // echo $conn;

        // execute query and save data in DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //check if new query is inserted or not
        if($res == TRUE) {
            //insert
            //echo "Admin successfully added!";
            //session message
            $_SESSION['add']= "<div class='success'>Admin successfully added!</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
            echo $sql;
        } else {
            //failed to insert
            $_SESSION['add']= "<div class='error'>Failed to add new Admin!<div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    } 
 ?>