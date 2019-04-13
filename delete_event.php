<?php
require_once('dboperations.php');

// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "event" && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

function delete_event($event_id)
{
    try {
        $pdo = get_pdo();

        $stmt = "delete from events where event_id = '%s';";
        $sql = sprintf($stmt, $event_id);

        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            $success = true;
        } else {
            $success = false;
        }

        $pdo = null;
        return $success;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

if (isset($_GET['event_id'])) {
    delete_event($_GET['event_id']);
    echo '<script>window.location.href = "eventlogin.php";</script>';
}
?>
