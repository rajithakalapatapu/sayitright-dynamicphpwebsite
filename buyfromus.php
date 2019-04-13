<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<body id="wrapper">
<nav>
    <div class="nav_left">
        <a href="HomePage.html">
            <img src="imgsay/logo.png">
        </a>
    </div>
    <div class="nav_right">
        <ul>
            <li><a href="HomePage.html">Home</a></li>
            <li><a href="AboutUs.html">About US</a></li>
            <li><a href="index.php">Blog</a></li>
            <li><a href="buyfromus.html" class="activetab">Buy From US</a></li>
            <li><a href="contactus.html">Contact US</a></li>
            <li><a href="signup.html">Sign Up</a></li>
            <li><a href="login.html">Login</a></li>
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
            <div class="buyfromustabledata">
                <img src="imgsay/franela1.jpg" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="one" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
            <div class="buyfromustabledata">
                <img src="imgsay/taza1.png" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="two" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
            <div class="buyfromustabledata">
                <img src="imgsay/franela2.jpg" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="three" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
            <div class="buyfromustabledata">
                <img src="imgsay/taza2.png" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="four" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
            <div class="buyfromustabledata">
                <img src="imgsay/franela3.jpg" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="five" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
            <div class="buyfromustabledata">
                <img src="imgsay/taza3.png" alt="mug">
                <p> $24.99 </p>
                <p> Some quick example text to build on the card title and make up the bulk of the card's content. </p>
                <button class="buytablebutton" id="six" onclick="show_pop_up(this.id)"> ADD TO CART</button>
            </div>
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
                <input type="text" name="quantity" value="">
                <h5> Note: Some quick example text to <br> build on the card title and <br> make up the bulk of the card's content </h5>
                <button class="add_to_cart_close" id="button" onclick="close_modal()">Close</button>
                <button class="add_to_cart_add" id="button">Add to Cart</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function close_modal() {
        var modal = document.getElementById('mymodal');
        modal.style.display = "none";
    }

    function show_pop_up(button_id) {
        var modal = document.getElementById('mymodal');
        var span = document.getElementsByClassName("close")[0];
        var modalimg = document.getElementById('mymodelimg');

        modal.style.display = "block";
        switch (button_id) {
            case "one":
                modalimg.src = "imgsay/franela1.jpg";
                modalimg.alt = "shirt";
                break;
            case "two":
                modalimg.src = "imgsay/taza1.png";
                modalimg.alt = "cup";
                break;
            case "three":
                modalimg.src = "imgsay/franela2.jpg";
                modalimg.alt = "shirt";
                break;
            case "four":
                modalimg.src = "imgsay/taza2.png";
                modalimg.alt = "cup";
                break;
            case "five":
                modalimg.src = "imgsay/franela3.jpg";
                modalimg.alt = "shirt";
                break;
            case "six":
                modalimg.src = "imgsay/taza3.png";
                modalimg.alt = "cup";
                break;
            default:
        }

        span.onclick = function(event) {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    // var modal = document.getElementById('mymodal');
    // var buttonone = document.getElementById('one');
    // var span = document.getElementsByClassName("close")[0];
    // buttonone.onclick = function() {
    //     console.log("Hello world!");
    //     modal.style.display = "block";
    // }
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // }
</script>
<div class="footer">
    <div class="footerleft">
        <h2 id="footerh2"> View shopping cart </h2>
        <h6 id="footerh6"> You can the products that you added to your cart </h6>
    </div>
    <div class="footerright">
        <button id="cartbuy" onclick="location.href = 'buyfromus2.html';">SUBMIT</button>
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
