<!DOCTYPE html>
<html>
<head>
	<title>Php in Html</title>
</head>
<body>


<?php
$nameErr = $emailErr = "";
$name = $email = $gender = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["username"])){
		$nameErr="Name is required";
	}else{
		$name=test_input($_POST["username"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
     		$nameErr = "Only letters and white space allowed";
    	}
	}

	if(empty($_POST["email"])) {
		$emailErr = "Email id required";
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      		$emailErr = "Invalid email format";
    	}
	}
}

function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>">

	<input type="text" name="username" placeholder="Please enter your name" required>
	<span class="error">* <?php echo $nameErr;?></span>
	<input type="email" name="email" placeholder="Please enter your email" required>
	<span class="error">*<?php echo $emailErr;?></span>
	<input type="submit">

</form>
</body>
</html>
