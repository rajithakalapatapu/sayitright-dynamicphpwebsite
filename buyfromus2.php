<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="validations.js"></script>
</head>
<?php
require_once('validations.php');
require_once('dboperations.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $all_fields_valid = true;

    $value = is_valid_first_name($_POST["fname"]);
    $fnameErr = $value["validation_failure_message"];
    $fname = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["lname"]);
    $lnameErr = $value["validation_failure_message"];
    $lname = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_email($_POST["email"]);
    $emailErr = $value["validation_failure_message"];
    $email = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["address"]);
    $addressErr = $value["validation_failure_message"];
    $address = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["apartment"]);
    $apartmentErr = $value["validation_failure_message"];
    $apartment = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["city"]);
    $cityErr = $value["validation_failure_message"];
    $city = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_postal($_POST["postal"]);
    $postalErr = $value["validation_failure_message"];
    $postal = $value["sanitized_value"];
    $all_fields_valid &= $value["is_valid"];

    $language = $_POST['language'];

    if ($all_fields_valid) {
        try {
            $db_insert_success = true;
            $orders_stmt = "insert into orders (`order_total`, `order_email`, `order_first_name`, `order_last_name`, `order_address`, `order_apt_number`, `order_city`, `order_language`, `order_pincode`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
            $orders_sql = sprintf($orders_stmt, $_SESSION['total'], $email, $fname, $lname, $address, $apartment, $city, $language, $postal);

            $db_insert_success &= execute_insert_query($orders_sql);

            $order_id = get_order_id($email, $_SESSION['total'], $postal);
            $db_insert_success &= ($order_id>=0);

            $cart_items = $_SESSION['cart'];
            foreach ($cart_items as $product_id => $quantity) {
                $db_insert_success &= add_entry_to_order_product($order_id, $product_id, $quantity['quantity']);
            }

            if ($db_insert_success) {
                $order_status = "Order placed successfully!";
                // at the end destroy session
                session_destroy();
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>"
              onsubmit="return submit_shipping_form();">
            <div class="shipping_left">
                <h2 class="shippingh3"> Contact Information </h2>
                <input name="email" id="email" placeholder="Enter Email" type="text" required>
                <span id="emailErr" class="error"></span>
                <h2 class="shippingh3"> Shipping address </h2>
                <div class="shipping_one_line">
                    <input type="text" id="fname" name="fname" placeholder="Enter First name" required>
                    <span id="fnameErr" class="error"></span>
                    <input type="text" id="lname" name="lname" placeholder="Enter Last name" required>
                    <span id="lnameErr" class="error"></span>
                </div>
                <input type="text" name="address" id="address" placeholder="Enter Address" required>
                <span id="addressErr" class="error"></span>
                <input type="text" name="apartment" id="apartment" placeholder="Enter Apartment, suite, etc." required>
                <span id="apartmentErr" class="error"></span>
                <input type="text" name="city" id="city" placeholder="Enter City" required>
                <span id="cityErr" class="error"></span>
                <div class="shipping_one_line">
                    <select name="language">
                        <option value="English" selected>English</option>
                        <option value="Spanish">Spanish</option>
                    </select>
                    <input type="text" name="postal" id="postal" placeholder="Enter Postal Code" required>
                    <span id="postalErr" class="error"></span>
                </div>
                <button class="shippingsend" id="button">PLACE ORDER</button>
                <button class="shippingsend" id="button" onclick="clear_cart()">CLEAR CART</button>
            </div>
            <div class="shipping_right">
                <div class="shipping_right">
                    <div class="shipping_table">
                        <?php
                        require_once('dboperations.php');
                        function get_each_row($product_id, $quantity)
                        {
                            $product_details = get_product_details($product_id);

                            $details = $product_details->fetch();
                            $each_cart_item = "
                            <div class=\"shipping_table_data\">
                                <img src=\"%s\">
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
                            return sprintf($each_cart_item, $details['product_picture'], $details['product_name'], $quantity,
                                $details['price_per_unit'] * $quantity);
                        }

                        $cart_items = $_SESSION['cart'];
                        if (!empty($cart_items)) {

                            echo "
                                
                            <div class=\"shipping_table_data\">
                                <h5> ID </h5>
                            </div>
                            <div class=\"shipping_table_data\">
                                <h5> Name </h5>
                            </div>
                            <div class=\"shipping_table_data\">
                                <h5> Units </h5>
                            </div>
                            <div class=\"shipping_table_data\">
                                <h5> Price </h5>
                            </div>
                            ";


                            foreach ($cart_items as $product_id => $quantity) {
                                echo get_each_row($product_id, $quantity['quantity']);
                            }

                            $total_line = "
                            <div class=\"shipping_table_data\">
                                <p> Total </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> USD </p>
                            </div>
                            <div class=\"shipping_table_data\">
                                <p> %s </p>
                            </div>";

                            echo sprintf($total_line, $_SESSION['total']);
                        } else {
                            echo "Cart is empty";
                        }


                        ?>

                    </div>
                </div>
            </div>
            <p> <?php echo $order_status; ?> </p>

        </form>

    </div>
</div>
<div class="copyright">
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <p class="white"> Copyright &copy 2019 All rights reserved</p>
    <p class="white"> | This web is made with &#9825;</p>
    <p class="blue">by DiazApps </p>
</div>
</body>

</html>
