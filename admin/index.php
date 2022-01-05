<?php include('partials/menu.php'); ?>

        <!-- Main Content Starts Here -->
        <div class="main-content">
            <div class = "wrapper">
                <h1 class="text-center">DASHBOARD</h1><br>
                <?php
                    if(isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    Categories

                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    Foods

                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    Orders

                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br>
                    Total Revenue

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Ends Here -->

<?php include('partials/footer.php'); ?>