<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>
</head>

<body id="wrapper">
    <nav>
        <div class="nav_left">
            <a href="HomePage.php">
                <img src="imgsay/logo.png">
            </a>
        </div>
        <div class="nav_right">
            <ul>
                <li><a href="individuallogin.php">Home</a></li>
                <li><a href="conferences.php">Conferences</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="myconferences.php">My Conferences</a></li>
                <li><a href="myevents.php">My Events</a></li>
                <li><a href="usersettings.php" class="activetab">Settings</a></li>
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
                        <input type="text" name="fname" placeholder="Enter your name" required="">
                    </div>
                    <div>
                        <input type="text" name="lname" placeholder="Enter last name" required="">
                    </div>
                </div>
                <div>
                    <input type="text" name="work" placeholder="Enter place of work" required="">
                </div>
                <div>
                    <input type="text" name="school" placeholder="Enter school" required="">
                </div>
                <div>
                    <input type="email" name="email" placeholder="Enter email" required="">
                </div>
                <div>
                    <input type="password" name="password" placeholder="Enter password" required="">
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
