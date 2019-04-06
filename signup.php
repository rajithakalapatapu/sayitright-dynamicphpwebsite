<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<?php
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

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["ind_form"] == "individual") {
        $individual_signing_up = true;
        if (empty($_POST["ind_fname"])) {
            $individual_signup["ind_fnameErr"] = "First name required";
        } else {
            $individual_signup["ind_fname"] = test_input($_POST["ind_fname"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $individual_signup["ind_fname"])) {
                $individual_signup["ind_fnameErr"] = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["ind_lname"])) {
            $individual_signup["ind_lnameErr"] = "Last name required";

        } else {
            $individual_signup["ind_lname"] = test_input($_POST["ind_lname"]);
            if (!preg_match("/^[a-zA-Z]*$/", $individual_signup["ind_lname"])) {
                $individual_signup["ind_lnameErr"] = "Only letters and white space allowed";
            }

        }
        if (empty($_POST["ind_work"])) {
            $individual_signup["ind_workErr"] = "Your Work Place is needed";
        } else {
            $individual_signup["ind_work"] = test_input($_POST["ind_work"]);


        }
        if (empty($_POST["ind_school"])) {
            $individual_signup["ind_schoolErr"] = "Enter your School name";
        } else {
            $individual_signup["ind_school"] = test_input($_POST["ind_school"]);
            if (!preg_match("/^[a-zA-Z]*$/", $individual_signup["ind_school"])) {
                $individual_signup["ind_schoolErr"] = "Please enter a valid school name";
            }
        }
        if (empty($_POST["ind_email"])) {
            $individual_signup["ind_emailErr"] = "Enter email id";
        } else {
            $individual_signup['ind_email'] = test_input($_POST['ind_email']);
            if (!filter_var($individual_signup["ind_email"], FILTER_VALIDATE_EMAIL)) {
                $individual_signup["ind_emailErr"] = "Invalid email entered";
            }
        }

        if (empty($_POST["ind_password"])) {
            $individual_signup["ind_passwordErr"] = "Please enter password";
        } else {
            $individual_signup['ind_password'] = test_input($_POST['ind_password']);
        }
    } else if ($_POST["event_form"] == "event") {
        $event_signing_up = true;
        if (empty($_POST["event_fname"])) {
            $event_signup["event_fnameErr"] = "Enter your name";
        } else {
            $event_signup["event_fname"] = test_input($_POST["event_fname"]);
            if (!preg_match("/^[a-zA-Z]*$/", $event_signup["event_fname"])) {
                $event_signup["event_fnameErr"] = "Invalid Name";
            }
        }
        if (empty($_POST["event_lname"])) {
            $event_signup["event_lnameErr"] = "Enter lastname";
        } else {
            $event_signup["event_lname"] = test_input($_POST["event_lname"]);
            if (!preg_match("/^[a-zA-Z]*$/", $event_signup["event_lname"])) {
                $event_signup["event_lnameErr"] = "Lastname is required";
            }
        }
        if (empty($_POST["event_email"])) {
            $event_signup["event_emailErr"] = "Enter valid email id";
        } else {
            $event_signup["event_email"] = test_input($_POST["event_email"]);
            if (!filter_var($event_signup["event_email"], FILTER_VALIDATE_EMAIL)) {
                $event_signup["event_emailErr"] = "Invalid email id";
            }
        }
        if (empty($_POST["event_password"])) {
            $event_signup["event_passwordErr"] = "Enter password";
        } else {
            $event_signup["event_password"] = test_input($_POST["event_password"]);
        }
    } else if ($_POST["busi_form"] == "business") {
        $business_signing_up = true;
        if (empty($_POST["busi_lname"])) {
            $business_signup["busi_lnameErr"] = "Enter your last name";
        } else {
            $business_signup["busi_lname"] = test_input($_POST["busi_lname"]);
            if (!preg_match("/^[a-zA-Z]*$/", $business_signup["busi_lname"])) {
                $business_signup["busi_lnameErr"] = "Last name required";
            }
        }
        if (empty($_POST["busi_email"])) {
            $business_signup["busi_emailErr"] = "Enter email id";

        } else {
            $business_signup["busi_email"] = test_input($_POST["busi_email"]);
            if (!filter_var($business_signup["busi_email"], FILTER_VALIDATE_EMAIL)) {
                $business_signup["busi_emailErr"] = "Invalid email id";
            }
        }
        if (empty($_POST["busi_password"])) {
            $business_signup["busi_passwordErr"] = "Enter password";
        } else {
            $business_signup["busi_password"] = test_input($_POST["busi_password"]);
        }

        if (isset($_POST['businesstype'])) {
            if ($_POST['businesstype'] == "University") {
                $business_signup["busi_university"] = 1;
                $business_signup["busi_company"] = 0;
            } else {
                $business_signup["busi_university"] = 0;
                $business_signup["busi_company"] = 1;
            }
        }
    } else {
        echo "STOP! ERROR!!!";
    }
    try {
        $connString = "mysql:host=localhost;dbname=rajithak_project1";
        $user = "rk";
        $pass = "Rklappy@2018";
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "";

        if ($individual_signing_up) {
            $sql = "INSERT INTO individual_users (`first_name`, `last_name`, `place_of_work`, `password`, `school`, `email`) VALUES ('" . $individual_signup["ind_fname"] . "','" .
                $individual_signup["ind_lname"] . "','" .
                $individual_signup["ind_work"] . "','" .
                $individual_signup["ind_password"] . "','" .
                $individual_signup["ind_school"] . "','" .
                $individual_signup["ind_email"] .
                "');";

        } else if ($event_signing_up) {
            $sql = "INSERT INTO event_users (`first_name`, `last_name`, `password`, `email`) VALUES ('" . $event_signup["event_fname"] . "','" .
                $event_signup["event_lname"] . "','" .
                $event_signup["event_password"] . "','" .
                $event_signup["event_email"] .
                "');";
        } else if ($business_signing_up) {
            $sql = "INSERT INTO business_users (`name`, `email_id`, `password`, `is_university`, `is_company`) VALUES ('" .
                $business_signup["busi_lname"] . "','" .
                $business_signup["busi_email"] . "','" .
                $business_signup["busi_password"] . "','" .
                $business_signup["busi_university"] . "','" .
                $business_signup["busi_company"] .
                "');";
        }

        $result = $pdo->query($sql);
        if ($result) {
            $db_insert_status = "Account created successfully!";
            if ($individual_signing_up) {
                $redirect_link = "<a href=\"individuallogin.html\">Click here to go to your home page</a>";
            } else if ($event_signing_up) {
                $redirect_link = "<a href=\"eventlogin.html\">Click here to go to your home page</a>";
            } else if ($business_signing_up) {
                $redirect_link = "<a href=\"businesslogin.html\">Click here to go to your home page</a>";

            }
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
                        <input type="text" name="ind_password" placeholder="Enter password" required>
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
                        <input type="text" name="event_password" placeholder="Enter password" required>
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
                        <input type="text" name="busi_password" placeholder="Enter password" required>
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
