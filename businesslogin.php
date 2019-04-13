<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<script>
    function delete_business(business_id) {
        window.location.href = "delete_business.php?business_id=".concat(business_id);
    }
</script>

<?php
require_once('dboperations.php');

// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "business" && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}
?>
    <nav>
        <div class="nav_left">
            <a href="HomePage.php"><img src="imgsay/logo.png"> </a>
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="businesslogin.php" class="activetab">Home</a></li>
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
        <div class="conferenceslist">
            <h4> List of businesses </h4>
            <table id="conferencedetails" border="transparent" align="center">
                <tr>
                    <th class="table_header">Business name</th>
                    <th class="table_header">Description</th>
                    <th class="table_header">City</th>
                    <th class="table_header">Business License Number</th>
                    <th class="table_header">Make changes</th>
                </tr>
                <?php
                try {
                    $pdo = get_pdo();
                    $stmt = "select * from my_businesses where business_created_by='%s'";
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
                            <button id=\"edit_business\">Edit</button>
                            <button id=\"delete_business\" onclick=\"delete_business('%d')\">Delete</button>
                            </td>
                        </tr>";
                        echo sprintf($format, $row['business_name'], $row['business_description'], $row['business_address'], $row['business_license_number'], $row['business_id']);

                    }
                    $pdo = null;

                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                ?>
            </table>
        </div>
        <button class="add_event" id="button">Add a new business</button>
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
