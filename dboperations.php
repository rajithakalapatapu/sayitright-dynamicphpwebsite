<?php

function get_pdo() {
    $connString = "mysql:host=localhost;dbname=rajithak_project1";
    $user = "rk";
    $pass = "Rklappy@2018";

    $pdo = new PDO($connString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function execute_insert_query($sql)
{
    if (empty($sql)) {
        $db_insert_status = "Failed to send message - please try again!";
    } else {
        try {

            $pdo = get_pdo();
            $result = $pdo->query($sql);

            if ($result) {
                $db_insert_status = "Message sent successfully!";
            } else {
                $db_insert_status = "Failed to send message - please try again!";
            }

            $pdo = null;

        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    return $db_insert_status;
}

?>
