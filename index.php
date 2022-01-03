<?php include('partials-front/menu.php')?>

    <!--Categories starts Here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>
            <a href="#">
            <div class="box-3 float-container">
                <img src="images/categories_pizza.jpeg" alt="pizza photo" class = "img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/categories_chinese.jpg" alt="chinese food photo" class = "img-responsive img-curve">

                <h3 class="float-text text-white">Chinese</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/categories_mexican.jpeg" alt="mexican food photo" class = "img-responsive img-curve">
                
                <h3 class="float-text text-white">Mexican</h3>
            </div>
            </a>

            <div class="clearfix"></div>

        </div>
    </section>
    <!--Categories ends Here-->

    <!--FoodMenu starts Here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <div class="food-menu-box">
                <div class='food-menu-img'>
                    <img src="images/exploreMenu/shumai.jpg" alt="shumai" class="img-responsive img-curve">
                </div>
                <div class='food-menu-desc'>
                    <h4>Shrimp Shumai</h4>
                    <p class="food-price">$4.99</p>
                    <p class="food-desc">Shrimp, corn</p>

                    <br>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                    <div class = "clearfix"></div>
                </div>
            </div>


            <div class="food-menu-box">
                <div class='food-menu-img'>
                    <img src="images/exploreMenu/ramen.jpg" alt="reman" class="img-responsive img-curve">
                </div>
                <div class='food-menu-desc'>
                    <h4>Ramen</h4>
                    <p class="food-price">$15.99</p>
                    <p class="food-desc">noodles, pork, egg, nori, corn</p>

                    <br>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                    <div class = "clearfix"></div>
                </div>
            </div>


            <div class="food-menu-box">
                <div class='food-menu-img'>
                    <img src="images/exploreMenu/beijingDuck.jpg" alt="beijing duck" class="img-responsive img-curve">
                </div>
                <div class='food-menu-desc'>
                    <h4>Beijing Duck</h4>
                    <p class="food-price">$39.99</p>
                    <p class="food-desc">duck, bun, green onion, carrot</p>

                    <br>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                    <div class = "clearfix"></div>
                </div>
            </div>


            <div class="food-menu-box">
                <div class='food-menu-img'>
                    <img src="images/exploreMenu/burger.jpg" alt="burger" class="img-responsive img-curve">
                </div>
                <div class='food-menu-desc'>
                    <h4>Bacon Burger</h4>
                    <p class="food-price">$5.99</p>
                    <p class="food-desc">beef, bacon, lettuce, tomato</p>

                    <br>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                    <div class = "clearfix"></div>
                </div>
            </div>

            <div class = "clearfix"></div>
        </div>
    </section>
    <!--FoodMenu ends Here-->

    <!--Search starts Here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="">
                <input type="search" name="search" placeholder="Try search Xiao long bao">
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--Search ends Here-->


    <?php include('partials-front/footer.php')?>