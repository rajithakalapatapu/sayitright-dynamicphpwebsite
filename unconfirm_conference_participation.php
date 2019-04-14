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

function unconfirm_conference_participation($conference_id, $individual_id)
{
    try {
        $pdo = get_pdo();

        $stmt = "delete from my_conferences where individual_id ='%s' and conference_id = '%s';";
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
    unconfirm_conference_participation($_GET['conference_id'], $_GET['individual_id']);
    echo '<script>window.location.href = "myconferences.php";</script>';

}
?>
