<?php include('partials-front/menu.php')?>
<?php

    if(isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
        
        $res = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $descriptions = $row['descriptions'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("location:".SITEURL.'index.php');
    }


?>
    <!-- fOOD ordering Section Starts Here -->
    <section class="food-search-2">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <br>
                        <h1><?php echo $title; ?></h1>
                        <input type="hidden" name="food" value="<?php echo $title; ?>"> 
                        <h4><?php echo $price; ?></h4>
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> 
                        <h5><?php echo $descriptions; ?></h5>

                        <br>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="John Smith" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="xxx-xxx-xxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="jsmith@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Street, Unit, City, Zip Code" class="input-responsive" required></textarea>
                    <a href="<?php echo SITEURL; ?>index.php" class="btn-primary btn-gapfix">Cancel</a>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
                //process the value from the form into DB
                //check if the submit button is clicked or not 
                if(isset($_POST['submit'])) {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email= $_POST['email'];
                    $customer_address = $_POST['address'];

                    //sql query to save data into data base
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email= '$customer_email',
                        customer_address = '$customer_address'
                    ";
                    echo $sql2;
                    // execute query and save data in DB
                    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
                    if ($res2==true) {
                        echo "Order Placed!!";
                        $_SESSION['ordered']= "<div class='success'>Order Placed!</div>";
                        header("location:".SITEURL.'index.php');
                    } else {
                        // echo "Failed to update the Admin password";
                        $_SESSION['ordered']= "<div class='error'>Failed to place the order!</div>";
                        header("location:".SITEURL.'index.php');
                    }
                } 
            ?>
        </div>
    </section>
    <!-- fOOD ordering Section Ends Here -->


    <?php include('partials-front/footer.php')?>