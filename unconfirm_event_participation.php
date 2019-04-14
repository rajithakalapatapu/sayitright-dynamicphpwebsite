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

function unconfirm_event_participation($event_id, $individual_id)
{
    try {
        $pdo = get_pdo();

        $stmt = "delete from my_events where individual_id ='%s' and event_id = '%s';";
        $sql = sprintf($stmt, $individual_id, $event_id);

        $result = $pdo->query($sql);
        $pdo = null;
        return $result;
    } catch (PDOException $e) {
//        die($e->getMessage());
        return false;
    }
}

if (isset($_GET['event_id']) && isset($_GET['individual_id'])) {
    unconfirm_event_participation($_GET['event_id'], $_GET['individual_id']);
    echo '<script>window.location.href = "myevents.php";</script>';

}
?>
