<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<body id="wrapper">

<?php

$fnameErr = $lnameErr = $phoneErr = $MessageErr = "";
$fname = $lname = $phone = $Message = "";
$db_insert_status = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
        $fnameErr = "First Name is required";
    } else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lname"])) {
        $lnameErr = "last name is required";
    } else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $lnameErr = "Only letters and white space allowed";

        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Please enter numbers";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]*$/", $phone)) {
            $phoneErr = "Please enter valid numbers";
        }
    }

    if (empty($_POST["Message"])) {
        $MessageErr = "Please write some message";

    } else {
        $Message = test_input($_POST["Message"]);
    }


    try {

        $connString = "mysql:host=localhost;dbname=rajithak_project1";
        $user = "rk";
        $pass = "Rklappy@2018";

        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO contact_us VALUES ('" . $fname . "','" . $lname . "','" . $Message . "','" . $phone . "')";
        $result = $pdo->query($sql);
        if ($result) {
            $db_insert_status = "Message sent successfully!";
        } else {
            $db_insert_status = "Failed to send message - please try again!";
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
        <form name="contactus_form" method="POST" onsubmit="return myFunction()"
              action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
            <div class="contactusleft">
                <div>
                    <input type="text" name="fname" placeholder="Enter your name">
                    <span class="error"> *  <?php echo $fnameErr; ?></span>
                </div>
                <div>
                    <input type="text" name="lname" placeholder="Enter last name">
                    <span class="error"> * <?php echo $lnameErr; ?></span>
                </div>
                <div>
                    <input type="phone" name="phone" placeholder="Telephone">
                    <span class="error"> * <?php echo $phoneErr; ?></span>
                </div>
            </div>
            <div class="contactusright">
                <div>
                    <textarea rows="4" cols="50" name="Message" placeholder="Enter Message"></textarea>
                    <span class="error"> * <?php echo $MessageErr; ?></span>
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
<script>
    function validate_input(form_name, input_name) {
        var x = document.forms[form_name][input_name].value;
        if (x == "") {
            alert("Name must be filled out");
            return false;
        }
    }

    function validate_phone(form_name, input_name) {
        var x = document.forms[form_name][input_name].value;
        var regex = "\d{9}";
        if (x == "") {//} || x.match(regex) == null) {
            alert("Phone number must be filled out with numbers");
            return false;
        }
    }

    function myFunction() {
        var valid_fname = validate_input("contactus_form", "fname");
        var valid_lname = validate_input("contactus_form", "lname");
        var valid_phone = validate_phone("contactus_form", "phone");
        return valid_fname && valid_lname && valid_phone;

        /*
        var x = document.forms["contactus_form"]["fname"].value;
        if (x == "") {
            alert("Name must be filled out");
            return false;
        } */

    }
</script>

</body>

</html>

