<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<?php
require_once('validations.php');
require_once('dboperations.php');

$db_insert_status = "";
$redirect_link = "";
$individual_signing_up = false;
$event_signing_up = false;
$business_signing_up = false;
$individual_signup = array(
    "ind_fname" => "",
    "ind_lname" => "",
    "ind_work" => "",
    "ind_school" => "",
    "ind_email" => "",
    "ind_password" => "",
    "ind_fnameErr" => "",
    "ind_lnameErr" => "",
    "ind_workErr" => "",
    "ind_schoolErr" => "",
    "ind_emailErr" => "",
    "ind_passwordErr" => "");

$event_signup = array("event_fname" => "",
    "event_lname" => "",
    "event_email" => "",
    "event_password" => "",
    "event_fnameErr" => "",
    "event_lnameErr" => "",
    "event_emailErr" => "",
    "event_passwordErr" => "");

$business_signup = array("busi_lname" => "",
    "busi_email" => "",
    "busi_password" => "",
    "busi_university" => 0,
    "busi_company" => 0,
    "busi_lnameErr" => "",
    "busi_emailErr" => "",
    "busi_passwordErr" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["ind_form"] == "individual") {
        $individual_signing_up = true;
        $all_fields_valid = true;

        $value = is_valid_first_name($_POST["ind_fname"]);
        $individual_signup["ind_fnameErr"] = $value["validation_failure_message"];
        $individual_signup["ind_fname"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_last_name($_POST["ind_lname"]);
        $individual_signup["ind_lnameErr"] = $value["validation_failure_message"];
        $individual_signup["ind_lname"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_work_location($_POST["ind_work"]);
        $individual_signup["ind_workErr"] = $value["validation_failure_message"];
        $individual_signup["ind_work"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_school_name($_POST["ind_school"]);
        $individual_signup["ind_schoolErr"] = $value["validation_failure_message"]; // "Enter your School name";
        $individual_signup["ind_school"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_email($_POST["ind_email"]);
        $individual_signup["ind_emailErr"] = $value["validation_failure_message"];
        $individual_signup['ind_email'] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_password($_POST["ind_password"]);
        $individual_signup["ind_passwordErr"] = $value["validation_failure_message"];
        $individual_signup["ind_password"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

    } else if ($_POST["event_form"] == "event") {
        $event_signing_up = true;
        $all_fields_valid = true;

        $value = is_valid_first_name($_POST["event_fname"]);
        $event_signup["event_fnameErr"] = $value["validation_failure_message"];
        $event_signup["event_fname"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_first_name($_POST["event_lname"]);
        $event_signup["event_lnameErr"] = $value["validation_failure_message"];
        $event_signup["event_lname"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_email($_POST["event_email"]);
        $event_signup["event_emailErr"] = $value["validation_failure_message"];
        $event_signup['event_email'] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_password($_POST["event_password"]);
        $event_signup["event_passwordErr"] = $value["validation_failure_message"];
        $event_signup["event_password"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

    } else if ($_POST["busi_form"] == "business") {
        $business_signing_up = true;
        $all_fields_valid = true;

        $value = is_valid_first_name($_POST["busi_lname"]);
        $business_signup["busi_lnameErr"] = $value["validation_failure_message"];
        $business_signup["busi_lname"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_email($_POST["busi_email"]);
        $business_signup["busi_emailErr"] = $value["validation_failure_message"];
        $business_signup['busi_email'] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        $value = is_valid_password($_POST["busi_password"]);
        $business_signup["busi_passwordErr"] = $value["validation_failure_message"];
        $business_signup["busi_password"] = $value["sanitized_value"];
        $all_fields_valid &= $value["is_valid"];

        if (isset($_POST['businesstype'])) {
            if ($_POST['businesstype'] == "University") {
                $business_signup["busi_university"] = 1;
                $business_signup["busi_company"] = 0;
            } else {
                $business_signup["busi_university"] = 0;
                $business_signup["busi_company"] = 1;
            }
        } else {
            $all_fields_valid &= false;
        }
    } else {
        echo "STOP! ERROR!!!";
    }
    try {
        $pdo = get_pdo();
        $sql = "";

        if ($individual_signing_up && $all_fields_valid) {
            $stmt = "INSERT INTO individual_users (`first_name`, `last_name`, `place_of_work`, `password`, `school`, `email`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";
            $sql = sprintf(
                $stmt,
                $individual_signup["ind_fname"],
                $individual_signup["ind_lname"],
                $individual_signup["ind_work"],
                $individual_signup["ind_password"],
                $individual_signup["ind_school"],
                $individual_signup["ind_email"]);
        } else if ($event_signing_up && $all_fields_valid) {
            $stmt = "INSERT INTO event_users (`first_name`, `last_name`, `password`, `email`) VALUES ('%s', '%s', '%s','%s');";
            $sql = sprintf(
                $stmt,
                $event_signup["event_fname"],
                $event_signup["event_lname"],
                $event_signup["event_password"],
                $event_signup["event_email"]);
        } else if ($business_signing_up && $all_fields_valid) {
            $stmt = "INSERT INTO business_users (`name`, `email`, `password`, `is_university`, `is_company`) VALUES ('%s', '%s', '%s', '%s', '%s');";
            $sql = sprintf(
                $stmt,
                $business_signup["busi_lname"],
                $business_signup["busi_email"],
                $business_signup["busi_password"],
                $business_signup["busi_university"],
                $business_signup["busi_company"]);
        }

        $result = $pdo->query($sql);
        if ($result) {
            $db_insert_status = "Account created successfully!";
            $redirect_link = "<a href=\"login.php\">Click here to login</a>";
        } else {
            $db_insert_status = "Failed to create account - please try again!";
        }
        $pdo = null;

    } catch (PDOException $e) {
        die($e->getMessage());

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
            <li><a href="contactus.php">Contact US</a></li>
            <li><a href="signup.php" class="activetab">Sign Up</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="breadcrumb">
        <img src="imgsay\home-banner.jpg" alt="Home Page">
        <h6 id="breadcrumbh6">Home --> SIGN UP</h6>
        <h2 id="breadcrumbh4">SIGN UP</h2>
    </div>
    <div class="signup margin10">

        <div class="signupform" id="signupform">
            <div>
                <h2> Select the type of user</h2>
            </div>
            <div class="signupgrid" id="signupgrid">
                <div>
                    <p class="individualsend" onclick="individualsignup()">INDIVIDUAL</p>
                </div>
                <div>
                    <p class="eventsend" onclick="eventsignup()">EVENT</p>
                </div>
                <div>
                    <p class="businesssend" onclick="businesssignup()">BUSINESS</p>
                </div>
            </div>
            <div>
                <p> <?php echo $db_insert_status; ?> </p>
                <p> <?php echo $redirect_link; ?> </p>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
                <div class="individualsignupform" id="individualsignupform" style="display: none">
                    <h3> Welcome to the individual registration</h3><br>
                    <div>
                        <input type="text" name="ind_fname" placeholder="Enter your name" required>
                        <span class="" error"> * <?php echo $individual_signup["ind_fnameErr"] ?></span>
                    </div>
                    <div>
                        <input type="text" name="ind_lname" placeholder="Enter last name" required>
                        <span class="error"> *<?php echo $individual_signup["ind_lnameErr"] ?></span>
                    </div>
                    <div>
                        <input type="text" name="ind_work" placeholder="Enter place of work" required>
                        <span class="error"> *<?php echo $individual_signup["ind_workErr"] ?></span>
                    </div>
                    <div>
                        <input type="text" name="ind_school" placeholder="Enter school" required>
                        <span class="error"> *<?php echo $individual_signup["ind_schoolErr"] ?></span>
                    </div>
                    <div>
                        <input type="email" name="ind_email" placeholder="Enter email" required>
                        <span class="error"> *<?php echo $individual_signup["ind_emailErr"] ?></span>
                    </div>
                    <div>
                        <input type="password" name="ind_password" placeholder="Enter password" required>
                        <span class="error"> *<?php echo $individual_signup["ind_passwordErr"] ?></span>
                    </div>
                    <input type="text" id="ind_form" name="ind_form" placeholder="" style="display:none">
                    <input type="submit" value="SEND" class="signupsend">
                </div>
            </form>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
                <div class="eventsignupform" id="eventsignupform" style="display: none">
                    <h3> Welcome to the event log</h3><br>
                    <div>
                        <input type="text" name="event_fname" placeholder="Enter your name" required>
                        <span class="" error"> * <?php echo $event_signup["event_fnameErr"]; ?></span>
                    </div>
                    <div>
                        <input type="text" name="event_lname" placeholder="Enter last name" required>
                        <span class="" error"> * <?php echo $event_signup["event_lnameErr"]; ?></span>
                    </div>
                    <div>
                        <input type="email" name="event_email" placeholder="Enter email" required>
                        <span class="" error"> * <?php echo $event_signup["event_emailErr"]; ?> </span>
                    </div>
                    <div>
                        <input type="password" name="event_password" placeholder="Enter password" required>
                        <span class="" error"> * <?php echo $event_signup["event_passwordErr"]; ?> </span>
                    </div>
                    <input type="text" id="event_form" name="event_form" placeholder="" style="display:none">
                    <input type="submit" value="SEND" class="signupsend">
                </div>
            </form>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
                <div class="businesssignupform" id="businesssignupform" style="display: none">
                    <h3> Welcome to business records</h3><br>
                    <div class="radiobuttons">
                        <h5> type of Business: </h5>
                        <input type="radio" name="businesstype" value="University"> University
                        <input type="radio" name="businesstype" value="Company"> Company
                    </div>
                    <div>
                        <input type="text" name="busi_lname" placeholder="Enter last name" required>
                        <span class="error"> *<?php echo $business_signup["busi_lnameErr"] ?></span>
                    </div>
                    <div>
                        <input type="email" name="busi_email" placeholder="Enter email" required>
                        <span class="error"> * <?php echo $business_signup["busi_emailErr"] ?></span>

                    </div>
                    <div>
                        <input type="password" name="busi_password" placeholder="Enter password" required>
                        <span class="error"> * <?php echo $business_signup["busi_passwordErr"] ?></span>
                    </div>
                    <input type="text" id="busi_form" name="busi_form" placeholder="" style="display:none">
                    <input type="submit" value="SEND" class="signupsend">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function set_form_element_to_value(element_id, value) {
        document.getElementById(element_id).value = value;
    }

    function individualsignup() {
        document.getElementById("individualsignupform").style.display = "block";
        document.getElementById("eventsignupform").style.display = "none";
        document.getElementById("businesssignupform").style.display = "none";
        set_form_element_to_value("ind_form", "individual");
        set_form_element_to_value("event_form", "");
        set_form_element_to_value("busi_form", "");

    }

    function eventsignup() {
        document.getElementById("individualsignupform").style.display = "none";
        document.getElementById("eventsignupform").style.display = "block";
        document.getElementById("businesssignupform").style.display = "none";
        set_form_element_to_value("ind_form", "");
        set_form_element_to_value("event_form", "event");
        set_form_element_to_value("busi_form", "");
    }

    function businesssignup() {
        document.getElementById("individualsignupform").style.display = "none";
        document.getElementById("eventsignupform").style.display = "none";
        document.getElementById("businesssignupform").style.display = "block";
        set_form_element_to_value("ind_form", "");
        set_form_element_to_value("event_form", "");
        set_form_element_to_value("busi_form", "business");
    }
</script>
<!-- <div id="mymodal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p> Welcome to the individual registration</p>
    </div>
    <button1 onclick="myFunction()"></button>
        <div id="form">
            <p> Welcome to the individual registration</p>
            <input type="text" name="email" value="Enter Email">
        </div>
        <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("form");
        }
        </script>
</div> -->
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
