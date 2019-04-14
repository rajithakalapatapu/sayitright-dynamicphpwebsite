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

function is_valid_password($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Enter password";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
    }

    return $value;
}

function is_valid_work_location($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Enter valid work location";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
    }

    return $value;
}

function is_valid_school_name($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );


    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "School Name is required";
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

function is_valid_date($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Event date is required";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        $d = DateTime::createFromFormat('Y-m-d', $user_entered_value);
        if (!($d && $d->format('Y-m-d') == $user_entered_value)) {
            $value["validation_failure_message"] = "Only valid dates are allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;

}


function is_valid_time($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "Event date is required";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        if (!preg_match("/^[0-9]{2}:[0-9]{2}$/", $value["sanitized_value"])) {
            $value["validation_failure_message"] = "Only letters and white space allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;

}

function is_valid_license_number($user_entered_value)
{
    $value = array(
        "sanitized_value" => "",
        "is_valid" => true, // assume valid input
        "validation_failure_message" => ""
    );

    if (empty($user_entered_value)) {
        $value["validation_failure_message"] = "License number is required";
        $value["is_valid"] = false;
    } else {
        $value["sanitized_value"] = test_input($user_entered_value);
        if (!preg_match("/^[a-zA-Z0-9 -]*$/", $value["sanitized_value"])) {
            $value["validation_failure_message"] = "Only letters and white space allowed";
            $value["is_valid"] = false;
        }
    }

    return $value;
}

?>
