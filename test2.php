<!DOCTYPE html>
<html>
<head>
    <title>Php in Html</title>
</head>
<body>


<?php
$nameErr = $emailErr = "";
$name = $email = $gender = "";

$formdata = array("name" => "", "email" => "", "nameErr" => "", "emailErr" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $formdata["nameErr"] = "Name is required";
    } else {
        $formdata["name"] = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$formdata["name"])) {
            $formdata["nameErr"] = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $formdata["emailErr"] = "Email id required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $formdata["emailErr"] = "Invalid email format";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">

    <input type="text" name="username" placeholder="Please enter your name">
    <span class="error">* <?php echo $formdata["nameErr"]; ?></span>
    <input type="email" name="email" placeholder="Please enter your email">
    <span class="error">*<?php echo $formdata["emailErr"]; ?></span>
    <input type="submit">

</form>
</body>
</html>

