<?php include('partials-front/menu.php')?>

<?php

    if(isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_categories WHERE id = $category_id";
        $res = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
        
    } else {
        header("location:".SITEURL);
    }


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
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

            </div>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php')?>