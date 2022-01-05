<?php include('partials-front/menu.php')?>

    <!--Categories starts Here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php 
                $sql = "SELECT * FROM tbl_categories WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while($rows = mysqli_fetch_assoc($res)) {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
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
    <!--Categories ends Here-->

    <!--FoodMenu starts Here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
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

    <!--Search starts Here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Try search Xiao long bao" required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--Search ends Here-->


    <?php include('partials-front/footer.php')?>