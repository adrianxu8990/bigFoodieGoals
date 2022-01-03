<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content">
            <div class = "wrapper">
                <h1 class="text-center">Manage Foods</h1>
                <br>
                <!-- Button to add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br /> <br />


                <?php
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update2'])) {
                        echo $_SESSION['update2'];
                        unset($_SESSION['update2']);
                    }

                    if(isset($_SESSION['remove'])) {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                ?>


                <table class="tbl-full">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_food";
                        // echo "$conn ===========";
                        $res = mysqli_query($conn, $sql);

                        if ($res == TRUE) {
                            //count rows to check if we have data in tbl;
                            $count = mysqli_num_rows($res);

                            $sn = 1;
                            if ($count > 0){
                                while($rows = mysqli_fetch_assoc($res)) {
                                    $id=$rows['id'];
                                    $title=$rows['title'];
                                    $image_name=$rows['image_name'];
                                    $category = $rows['category_id'];
                                    $price=$rows['price'];
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];
                                        //display
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php 
                                            $sql2 = "SELECT * FROM tbl_categories WHERE id = $category";

                                            $res2 = mysqli_query($conn, $sql2);
                                            
                                            $count = mysqli_num_rows($res2);
                                            if ($count == 1) {
                                                $row = mysqli_fetch_assoc($res2);
                                                echo $row['title'];
                                            }
                                        ?></td>
                                        <td><?php echo "$ $price";; ?></td>
                                        <td><?php 
                                            if($image_name != "") {
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name; ?>" alt="$title" width="100px">
                                                <?php
                                            } else {
                                                echo "<div class='error'>Image NOT availabe!</div>";
                                            }
                                        
                                        ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-primary">Update food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-primary">Delete Food</a>
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