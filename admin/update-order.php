<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content all-center">
            <div class = "wrapper">
                
                <h1>Update Order</h1>
                <br>
                
                <?php 
                    if (isset($_GET['id'])) {
                        //1 get the id of selected admin
                        $id=$_GET['id'];

                        //2 create query to the the details;
                        $sql = "SELECT * FROM tbl_order WHERE id=$id";

                        //3 exe
                        $res = mysqli_query($conn, $sql);


                        if ($res==true) {
                            //check if data available
                            $count = mysqli_num_rows($res);
                            if ($count == 1) {
                                $rows = mysqli_fetch_assoc($res);
                                $food = $rows['food'];
                                $price = $rows['price'];
                                $qty = $rows['qty'];
                                $total = $rows['total'];
                                $order_date = $rows['order_date'];
                                $status = $rows['status'];
                                $customer_name = $rows['customer_name'];
                                $customer_contact = $rows['customer_contact'];
                                $customer_email= $rows['customer_email'];
                                $customer_address = $rows['customer_address'];
                            } else {
                                //redirect to manage admin page
                                $_SESSION['no-order-found'] = "<div class='error'>Failed to update the category</div>";
                                header("location:".SITEURL.'admin/manage-categories.php');
                            }
                        } 
                    } else {
                        header("location:".SITEURL.'admin/manage-order.php');
                    }
                    

                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                        <tr>
                            <td>Food Name: </td>
                            <td><?php echo $food ?></td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td><?php echo "$ $price" ?></td>
                        </tr>
                        <tr>
                            <td>Quantity: </td>
                            <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                        </tr>
                        <tr>
                            <td>Status: </td>
                            <td><select name="status">
                                <option <?php if($status == "Ordered") {echo "selected";}?> value="Ordered">Ordered</option>
                                <option <?php if($status == "On Delivery") {echo "selected";}?> value="On Delivery">On Delivery</option>
                                <option <?php if($status == "Delivered") {echo "selected";}?> value="Delivered">Delivered</option>
                                <option <?php if($status == "Ordered") {echo "Canceled";}?> value="Canceled">Canceled</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Customer Name: </td>
                            <td><input type="text" name="customer_name" value = "<?php echo $customer_name ?>"></td>
                        </tr>
                        <tr>
                            <td>Customer Contact: </td>
                            <td><input type="text" name="customer_contact" value = "<?php echo $customer_contact ?>"></td>
                        </tr>
                        <tr>
                            <td>Customer Email: </td>
                            <td><input type="text" name="customer_email" value = "<?php echo $customer_email ?>"></td>
                        </tr>
                        <tr>
                            <td>Customer Address: </td>
                            <td><textarea name="customer_address" cols = "30" rows = "5"><?php echo $customer_address ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="manage-order.php" class="btn-primary btn-gapfix">Cancel</a>
                                <input type="hidden" name="id" value = "<?php echo $id?>">
                                <input type="hidden" name="price" value = "<?php echo $price?>">
                                <input type="submit" name="submit" value="Update Order" class="btn-primary">
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
        $id = $_POST['id'];
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $status = "ordered";
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email= $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        //sql query to save data into data base
        $sql2 = "UPDATE tbl_order SET
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email= '$customer_email',
            customer_address = '$customer_address'
            WHERE id = $id
        ";
        echo $sql2;
        // execute query and save data in DB
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
        if ($res2==true) {
            echo "Order Updated!";
            $_SESSION['Update']= "<div class='success'>Order Updated!</div>";
            header("location:".SITEURL.'admin/manage-order.php');
        } else {
            // echo "Failed to update the Admin password";
            $_SESSION['update']= "<div class='error'>Failed to update the order!</div>";
            header("location:".SITEURL.'admin/manage-order.php');
        }
    } 
?>
