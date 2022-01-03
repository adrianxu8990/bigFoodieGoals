<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Update Admin Password</h1>
                <br>

                <?php 
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                ?>


                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Current Password: </td>
                            <td><input type="password" name="current_password" place_holder="Current Password"></td>
                        </tr>
                        <tr>
                            <td>New Password: </td>
                            <td><input type="password" name="new_password" place_holder="New Password"></td>
                        </tr>
                        <tr>
                            <td>Confirm Password: </td>
                            <td><input type="password" name="confirm_password" place_holder="Confirm Password"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="manage-admin.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="hidden" name="id" value = "<?php echo $id?>">
                                <input type="submit" name="submit" value="Update Password" class="btn-primary">
                            </td>
                        </tr>

                    </table>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Ends Here -->


        <?php 
        //check if the submit bottom is clicked or not
            if(isset($_POST['submit'])) {
                //get all the info from form to update;
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                // echo $id + " "  + $current_password +  " " + $new_password ;

                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";
                $res = mysqli_query($conn, $sql);

                if ($res==true) {
                    $count=mysqli_num_rows($res);
                    if ($count == 1) {
                        if ($new_password == $confirm_password) {
                            $sql2 = " UPDATE tbl_admin SET
                                password = '$new_password' WHERE 
                                id=$id
                            ";
                            $res2 = mysqli_query($conn, $sql2);
                            if ($res2==true) {
                                $_SESSION['change-pwd']= "<div class='success'>Admin password successfully updated!</div>";
                                header("location:".SITEURL.'admin/manage-admin.php');
                            } else {
                                $_SESSION['change-pwd']= "<div class='error'>Admin password NOT updated!</div>";
                                header("location:".SITEURL.'admin/manage-admin.php');
                            }
                        } else {
                            $_SESSION['pwd-not-match']= "<div class='error'>Please enter the SAME passwords!</div>";
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    } else {
                        $_SESSION['user-not-found']= "<div class='error'>Current password does not match our record!</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
            }
        ?>

 <?php include('partials/footer.php'); ?>
