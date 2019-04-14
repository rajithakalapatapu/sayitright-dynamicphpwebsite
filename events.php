<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
    function confirm_event(event_id, individual_id) {
        window.location.href = "confirm_event_participation.php?event_id=".concat(event_id).concat("&individual_id=").concat(individual_id);
    }
</script>
<?php
require_once('dboperations.php');
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
                <li><a href="events.php" class="activetab">Events</a></li>
                <li><a href="myconferences.php">My Conferences</a></li>
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="usersettings.php">Settings</a></li>
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
        <div class="conferenceslist" id="wrapper">
            <h1> List of Events</h1>
            <table id="conferencedetails" border="transparent" align="center">
                <tr>
                    <th class="table_header">Conferences</th>
                    <th class="table_header">Description</th>
                    <th class="table_header">Date</th>
                    <th class="table_header">City</th>
                    <th class="table_header">Confirmation</th>
                </tr>
                <?php
                try {
                    $pdo = get_pdo();
                    $stmt = "select * from events;";
                    $sql = sprintf($stmt, $_SESSION['user_id']);

                    $result = $pdo->query($sql);
                    while ($row = $result->fetch()) {
                        $format = "
                    <tr>
                    <td class=\"table_cell\">%s</td>
                    <td class=\"table_cell\">%s</td>
                    <td class=\"table_cell\">%s</td>
                    <td class=\"table_cell\">%s</td>
                    <td class=\"table_cell\">
                        <button id=\"delete_event\" onclick=\"confirm_event('%d', '%d')\">Confirm</button>
                    </td>
                    </tr>
                    ";
                        echo sprintf($format,
                            $row['event_type'], $row['event_name'], $row['event_datetime'], $row['event_location'],
                            $row['event_id'], $_SESSION['user_id']);
                    }

                    $pdo = null;

                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                ?>

            </table>
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
