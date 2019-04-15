<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<?php


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "";
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
    $quantity = $quantity <= 0 ? 1 : $quantity;

    $cart_item = array('quantity' => $quantity);

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if($product_id != "") {
        $_SESSION['cart'][$product_id] = $cart_item;
    }
}

?>
<body id="wrapper">
<nav>
    <div class="nav_left">
        <a href="HomePage.php">
            <img src="imgsay/logo.png">
        </a>
    </div>
    <div class="nav_right">
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="AboutUs.php">About US</a></li>
            <li><a href="index.php">Blog</a></li>
            <li><a href="buyfromus.php" class="activetab">Buy From US</a></li>
            <li><a href="contactus.php">Contact US</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="breadcrumb">
        <img src="imgsay\home-banner.jpg" alt="Home Page">
        <h6 id="breadcrumbh6">Home --> Buy from us </h6>
        <h2 id="breadcrumbh4">BUY FROM US</h2>
    </div>
    <div class="buyfromuscontent" id="wrapper">
        <div>
            <p class="buyfromuscontenttitle"> Buy From Us </p>
        </div>
        <div class="buyfromustable">
            <?php
            require_once('dboperations.php');

            try {
                $pdo = get_pdo();

                $sql = "select * from products;";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()) {
                    $table_row = "%s %s %s %d";

                    $table_row = "<div class=\"buyfromustabledata\">
                        <img src=\"%s\" alt=\"mug\">
                        <p> %s </p>
                        <p> %s </p>
                        <button class=\"buytablebutton\" id=\"%d\" onclick=\"show_pop_up(this.id)\"> ADD TO CART</button>
                    </div>";

                    echo sprintf($table_row, $row["product_picture"], $row["price_per_unit"], $row["product_description"], $row["product_id"]);
                }

                $pdo = null;
            } catch (PDOException $e) {
                die($e->getMessage());
            }

            ?>
        </div>
    </div>
</div>
<div id="mymodal" class="modal">
    <div class="modal-content">
        <div class="modal_title">
            <h4> Add to Cart </h4>
            <span class="close">&times;</span>
        </div>
        <p></p>
        <div>
            <div class="modal-content-left">
                <img id="mymodelimg" src="imgsay/franela1.jpg">
            </div>
            <div class="modal-content-right">
                <h4> Product Quantity </h4>
                <input type="number" min="0" name="quantity" placeholder="1" id="product_quantity">
                <h5> Note: Choose a quantity greater than 0 </h5>
                <button class="add_to_cart_close" id="button" onclick="close_modal()">Close</button>
                <button class="add_to_cart_add" id="button" onclick="add_product_quantity_to_cart()">Add to Cart
                </button>
                <p id="product_id" style="display: none"></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function add_product_quantity_to_cart() {
        product_id = document.getElementById('product_id').innerHTML;
        quantity = document.getElementById('product_quantity').value;
        window.location.href = "buyfromus.php?product_id=".concat(product_id).concat("&quantity=").concat(quantity);
    }

    function close_modal() {
        var modal = document.getElementById('mymodal');
        modal.style.display = "none";
    }

    function show_pop_up(button_id) {
        var modal = document.getElementById('mymodal');
        var span = document.getElementsByClassName("close")[0];
        var modalimg = document.getElementById('mymodelimg');

        modal.style.display = "block";
        document.getElementById('product_id').innerHTML = button_id;
        switch (button_id) {
            case "2":
                modalimg.src = "imgsay/franela1.jpg";
                modalimg.alt = "shirt";
                break;
            case "1":
                modalimg.src = "imgsay/taza1.png";
                modalimg.alt = "cup";
                break;
            case "4":
                modalimg.src = "imgsay/franela2.jpg";
                modalimg.alt = "shirt";
                break;
            case "3":
                modalimg.src = "imgsay/taza2.png";
                modalimg.alt = "cup";
                break;
            case "6":
                modalimg.src = "imgsay/franela3.jpg";
                modalimg.alt = "shirt";
                break;
            case "5":
                modalimg.src = "imgsay/taza3.png";
                modalimg.alt = "cup";
                break;
            default:
        }

        span.onclick = function (event) {
            modal.style.display = "none";
        }


        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>
<div class="footer">
    <div class="footerleft">
        <h2 id="footerh2"> View shopping cart </h2>
        <h6 id="footerh6"> You can the products that you added to your cart </h6>
    </div>
    <div class="footerright">
        <button id="cartbuy" onclick="location.href = 'buyfromus2.php';">SUBMIT</button>
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
