<?php

function get_home_link_for_logged_in_user()
{
    session_start();
    if ($_SESSION["user_type"] == "individual") {
        $home_link = "<li><a href=\"individuallogin.php\">Home</a></li>";
    } else if ($_SESSION["user_type"] == "event") {
        $home_link ="<li><a href=\"eventlogin.php\">Home</a></li>";
    } else if ($_SESSION["user_type"] == "business") {
        $home_link ="<li><a href=\"businesslogin.php\">Home</a></li>";
    } else {
        $home_link ="<li><a href=\"login.php\">Home</a></li>";
    }

    return $home_link;
}

function go_to_home_page_for_logged_in_user()
{
    session_start();
    if ($_SESSION["user_type"] == "individual") {
        $home_link = "<script>window.location.href = \"individuallogin.php\";</script>";
    } else if ($_SESSION["user_type"] == "event") {
        $home_link = "<script>window.location.href = \"eventlogin.php\";</script>";
    } else if ($_SESSION["user_type"] == "business") {
        $home_link = "<script>window.location.href = \"businesslogin.php\";</script>";
    } else {
        $home_link = "<script>window.location.href = \"login.php\";</script>";
    }

    return $home_link;
}

?>
