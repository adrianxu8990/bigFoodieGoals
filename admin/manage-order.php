<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content">
            <div class = "wrapper">
                <h1 class="text-center">Manage Order</h1>
                <br>
                <?php
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table class="tbl-full">

                    <tr>
                        <th>ID</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        if ($res == TRUE) {
                            //count rows to check if we have data in tbl;
                            $count = mysqli_num_rows($res);

                            $sn = 1;
                            if ($count > 0){
                                while($rows = mysqli_fetch_assoc($res)) {
                                    $id=$rows['id'];
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
                                        //display
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-primary">Update Order</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {

                            }
                        }
                    ?>
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Ends Here -->

 <?php include('partials/footer.php'); ?>