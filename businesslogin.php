<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
<?php
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
                    <th class="table_header">Type of business</th>
                    <th class="table_header">Make changes</th>
                </tr>
                <tr>
                    <td class="table_cell">University of Texas</td>
                    <td class="table_cell">UTA</td>
                    <td class="table_cell">Arlington</td>
                    <td class="table_cell">University</td>
                    <td class="table_cell"> <button id="edit_business">Edit</button> <button id="delete_business">Delete</button> </td>
                </tr>
                <tr>
                    <td class="table_cell">University of Texas</td>
                    <td class="table_cell">UTAustin</td>
                    <td class="table_cell">Austin</td>
                    <td class="table_cell">University</td>
                    <td class="table_cell"> <button id="edit_business">Edit</button> <button id="delete_business">Delete</button> </td>
                </tr>
                <tr>
                    <td class="table_cell">Texas Corporation</td>
                    <td class="table_cell">Corporation of Texas</td>
                    <td class="table_cell">Dallas</td>
                    <td class="table_cell">Company</td>
                    <td class="table_cell"> <button id="edit_business">Edit</button> <button id="delete_business">Delete</button> </td>
                </tr>
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
