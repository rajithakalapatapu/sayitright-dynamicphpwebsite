<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">
    <nav>
        <div class="nav_left">
            <a href="HomePage.html"><img src="imgsay/logo.png"> </a>
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="businesslogin.html" class="activetab">Home</a></li>
                <li><a href="conferences.html">Conferences</a></li>
                <li><a href="events.html">Events</a></li>
                <li><a href="myconferences.html">My Conferences</a></li>
                <li><a href="myevents.html">My Events</a></li>
                <li><a href="usersettings.html">Settings</a></li>
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