<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content">
            <div class = "wrapper">
                <h1 class="text-center">Manage Categories</h1>
                <br>
                <!-- Button to add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-categories.php" class="btn-primary">Add Categories</a>
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

                    if(isset($_SESSION['remove'])) {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['no-category-found'])) {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    // if(isset($_SESSION['change-pwd'])) {
                    //     echo $_SESSION['change-pwd'];
                    //     unset($_SESSION['change-pwd']);
                    // }
                ?>


                <table class="tbl-full">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_categories";

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
                                    $featured=$rows['featured'];
                                    $active=$rows['active'];
                                        //display
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.</td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php 
                                            if($image_name != "") {
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/categories/<?php echo $image_name; ?>" alt="$title" width="100px">
                                                <?php
                                            } else {
                                                echo "<div class='error'>Image NOT availabe!</div>";
                                            }
                                        
                                        ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-primary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-primary">Delete Category</a>
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