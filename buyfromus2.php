<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
session_start();

$_SESSION['total'] = 0;

?>
<body id="wrapper">
    <nav>
        <div class="nav_left">
            <img src="imgsay/logo.png">
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="HomePage.php">Home</a></li>
                <li><a href="AboutUs.php">About US</a></li>
                <li><a href="index.php">Blog</a></li>
                <li><a href="buyfromus.php">Buy From US</a></li>
                <li><a href="contactus.php">Contact US</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
    <div class="content" id="wrapper">
        <p class="buyfromuscontenttitle"> Buy From Us </p>
        <div class="shipping">
            <div class="shipping_left">
                <h2 class="shippingh3"> Contact Information </h2>
                <input name="email" placeholder="Enter Email" type="text">
                <h2 class="shippingh3"> Shipping address </h2>
                <div class="shipping_one_line">
                    <input type="text" name="fname" value="Enter First name">
                    <input type="text" name="lname" value="Enter Last name">
                </div>
                <input type="text" name="lname" value="Enter Address">
                <input type="text" name="lname" value="Enter Apartment, suite, etc.">
                <input type="text" name="lname" value="Enter City">
                <div class="shipping_one_line">
                    <select>
                        <option value="English">English</option>
                        <option value="Spanish">Spanish</option>
                    </select>
                    <input type="text" name="lname" value="Enter Postal Code">
                </div>
                <button class="shippingsend" id="button">PLACE ORDER</button>
            </div>
            <div class="shipping_right">
                <div class="shipping_right">
                    <div class="shipping_table">
                        <div class="shipping_table_data">
                            <h5> ID </h5>
                        </div>
                        <div class="shipping_table_data">
                            <h5> Name </h5>
                        </div>
                        <div class="shipping_table_data">
                            <h5> Units </h5>
                        </div>
                        <div class="shipping_table_data">
                            <h5> Price </h5>
                        </div>

                        <?php
                        require_once('dboperations.php');
                        function get_each_row($product_id, $quantity) {
                            $product_details = get_product_details($product_id);

                            $details = $product_details->fetch();
                            $each_cart_item = "
                            <div class=\"shipping_table_data\">
                                <p> %s </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> %s </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> %d </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> %f </p>
                            </div>
                            ";

                            $_SESSION['total'] += $details['price_per_unit'] * $quantity;
                            return sprintf($each_cart_item, $product_id, $details['product_name'], $quantity,
                                $details['price_per_unit'] * $quantity);
                        }

                        $cart_items = $_SESSION['cart'];
                        foreach($cart_items as $product_id => $quantity) {
                            echo get_each_row($product_id, $quantity['quantity']);
                        }

                        ?>
                        <div class="shipping_table_data">
                            <p> Total </p>
                        </div>
                        <div class="shipping_table_data">
                            <p> </p>
                        </div>
                        <div class="shipping_table_data">
                            <p> USD </p>
                        </div>
                        <div class="shipping_table_data">
                            <p> <?php echo $_SESSION['total']; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p> <br> </p>
        <p> <br> </p>
        <p> <br> </p>
        <p class="white"> Copyright &copy 2019 All rights reserved</p>
        <p class="white"> | This web is made with &#9825;</p>
        <p class="blue">by DiazApps </p>
    </div>
</body>

</html>
