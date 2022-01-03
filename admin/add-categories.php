
<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Add Category</h1>
                <br>

                <?php
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title: </td>
                            <td><input type="text" name="title" placeholder="Input food name"></td>
                        </tr>
                        <tr>
                            <td>Select Image: </td>
                            <td><input type="file" name="image" ></td>
                        </tr>
                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input type="radio" name="featured" value="Yes">Yes
                                <input type="radio" name="featured" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td>Active: </td>
                            <td>
                                <input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="manage-categories.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="submit" name="submit" value="Add Category" class="btn-primary">
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
        //get data from the form
        $title = $_POST['title'];

        if(isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        } else {
            $featured = "No";
        }

        if(isset($_POST['active'])) {
            $active = $_POST['active'];
        } else {
            $active = "No";
        }


        // print_r($_FILES['image']);
        // die();


        if(isset($_FILES['image']['name'])) {
            //upload
            $image_name = $_FILES['image']['name'];
            if ($image_name != "") {
                //auto rename
                //get extension of image
                $ext = end(explode('.', $image_name));

                $image_name = $title."_Category_".rand(000,999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/categories/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                // ini_set('display_errors',1); error_reporting(E_ALL);
                // check if image is uploaded
                if($upload == false) {
                    $_SESSION['upload']= "<div class='error'>Category image failed to add!</div>";
                    header("location:".SITEURL.'admin/add-categories.php');
                    die();
                } 
            }
            
        } else {
            //not upload
            $image_name = "";
        }

        //sql query to save data into data base
        $sql = "INSERT INTO tbl_categories SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
        ";
       
        // execute query and save data in DB
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
  
        //check if new query is inserted or not
        if($res==true) {
            //insert
            //echo "Admin successfully added!";
            //session message

            $_SESSION['add']= "<div class='success'>Category successfully added!</div>";
            header("location:".SITEURL.'admin/manage-categories.php');
        } else {
            //failed to insert
            $_SESSION['add']= "<div class='error'>Failed to add a new category!<div>";
            header("location:".SITEURL.'admin/add-categories.php');
        }
    } 
?>
