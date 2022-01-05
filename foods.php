<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!--FoodMenu starts Here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes'";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    while($rows2 = mysqli_fetch_assoc($res2)) {
                        $id2=$rows2['id'];
                        $title2=$rows2['title'];
                        $image_name2=$rows2['image_name'];
                        $descriptions2 = $rows2['descriptions'];
                        $price2 = $rows2['price'];

                        ?>
                        <div class="food-menu-box">
                            <div class='food-menu-img'>
                            <?php
                                if ($image_name2 == "") {
                                    echo "<div class='error'>Food image not available!<div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name2; ?>" alt="<?php echo $title2; ?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>
                                </div>
                            <div class='food-menu-desc'>
                                <h4><?php echo $title2; ?></h4>
                                <p class="food-price"><?php echo $price2; ?></p>
                                <p class="food-desc"><?php echo $descriptions2; ?></p>

                                <br>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                                <div class = "clearfix"></div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='error'>No foods in the DB!<div>";
                }
            ?>

            <div class = "clearfix"></div>
        </div>
    </section>
    <!--FoodMenu ends Here-->

    <?php include('partials-front/footer.php')?>