<?php
// Always start this first
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
    <script src="validations.js"></script>
</head>

<?php
require_once('dboperations.php');
require_once('validations.php');
// You'd put this code at the top of any "protected" page you create


if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

$user_details = array(
    "fname" => "",
    "lname" => "",
    "work" => "",
    "school" => "",
    "email" => "",
    "password" => ""
);

try {
    $pdo = get_pdo();

    $stmt = get_select_statement_for_logged_in_user();
    $sql = sprintf($stmt, $_SESSION["user_id"]);

    print_r($stmt, $sql);

    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $work = $row['place_of_work'];
        $school = $row['school'];
        $email = $row['email'];
        $password = $row['password'];
    }
    $pdo = null;

} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields_valid = true;

    $value = is_valid_first_name($_POST['fname']);
    $fname = $value['sanitized_value'];
    $fnameErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    $value = is_valid_last_name(($_POST['lname']));
    $lname = $value['sanitized_value'];
    $lnameErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    $value = is_valid_last_name(($_POST['work']));
    $work = $value['sanitized_value'];
    $workErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    $value = is_valid_last_name(($_POST['school']));
    $school = $value['sanitized_value'];
    $schoolErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    $value = is_valid_email(($_POST['email']));
    $email = $value['sanitized_value'];
    $emailErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    $value = is_valid_password(($_POST['password']));
    $password = $value['sanitized_value'];
    $passwordErr = $value['validation_failure_message'];
    $fields_valid &= $value['is_valid'];

    if($fields_valid) {
        $stmt = "update individual_users set first_name = '%s', last_name = '%s', place_of_work = '%s', password = '%s', school = '%s', email = '%s' where individual_id = '%s';";
        $sql = sprintf($stmt, $fname, $lname, $work, $password, $school, $email, $_SESSION["user_id"]);

        $result = execute_insert_query($sql);
        if ($result) {
            $db_insert_status = "Updated profile details successfully!";
        } else {
            $db_insert_status = "Failed to update profile details";
        }
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
                <?php
                require_once('headerutils.php');
                echo get_home_link_for_logged_in_user();
                ?>
                <li><a href="conferences.php">Conferences</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="myconferences.php">My Conferences</a></li>
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="usersettings.php" class="activetab">Settings</a></li>
                <?php
                session_start();

                if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
                    // Grab user data from the database using the user_id
                    // Let them access the "logged in only" pages
                    echo "<li><a href=\"logout.php\">Logout</a></li>";
                }

                ?>
            </ul>
        </div>
    </nav>
    <div class="content">
        <div class="settings margin10">
            <div class="settings_left">
                <div>
                    <img src="imgsay/user.jpg">
                    <button class="settings_image_button" id="button">CHANGE IMAGE</button>
                </div>
            </div>
            <div class="settings_right">
                <h3 class="settingsh4"> Welcome to your profile </h3>
                <form class="settings_form" method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" onsubmit="return submit_usersettings_form();">
                <div class="shipping_one_line">
                    <div>
                        <input type="text" id="fname" name="fname" placeholder=<?php echo $fname;?> required>
                        <span id="fnameErr" style="error"> <?php echo $fnameErr; ?> </span>
                    </div>
                    <div>
                        <input type="text" id="lname" name="lname" placeholder=<?php echo $lname;?> required>
                        <span id="lnameErr" style="error"> <?php echo $lnameErr; ?> </span>
                    </div>
                </div>
                <div>
                    <input type="text" id="work" name="work" placeholder=<?php echo $work; ?> required>
                    <span id="workErr" style="error"> <?php echo $workErr; ?> </span>
                </div>
                <div>
                    <input type="text" id="school" name="school" placeholder=<?php echo $school; ?> required>
                    <span id="schoolErr" style="error"> <?php echo $schoolErr; ?> </span>
                </div>
                <div>
                    <input type="email" id="email" name="email" placeholder=<?php echo $email; ?> required>
                    <span id="emailErr" style="error"> <?php echo $emailErr; ?> </span>
                </div>
                <div>
                    <input type="password" id="password" name="password" placeholder=<?php echo $password;?> required>
                    <span id="passwordErr" style="error"> <?php echo $passwordErr; ?> </span>
                </div>
                <p> Change Password </p>
                <button class="settingsbutton" id="button">SAVE CHANGES</button>
            </form>
            </div>
            <div>
                <p> <?php echo $db_insert_status; ?> </p>
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
