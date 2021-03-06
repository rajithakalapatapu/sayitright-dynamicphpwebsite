<?php
// Always start this first
session_start();
?>
<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<?php
require_once('dboperations.php');
// You'd put this code at the top of any "protected" page you create


if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "individual" && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

$all_conferences_count = get_all_conferences_count();
$all_events_count = get_all_events_count();
$my_conferences_count = get_my_conferences_count($_SESSION['user_id']);
$my_events_count = get_my_events_count($_SESSION['user_id']);

?>
    <nav>
        <div class="nav_left">
            <a href="HomePage.php"><img src="imgsay/logo.png"> </a>
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="individuallogin.php" class="activetab">Home</a></li>
                <li><a href="conferences.php">Conferences</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="myconferences.php">My Conferences</a></li>
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="usersettings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="content" id="wrapper">
        <div class="cardgrid">
            <div class="onecard bluecard">
                <div class="summary_card_icon">
                    <img src="imgsay/globe-americas-solid-white.png" class="summary_icon">
                </div>
                <div class="summary_card_text">
                    <h2 class="individuallogintext"> <?php echo $my_conferences_count + $my_events_count; ?> </h2>
                    <h4 class="individuallogintext"> activities performed </h4>
                </div>
                <div class="summary_card_label">
                    <p class="label"> Total Made </p>
                </div>
            </div>
            <div class="onecard greencard">
                <div class="summary_card_icon">
                    <img src="imgsay/users-solid-white.png" class="summary_icon">
                </div>
                <div class="summary_card_text">
                    <h2 class="individuallogintext"> <?php echo $my_conferences_count; ?> </h2>
                    <h4 class="individuallogintext"> activities performed </h4>
                </div>
                <div class="summary_card_label">
                    <p class="label"> Conferences </p>
                </div>
            </div>
            <div class="onecard yellowcard">
                <div class="summary_card_icon">
                    <img src="imgsay/star-solid-white.png" class="summary_icon">
                </div>
                <div class="summary_card_text">
                    <h2 class="individuallogintext"> <?php echo $my_events_count; ?> </h2>
                    <h4 class="individuallogintext"> activities performed </h4>
                </div>
                <div class="summary_card_label">
                    <p class="label"> Events </p>
                </div>
            </div>
            <div class="onecard greycard">
                <div class="summary_card_icon">
                    <img src="imgsay/trophy-solid-white.png" class="summary_icon">
                </div>
                <div class="summary_card_text">
                    <h2 class="individuallogintext"> <?php echo $all_conferences_count+$all_events_count-$my_conferences_count-$my_events_count; ?> </h2>
                    <h4 class="individuallogintext"> activities to carry out </h4>
                </div>
                <div class="summary_card_label">
                    <p class="label"> Activities </p>
                </div>
            </div>
            <div class="emptycard">
            </div>
            <div class="emptycard">
            </div>
            <div class="emptycard">
            </div>
            <div class="emptycard">
            </div>
            <?php

            require_once('dboperations.php');
            session_start();
            $all_events = get_all_participanting_events($_SESSION['user_id']);
            while($row = $all_events->fetch()) {
                $each_event = "
                    <div class=\"onecard bluecard\">
                        <div class=\"white_text bold_text blue_header\"> %s</div>
                        <div class=\"white_text bold_text\"> %s </div>
                        <div class=\"white_text card_content\">
                            <p> %s </p>
                        </div>
                    </div>
                ";
                echo sprintf($each_event, $row['event_type'], $row['event_name'], $row['event_datetime'] . "\t" . $row['event_location']);
            }
            $all_conferences = get_all_participanting_conferences($_SESSION['user_id']);
            while($row = $all_conferences->fetch()) {
                $each_conference = "
                    <div class=\"onecard greencard\">
                        <div class=\"white_text bold_text grey_header\"> %s </div>
                        <div class=\"white_text bold_text\"> %s</div>
                        <div class=\"white_text card_content\">
                            <p> %s </p>
                        </div>
                    </div>
                ";
                echo sprintf($each_conference, $row['conference_type'], $row['conference_name'], $row['conference_datetime'] . "\t" . $row['conference_location']);
            }
            ?>
            <div class="onecard bluecard">
                <div class="white_text bold_text blue_header">Header</div>
                <div class="white_text bold_text">Primary Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard greycard">
                <div class="white_text bold_text black_header">Header</div>
                <div class="white_text bold_text">Secondary Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard greencard">
                <div class="white_text bold_text grey_header">Header</div>
                <div class="white_text bold_text">Success Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard redcard">
                <div class="white_text bold_text grey_header">Header</div>
                <div class="white_text bold_text">Danger Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard yellowcard">
                <div class="white_text bold_text grey_header">Header</div>
                <div class="white_text bold_text">Warning Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard cyancard">
                <div class="white_text bold_text grey_header">Header</div>
                <div class="white_text bold_text">Info Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard whitecard">
                <div class="black_text bold_text grey_header grey_background">Header</div>
                <div class="black_text bold_text">Light Card title</div>
                <div class="black_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
            </div>
            <div class="onecard blackcard">
                <div class="white_text bold_text grey_header">Header</div>
                <div class="white_text bold_text">Dark Card title</div>
                <div class="white_text card_content">
                    <p> Some quick example text to build
                        on the card title and make up
                        the bulk of the card's content </p>
                </div>
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
