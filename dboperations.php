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

function get_select_statement_for_logged_in_user()
{
    session_start();
    if ($_SESSION["user_type"] == "individual") {
        $select_statement = "select * from individual_users where individual_id = '%s'";
    } else if ($_SESSION["user_type"] == "event") {
        $select_statement = "select * from event_users where event_user_id = '%s'";
    } else if ($_SESSION["user_type"] == "business") {
        $select_statement = "select * from business_users where business_user_id = '%s'";
    } else {
        $select_statement = "";
    }

    return $select_statement;
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
