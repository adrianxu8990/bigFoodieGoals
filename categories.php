<?php include('partials-front/menu.php')?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>
            <?php 
                $sql = "SELECT * FROM tbl_categories WHERE active = 'Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while($rows = mysqli_fetch_assoc($res)) {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        ?>
                        <a href="#">
                            <div class="box-3 float-container">
                                <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Category image not available!<div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/categories/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class = "img-responsive img-curve">
                                    <?php
                                }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "<div class='error'>No category in the DB!<div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php')?>
