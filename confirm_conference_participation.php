<?php
require_once('dboperations.php');

// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

function confirm_conference_participation($conference_id, $individual_id)
{

    try {
        $pdo = get_pdo();

        $stmt = "insert into my_conferences values ('%s', '%s');";
        $sql = sprintf($stmt, $individual_id, $conference_id);

        $result = $pdo->query($sql);
        $pdo = null;
        return $result;
    } catch (PDOException $e) {
//        die($e->getMessage());
        return false;
    }
}

if (isset($_GET['conference_id']) && isset($_GET['individual_id'])) {
    confirm_conference_participation($_GET['conference_id'], $_GET['individual_id']);
    echo '<script>window.location.href = "conferences.php";</script>';
}
?>
