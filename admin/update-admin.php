<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Update Admin</h1>
                <br>

                <?php 

                    //1 get the id of selected admin
                    $id=$_GET['id'];
                
                    //2 create query to the the details;
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                    //3 exe
                    $res = mysqli_query($conn, $sql);


                    if ($res==true) {
                        //check if data available
                        $count = mysqli_num_rows($res);
                        if ($count == 1) {
                            $row = mysqli_fetch_assoc($res);

                            $full_name = $row['full_name'];
                            $username = $row['username'];
                            
                        } else {
                            //redirect to manage admin page
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    } else {
                        // echo "Failed to delete the Admin";
                        $_SESSION['update'] = "<div class='error'>Failed to update the Admin</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                
                ?>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td><input type="text" name="full_name" value = "<?php echo $full_name?>"></td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" value = "<?php echo $username?>"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <a href="manage-admin.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="hidden" name="id" value = "<?php echo $id?>">
                                <input type="submit" name="submit" value="Update Admin" class="btn-primary">
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
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                $sql = "UPDATE tbl_admin SET
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id = $id
                ";

                $res = mysqli_query($conn, $sql);

                if ($res==true) {
                        $_SESSION['update']= "<div class='success'>Admin successfully updated!</div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                } else {
                    // echo "Failed to update the Admin password";
                    $_SESSION['update']= "<div class='error'>Admin was not updated!</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

 <?php include('partials/footer.php'); ?>
