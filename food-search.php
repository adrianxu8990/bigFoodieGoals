<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php $search = $_POST['search']; ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR descriptions LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while($rows = mysqli_fetch_assoc($res)) {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        $descriptions = $rows['descriptions'];
                        $price = $rows['price'];

                        ?>
                        <div class="food-menu-box">
                            <div class='food-menu-img'>
                            <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Food image not available!<div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>
                                </div>
                            <div class='food-menu-desc'>
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-desc"><?php echo $descriptions; ?></p>

                                <br>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                                <div class = "clearfix"></div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='error'>No"; ?> <?php echo $search; ?> <?php echo "in the restarunt!<div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php')?>