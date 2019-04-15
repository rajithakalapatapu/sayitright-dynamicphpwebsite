<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="validations.js">
    </script>
</head>

<body id="wrapper">

<?php
require_once('validations.php');
require_once('dboperations.php');
require_once('headerutils.php');

$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $value = is_valid_email($_POST["email"]);
    $emailErr = $value["validation_failure_message"];
    $email = $value["sanitized_value"];

    $password_validation = is_valid_password($_POST["password"]);
    $passwordErr = $password_validation["validation_failure_message"];
    $password = $password_validation["sanitized_value"];

    if ($value["is_valid"] && $password_validation["is_valid"]) {
        try {
            $pdo = get_pdo();

            $indi_sql = "select individual_id from individual_users where email='" . $email . "' and password='" . $password . "'";
            $indi_result = $pdo->query($indi_sql);
            while ($row = $indi_result->fetch()) {
                $_SESSION['user_type'] = "individual";
                $_SESSION['user_id'] = $row['individual_id'];
                $_SESSION['user_logged_in'] = true;
                echo '<script>window.location.href = "individuallogin.php";</script>';
            }

            $event_sql = "select event_user_id from event_users where email='" . $email . "' and password='" . $password . "'";
            $event_result = $pdo->query($event_sql);
            while ($row = $event_result->fetch()) {
                $_SESSION['user_type'] = "event";
                $_SESSION['user_id'] = $row['event_user_id'];
                $_SESSION['user_logged_in'] = true;
                echo '<script>window.location.href = "eventlogin.php";</script>';
            }

            $busi_sql = "select business_user_id from business_users where email='" . $email . "' and password='" . $password . "'";
            $busi_result = $pdo->query($busi_sql);
            while ($row = $busi_result->fetch()) {
                $_SESSION['user_type'] = "business";
                $_SESSION['user_id'] = $row['business_user_id'];
                $_SESSION['user_logged_in'] = true;
                echo '<script>window.location.href = "businesslogin.php";</script>';
            }

            $pdo = null;

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

if ($_SESSION['user_logged_in']) {
    // if user goes to login page via browser back/fwd button take him/her to their respective home page
    echo go_to_home_page_for_logged_in_user();
}
?>

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
            <li><a href="buyfromus.php">Purchase</a></li>
            <li><a href="contactus.php">Contact US</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="login.php" class="activetab">Login</a></li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="breadcrumb">
        <img src="imgsay\home-banner.jpg" alt="Home Page">
        <h6 id="breadcrumbh6">Home --> LOGIN </h6>
        <h2 id="breadcrumbh4">LOGIN</h2>
    </div>
    <div class="login margin10">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" onsubmit="return submit_login_form();">
            <div class="loginform">
                <div align="left">
                    <input type="text" id="email" name="email" placeholder="Enter email" required>
                    <span id="emailErr" class="error">*<?php echo $emailErr; ?></span>
                </div>
                <div align="left">
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                    <span id="passwordErr" class="error">*<?php echo $passwordErr; ?></span>
                </div>
                <div align="right">
                    <button class="loginsend" id="button">SEND</button>
                </div>
            </div>
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
