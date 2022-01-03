
<?php 
    include('../config/constants.php'); 
//1 get the id to be deleted
    $id = $_GET['id'];

//2 create query to delete
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

//3 redirect to admin see if successful;
    $res = mysqli_query($conn, $sql);

    if ($res==true) {
        // echo "Admin Deleted";
        // session var to display message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    } else {
        // echo "Failed to delete the Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete the Admin</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }

?>

<?php include('partials/footer.php'); ?>