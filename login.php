<html>

<head>
    <link rel="stylesheet" href="sayitright.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="wrapper">

<?php
$email = $password = "";
$emailErr = $passwordErr = "";
function test_input($data)
{
    echo "test" . $data;
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Enter email ID";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Enter a valid email address";
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Enter password";
    } else {
        $password = test_input($_POST["password"]);
    }
    try {
        $connString = "mysql:host=localhost;dbname=rajithak_project1";
        $user = "rk";
        $pass = "Rklappy@2018";
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $indi_sql = "select count(*) as count from individual_users where email='" . $email . "' and password='" . $password . "'";
        $indi_result = $pdo->query($indi_sql);
        while ($row = $indi_result->fetch()) {
            if ($row['count'] == 1) {
                echo '<script>window.location.href = "individuallogin.html";</script>';
            }
        }

        $event_sql = "select count(*) as count from event_users where email='" . $email . "' and password='" . $password . "'";
        $event_result = $pdo->query($event_sql);
        while ($row = $event_result->fetch()) {
            if ($row['count'] == 1) {
                echo '<script>window.location.href = "eventlogin.html";</script>';
            }
        }

        $busi_sql = "select count(*) as count from business_users where email='" . $email . "' and password='" . $password . "'";
        $busi_result = $pdo->query($busi_sql);
        while ($row = $busi_result->fetch()) {
            if ($row['count'] == 1) {
                echo '<script>window.location.href = "businesslogin.html";</script>';
            }
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
            <li><a href="contactus.php">Contact US</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="login.php" class="activetab">Login</a></li>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="breadcrumb">
        <img src="imgsay\home-banner.jpg" alt="Home Page">
        <h6 id="breadcrumbh6">Home --> LOGIN </h6>
        <h2 id="breadcrumbh4">LOGIN</h2>
    </div>
    <div class="login margin10">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">
            <div class="loginform">
                <div align="left">
                    <input type="text" name="email" placeholder="Enter email" required>
                    <span class="error">*<?php echo $emailErr; ?></span>
                </div>
                <div align="left">
                    <input type="password" name="password" placeholder="Enter password" required>
                    <span class="error">*<?php echo $passwordErr; ?></span>
                </div>
                <div align="right">
                    <button class="loginsend" id="button">SEND</button>
                </div>
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
