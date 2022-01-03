<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

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


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>