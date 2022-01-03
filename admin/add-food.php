
<?php include('partials/menu.php'); ?>

<!-- Main Content Starts Here -->
<div class="main-content all-center">
    <div class = "wrapper">
        
        <h1>Add Food</h1>
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
                    <td>Description: </td>
                    <td><textarea name="description" col="30" rows="5" placeholder="Input food description"></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" step="0.01" name="price" placeholder="5.99"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" ></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td><select name="category">
                        <option value="-1"></option>
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
                                        <option value=<?php echo $cate_id; ?>><?php echo $cate_title; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="-1">NO categories found!</option>
                                <?php
                            }
                        ?>
                    </select></td>
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
                        <a href="manage-food.php" class="btn-primary btn-gapfix">Cancel</a>
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
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
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        // echo $category;

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
        
        //check if image is added
        if(isset($_FILES['image']['name'])) {
            //upload
            $image_name = $_FILES['image']['name'];
            if ($image_name != "") {
                //auto rename
                //get extension of image
                //upload new
                $ext4 = end(explode('.', $image_name));
                $sql4 = "SELECT * FROM tbl_categories WHERE id=$category";
                $res4 = mysqli_query($conn, $sql4);
                $row4 = mysqli_fetch_assoc($res4);
                $cate_title4 = $row4['title'];
                $image_name = $title."_".$cate_title4."_".rand(000,999).'.'.$ext4;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/foods/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if($upload == false) {
                    $_SESSION['upload']= "<div class='error'>Food image failed to add!</div>";
                    header("location:".SITEURL.'admin/add-food.php');
                    die();
                } 
            }
        } else {
            //not upload
            $image_name = "";
        }
        //sql query to save data into data base
        $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            descriptions = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
        ";
        // execute query and save data in DB
        $res2 = mysqli_query($conn, $sql2);
        //check if new query is inserted or not
        if($res2==true) {
            $_SESSION['add']= "<div class='success'>New Food successfully added!</div>";
            header("location:".SITEURL.'admin/manage-food.php');
        } else {
            //failed to insert
            $_SESSION['add']= "<div class='error'>Failed to add a new food!<div>";
            header("location:".SITEURL.'admin/manage-food.php');
        }
    } 
?>
