<html>

<head>
    <link rel="stylesheet" href="sayitright.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<body id="wrapper">

<?php
require_once('validations.php');
require_once('dboperations.php');

$subscribe_email = "";
$subscribe_emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $value = is_valid_email($_POST["subscribe_email"]);
    $subscribe_emailErr = $value["validation_failure_message"];
    $subscribe_email = $value["sanitized_value"];

    if ($value["is_valid"]) {
        $success = mail($subscribe_email, "Say It Right", "Thank you for subscribing to Say It right");
        if ($success) {
            $subscribe_emailErr = "Yay!!! Subscribed!";
        } else {
            $subscribe_emailErr = "Please retry.";
        }
    }
}


?>

<div class="bkgnd">
    <nav>
        <div class="nav_left">
            <a href="HomePage.php">
                <img src="imgsay/logo.png">
            </a>
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="HomePage.php" class="activetab">Home</a></li>
                <li><a href="AboutUs.php">About US</a></li>
                <li><a href="index.php">Blog</a></li>
                <li><a href="buyfromus.php">Buy From US</a></li>
                <li><a href="contactus.php">Contact US</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
    <div class="content">
        <div class="homepagegrid">
            <div class="homepageleft">
                <img src="imgsay/iphone.png">
            </div>
            <div class="homepageright">
                <h1> For good </h1>
                <h1> communication </h1>
                <h1>
                    <p class="red"> Say it Right </p> is
                </h1>
                <h1> a tool that </h1>
                <h1> you should use </h1>
                <h6> You can see our video tutorial of use with just pressing this button </h6>
                <div class="homepageright_playbutton">
                    <a href="#" class="round-button">
                        <i class="fa fa-play fa-2x">
                        </i>
                    </a>
                </div>
                <div class="homepageright_playtext">
                    <h5> WATCH THE VIDEO </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footerleft">
            <h2 id="footerh2"> Subscribe Our Newsletter </h2>
            <h6 id="footerh6"> We won't send any kind of spam </h6>
        </div>
        <div class="footerright">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]) ?>" onsubmit="return submit_subscribe_form()">
                <input type="email" name="subscribe_email" id="footertextarea"
                       placeholder="Enter email address" required></input>
                <span id="subscribe_emailErr" class="error"> * <?php echo $subscribe_emailErr; ?> </span>
                <input type="submit" id="footersubscribe" text="Subscribe">
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
</div>
</body>

</html>
