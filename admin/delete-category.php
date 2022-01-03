
<?php 
    include('../config/constants.php'); 
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        echo "got cha";
        //1 get the id to be deleted
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if ($image_name != "") {
            $path = "../images/categories/".$image_name;
            $remove = unlink($path);
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to delete the image!</div>";
                header("location:".SITEURL.'admin/manage-categories.php');
                die();
            }
        }

        //2 create query to delete
            $sql = "DELETE FROM tbl_categories WHERE id=$id";
        
        //3 redirect to admin see if successful;
            $res = mysqli_query($conn, $sql);
        
            if ($res==true) {
                // session var to display message 
                $_SESSION['delete'] = "<div class='success'>Category Deleted</div>";
                header("location:".SITEURL.'admin/manage-categories.php');
                
            } else {
                // echo "Failed to delete the Admin";
                $_SESSION['delete'] = "<div class='error'>Failed to delete the category</div>";
                header("location:".SITEURL.'admin/manage-categories.php');
            }

    } else {
        header("location:".SITEURL.'admin/manage-categories.php');
    }


?>