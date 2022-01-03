<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Update Category</h1>
                <br>

                <?php 
                    if (isset($_GET['id'])) {
                        //1 get the id of selected admin
                        $id=$_GET['id'];

                        //2 create query to the the details;
                        $sql = "SELECT * FROM tbl_categories WHERE id=$id";

                        //3 exe
                        $res = mysqli_query($conn, $sql);


                        if ($res==true) {
                            //check if data available
                            $count = mysqli_num_rows($res);
                            if ($count == 1) {
                                $row = mysqli_fetch_assoc($res);

                                $title = $row['title'];
                                $current_image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                            } else {
                                //redirect to manage admin page
                                $_SESSION['no-category-found'] = "<div class='error'>Failed to update the category</div>";
                                header("location:".SITEURL.'admin/manage-categories.php');
                            }
                        } else {
                            // echo "Failed to delete the Admin";
                            $_SESSION['no-category-found'] = "<div class='error'>Failed to update the category</div>";
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                    } else {
                        header("location:".SITEURL.'admin/manage-categories.php');
                    }
                    

                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title: </td>
                            <td><input type="text" name="title" value = "<?php echo $title ?>"></td>
                        </tr>
                        <tr>
                            <td>Current Image: </td>
                            <td><?php  
                                if ($current_image != "") {
                                    ?> <img src="<?php echo SITEURL; ?>images/categories/<?php echo $current_image; ?>" alt="$title" width="150px">
                                    <?php
                                } else {
                                    echo "<div class='error'>Image NOT availabe!</div>";
                                }
                            ?></td>
                        </tr>
                        <tr>
                            <td>Select New Image: </td>
                            <td><input type="file" name="image" ></td>
                        </tr>
                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                                <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td>Active: </td>
                            <td>
                                <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                                <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="manage-categories.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="hidden" name="current_image" value = "<?php echo $current_image?>">
                                <input type="hidden" name="id" value = "<?php echo $id?>">
                                <input type="submit" name="submit" value="Update Category" class="btn-primary">
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
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //deal w new image
        if(isset($_FILES['image']['name'])) {
            //upload
            $image_name = $_FILES['image']['name'];
            if ($image_name != "") {
                //delete old pic
                if ($current_image != "") {
                    $rm_path = "../images/categories/".$current_image;
                    $remove = unlink($rm_path);
                    if ($remove == false) {
                        $_SESSION['remove'] = "<div class='error'>Failed to delete the image!</div>";
                        header("location:".SITEURL.'admin/manage-categories.php');
                        die();
                    }
                }

                //upload new
                $ext = end(explode('.', $image_name));

                $image_name = $title."_Category_".rand(000,999).'.'.$ext;
    
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/categories/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                // ini_set('display_errors',1); error_reporting(E_ALL);
                // check if image is uploaded
                if($upload == false) {
                    $_SESSION['upload']= "<div class='error'>Category image failed to add!</div>";
                    header("location:".SITEURL.'admin/manage-categories.php');
                    die();
                } 
            } else {
                $image_name = $current_image;
            }
            //auto rename
            //get extension of image
            
        } else {
            //not upload
            $image_name = $current_image;
        }

        //sql query to save data into data base
        $sql2 = "UPDATE tbl_categories SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id
        ";
       
        // execute query and save data in DB
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
  
        //check if new query is inserted or not
        if($res2==true) {
            $_SESSION['update']= "<div class='success'>Category successfully updated!</div>";
            header("location:".SITEURL.'admin/manage-categories.php');
        } else {
            //failed to insert
            $_SESSION['update']= "<div class='error'>Failed to update the category!<div>";
            header("location:".SITEURL.'admin/manage-categories.php');
        }
    } 
?>
