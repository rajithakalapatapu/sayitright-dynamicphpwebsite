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

function get_all_conferences_count()
{
    try {
        $pdo = get_pdo();
        $sql = "select count(*) as conf_count from conferences;";

        $result = $pdo->query($sql);
        $row = $result->fetch();

        return $row["conf_count"];
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_all_events_count()
{
    try {
        $pdo = get_pdo();
        $sql = "select count(*) as event_count from events;";

        $result = $pdo->query($sql);
        $row = $result->fetch();

        return $row["event_count"];
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_my_conferences_count($user_id)
{
    try {
        $pdo = get_pdo();
        $stmt = "select count(*) as conf_count from my_conferences where individual_id = '%s';";
        $sql = sprintf($stmt, $user_id);

        $result = $pdo->query($sql);
        $row = $result->fetch();

        return $row["conf_count"];
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_my_events_count($user_id)
{
    try {
        $pdo = get_pdo();
        $stmt = "select count(*) as event_count from my_events where individual_id = '%s';";
        $sql = sprintf($stmt, $user_id);

        $result = $pdo->query($sql);
        $row = $result->fetch();

        return $row["event_count"];
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_all_participanting_events($user_id)
{
    try {
        $pdo = get_pdo();
        $stmt = "select * from events where event_id in (SELECT event_id FROM `my_events` WHERE individual_id = '%s');";
        $sql = sprintf($stmt, $user_id);

        $result = $pdo->query($sql);
        $pdo = null;
        return $result;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_all_participanting_conferences($user_id)
{
    try {
        $pdo = get_pdo();
        $stmt = "select * from conferences where conference_id in (SELECT conference_id FROM `my_conferences` WHERE individual_id = '%s');";
        $sql = sprintf($stmt, $user_id);

        $result = $pdo->query($sql);
        $pdo = null;
        return $result;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_product_details($product_id)
{
    try {
        $pdo = get_pdo();
        $stmt = "select * from products where product_id = '%s';";
        $sql = sprintf($stmt, $product_id);

        $result = $pdo->query($sql);
        $pdo = null;
        return $result;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function get_order_id($email, $order_total, $postal)
{
    try {
        $pdo = get_pdo();

        $stmt = "select order_id from orders where order_email = '%s' and order_total = '%s' and order_pincode = '%s'";
        $sql = sprintf($stmt, $email, $order_total, $postal);

        $result = $pdo->query($sql);
        $order_id = $result->fetch()['order_id'];

        $pdo = null;
        return $order_id;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function add_entry_to_order_product($order_id, $product_id, $quantity)
{
    $stmt = "insert into order_products values ('%s', '%s', '%s')";
    $sql = sprintf($stmt, $order_id, $product_id, $quantity);
    return execute_insert_query($sql);
}


?>
