<!DOCTYPE html>
<html>
<head>
	<title>This is test php </title>
</head>

<?php
function get_pdo()
{
    $connString = "mysql:host=localhost;dbname=rajithak_test_database";
    $user = "rajithak";
    $pass = " T.6kvAkuBaeH5FOoktR22";

    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

try {
    $pdo = get_pdo();
    $sql = "select * from test";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        echo $row["test_string"];
    }
} catch(PDOException $e) {
    die($e->getMessage());
}
?>
<body>

	Welcome : <?php echo $_POST["Name"];?> <br>
	This is your mail id : <?php echo $_POST["email"];?><br>



</body>
</html>

