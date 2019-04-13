<?php
require_once('dboperations.php');

// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "business" && isset($_SESSION['user_id'])) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    echo '<script>window.location.href = "login.php";</script>';
}

function delete_business($business_id)
{
    try {
        $pdo = get_pdo();

        $stmt = "delete from my_businesses where business_id = '%s';";
        $sql = sprintf($stmt, $business_id);

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

if (isset($_GET['business_id'])) {
    delete_business($_GET['business_id']);
    echo '<script>window.location.href = "businesslogin.php";</script>';
}

?>
