<?php

function get_pdo()
{
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
        return false;
    }

    try {
        $pdo = get_pdo();
        $result = $pdo->query($sql);
        $pdo = null;

        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    return false;
}

?>
