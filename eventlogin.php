<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<script>
    function delete_event(event_id) {
        window.location.href = "delete_event.php?event_id=".concat(event_id);
    }

    function show_event_add_form() {
        document.getElementById("add_event_form").style.display = "block";
    }
</script>
<?php
require_once('validations.php');
require_once('dboperations.php');

// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "event" && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $all_fields_valid = true;

    $add_event = array(
        "event_name" => "",
        "event_datetime" => "",
        "event_type" => "",
        "event_location" => ""
    );

    $value = is_valid_first_name($_POST["event_name"]);
    $event_name = $value["sanitized_value"];
    $event_nameErr = $value["validation_failure_message"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["event_type"]);
    $event_type = $value["sanitized_value"];
    $event_typeErr = $value["validation_failure_message"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_first_name($_POST["event_location"]);
    $event_location = $value["sanitized_value"];
    $event_locationErr = $value["validation_failure_message"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_date($_POST["event_date"]);
    $event_date = $value["sanitized_value"];
    $event_dateErr = $value["validation_failure_message"];
    $all_fields_valid &= $value["is_valid"];

    $value = is_valid_time($_POST["event_time"]);
    $event_time = $value["sanitized_value"];
    $event_timeErr = $value["validation_failure_message"];
    $all_fields_valid &= $value["is_valid"];

    $event_datetime = $event_date . " " . $event_time;
    if ($all_fields_valid) {
        $stmt = "insert into events (`event_name`, `event_datetime`, `event_type`, `event_location`, `event_created_by`) values ('%s', '%s', '%s', '%s', '%s');";
        $sql = sprintf($stmt, $event_name, $event_datetime, $event_type, $event_location, $_SESSION["user_id"]);

        echo $sql;
        $result = execute_insert_query($sql);
        if ($result) {
            $db_insert_status = "Event added successfully!";
        } else {
            $db_insert_status = "Failed to add event";
        }
    }

}

?>
<nav>
    <div class="nav_left">
        <a href="HomePage.php"><img src="imgsay/logo.png"> </a>
    </div>
    <div class="nav_right">
        <ul>
            <li><a href="eventlogin.php" class="activetab">Home</a></li>
            <li><a href="conferences.php">Conferences</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="myconferences.php">My Conferences</a></li>
            <li><a href="myevents.php">My Events</a></li>
            <li><a href="usersettings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
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
                <th class="table_header">Make changes</th>
            </tr>

            <?php
            // PDO
            // select * from events where event_created_by = $_SESSION['user_id'];
            try {
                $pdo = get_pdo();
                $stmt = "select * from events where event_created_by = '%s';";
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
                        <button id=\"edit_event\">Edit</button>
                        <button id=\"delete_event\" onclick=\"delete_event('%d')\">Delete</button>
                    </td>
                    </tr>
                    ";

                    echo sprintf($format, $row['event_type'], $row['event_name'], $row['event_datetime'], $row['event_location'], $row['event_id']);
                }

                $pdo = null;

            } catch (PDOException $e) {
                die($e->getMessage());
            }
            ?>
        </table>
        <button class="add_event" id="button" onclick="show_event_add_form()">Add a new event</button>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" id="add_event_form"
              style="display: block">
            <div class="add_event_form_div">
                <input type="text" name="event_name" placeholder="Enter event name" required>
                <span style="error"> <?php echo $event_nameErr; ?> </span>
            </div>
            <div class="add_event_form_div">
                <input type="date" name="event_date" placeholder="Select event date and time" required>
                <span style="error"> <?php echo $event_dateErr; ?> </span>
                <input type="time" name="event_time" placeholder="Select event date and time" required>
                <span style="error"> <?php echo $event_timeErr; ?> </span>
            </div>
            <div class="add_event_form_div">
                <input type="text" name="event_type" placeholder="Enter event type" required>
                <span style="error"> <?php echo $event_typeErr; ?> </span>
            </div>
            <div class="add_event_form_div">
                <input type="text" name="event_location" placeholder="Enter event location" required>
                <span style="error"> <?php echo $event_locationErr; ?> </span>
            </div>
            <div class="add_event_form_div">
                <input type="submit" value="Add event">
            </div>
            <div class="add_event_form_div">
                <p> <?php echo $db_insert_status; ?>    </p>
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
