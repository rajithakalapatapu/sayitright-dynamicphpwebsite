<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
    <script src="validations.js"></script>

</head>

<body id="wrapper">

<?php
require_once('validations.php');
require_once('dboperations.php');

$fnameErr = $lnameErr = $phoneErr = $MessageErr = "";
$fname = $lname = $phone = $Message = "";
$db_insert_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields_valid = true;

    $first_name_validation_result = is_valid_first_name($_POST["fname"]);
    $fields_valid &= $first_name_validation_result["is_valid"];

    $last_name_validation_result = is_valid_last_name($_POST["lname"]);
    $fields_valid &= $last_name_validation_result["is_valid"];

    $phone_validation_result = is_valid_telephone_number($_POST["phone"]);
    $fields_valid &= $phone_validation_result["is_valid"];

    $message_validation_result = is_valid_message($_POST["Message"]);
    $fields_valid &= $message_validation_result["is_valid"];

    if ($fields_valid) {
        $stmt = "INSERT INTO contact_us VALUES ('%s','%s','%s','%s')";
        $sql = sprintf(
            $stmt,
            $first_name_validation_result["sanitized_value"],
            $last_name_validation_result["sanitized_value"],
            $message_validation_result["sanitized_value"],
            $phone_validation_result["sanitized_value"]);
        $result = execute_insert_query($sql);

        if ($result) {
            $db_insert_status = "Message sent successfully!";
        } else {
            $db_insert_status = "Failed to send message - please try again!";
        }


    } else {
        $db_insert_status = "Failed to send message - please try again!";
    }


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
            <li><a href="contactus.php" class="activetab">Contact US</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="breadcrumb">
        <img src="imgsay\home-banner.jpg" alt="Home Page">
        <h6 id="breadcrumbh6">Home --> Contact </h6>
        <h2 id="breadcrumbh4">CONTACT US</h2>
    </div>
    <div class="contactus margin10">
        <form name="contactus_form" method="POST" onsubmit="return submit_contactus_form();"
              action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
            <div class="contactusleft">
                <div>
                    <input type="text" name="fname" placeholder="Enter your name" required>
                    <span id="fnameErr" class="error"> *  <?php echo $first_name_validation_result["validation_failure_message"]; ?></span>
                </div>
                <div>
                    <input type="text" name="lname" placeholder="Enter last name" required>
                    <span id="lnameErr" class="error"> * <?php echo $last_name_validation_result["validation_failure_message"]; ?></span>
                </div>
                <div>
                    <input type="phone" name="phone" placeholder="Telephone" required>
                    <span id="phoneErr" class="error"> * <?php echo $phone_validation_result["validation_failure_message"]; ?></span>
                </div>
            </div>
            <div class="contactusright">
                <div>
                    <textarea rows="4" cols="50" name="Message" placeholder="Enter Message" required></textarea>
                    <span id="MessageErr" class="error"> * <?php echo $message_validation_result["validation_failure_message"]; ?></span>
                </div>
                <!--                <input id="contactus_button" type=""text">-->
                <button class="contactussend" id="button">SEND MESSAGE</button>
            </div>
        </form>
        <div class="successful_form_submit"> <?php echo $db_insert_status; ?> </div>
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

