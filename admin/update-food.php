<?php include('partials/menu.php'); ?>

<?php 
    if (isset($_GET['id'])) {
        //1 get the id of selected admin
        $id=$_GET['id'];

        //2 create query to the the details;
        $sql3 = "SELECT * FROM tbl_food WHERE id=$id";

        //3 exe
        $res3 = mysqli_query($conn, $sql3);

        $row3 = mysqli_fetch_assoc($res3);

        $title = $row3['title'];
        $description = $row3['descriptions'];
        $current_image = $row3['image_name'];
        $current_price = $row3['price'];
        $current_category_id = $row3['category_id'];
        $featured = $row3['featured'];
        $active = $row3['active'];
    } else {
        header("location:".SITEURL.'admin/manage-food.php');
    }
?>
        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                <h1>Update Food</h1>
                <br>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Title: </td>
                            <td><input type="text" name="title" value = "<?php echo $title ?>"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Description: </td>
                            <td><textarea name="description" col="30" rows="5"><?php echo $description; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td><input type="number" name="price" value = "<?php echo $current_price ?>"></td>
                        </tr>
                        <tr>
                            <td>Current Image: </td>
                            <td><?php  
                                if ($current_image != "") {
                                    ?> <img src="<?php echo SITEURL; ?>images/foods/<?php echo $current_image; ?>" alt="$title" width="150px">
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
                            <td>Category: </td>
                            <td><select name="category">
                                <?php
                                    //display categories from database
                                    //1. create active queries
                                    $sql = "SELECT * FROM tbl_categories WHERE active = 'Yes'";

                                    $res = mysqli_query($conn, $sql);
                                    
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $cate_id = $row['id'];
                                            $cate_title = $row['title'];
                                            ?>
                                                <option <?php if($current_category_id==$cate_id) {echo "selected";} ?> value="<?php echo $cate_id; ?>" > <?php echo $cate_title; ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo "<option value='0'>Category NOT available!</option>";
                                    }
                                    //display on drop down
                                ?>
                            </select></td>
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
                                <a href="manage-food.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="hidden" name="current_image" value = "<?php echo $current_image?>">
                                <input type="hidden" name="id" value = "<?php echo $id?>">
                                <input type="submit" name="submit" value="Update Food" class="btn-primary">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        header("location:".SITEURL.'admin/manage-food.php');
        //deal w new image
        if(isset($_FILES['image']['name'])) {
            //upload   new image name
            $image_name = $_FILES['image']['name'];
            $ext4 = end(explode('.', $image_name));
            $sql4 = "SELECT * FROM tbl_categories WHERE id=$category";
            $res4 = mysqli_query($conn, $sql4);
            $row4 = mysqli_fetch_assoc($res4);
            $cate_title4 = $row4['title'];

            if ($image_name != "") {
                //delete old pic
                if ($current_image != "") {
                    $rm_path = "../images/foods/".$current_image;
                    $remove = unlink($rm_path);
                    if ($remove == false) {
                        $_SESSION['remove'] = "<div class='error'>Failed to delete the image!</div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                        die();
                    }
                }

                //upload new
                $image_name = $title."_".$cate_title4."_".rand(000,999).'.'.$ext4;
    
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/foods/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                // ini_set('display_errors',1); error_reporting(E_ALL);
                // check if image is uploaded
                if($upload == false) {
                    $_SESSION['upload']= "<div class='error'>Food image failed to add!</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
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
        $sql2 = "UPDATE tbl_food SET
            title = '$title',
            descriptions = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            WHERE id = $id
        ";
       
        // execute query and save data in DB
        $res2 = mysqli_query($conn, $sql2);
        //check if new query is inserted or not
        if($res2==true) {
            $_SESSION['update2']= "<div class='success'>Food successfully updated!</div>";
            header("location:".SITEURL.'admin/manage-food.php');
        } else {
            //failed to insert
            $_SESSION['update2']= "<div class='error'>Failed to update the Food!<div>";
            header("location:".SITEURL.'admin/manage-food.php');
        }
    } 
?>
