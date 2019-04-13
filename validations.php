<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function is_valid_first_name($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );


    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "First Name is required";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        if (!preg_match("/^[a-zA-Z ]*$/", $value["sanitized_value"])) {
            $value["validation_failure_message"] = "Only letters and white space allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;
}

function is_valid_last_name($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Last Name is required";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        if (!preg_match("/^[a-zA-Z ]*$/", $value["sanitized_value"])) {
            $value["validation_failure_message"] = "Only letters and white space allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;
}


function is_valid_telephone_number($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Please enter numbers";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        if (!preg_match("/^[0-9]*$/", $value["sanitized_value"])) {
            $value["validation_failure_message"] = "Only numbers allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;
}

function is_valid_message($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Please write some message";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
    }

    return $value;
}

function is_valid_email($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    $value["sanitized_value"] = test_input($user_entered_value);

    if (!filter_var($value["sanitized_value"], FILTER_VALIDATE_EMAIL)) {
        $value["validation_failure_message"] = "Enter a valid email ID";
        $value["is_valid"] = false;
    }

    return $value;
}

?>
