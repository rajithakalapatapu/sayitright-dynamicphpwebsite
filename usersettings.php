<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<?php
require_once('dboperations.php');
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

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
                <form class="settings_form" action="POST">
                <div class="shipping_one_line">
                    <div>
                        <input type="text" name="fname" placeholder=<?php echo $fname;?> required>
                    </div>
                    <div>
                        <input type="text" name="lname" placeholder=<?php echo $lname;?> required>
                    </div>
                </div>
                <div>
                    <input type="text" name="work" placeholder=<?php echo $work; ?> required>
                </div>
                <div>
                    <input type="text" name="school" placeholder=<?php echo $school; ?> required>
                </div>
                <div>
                    <input type="email" name="email" placeholder=<?php echo $email; ?> required>
                </div>
                <div>
                    <input type="password" name="password" placeholder=<?php echo $password;?> required>
                </div>
                <p> Change Password </p>
                <button class="settingsbutton" id="button">SAVE CHANGES</button>
            </form>
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
