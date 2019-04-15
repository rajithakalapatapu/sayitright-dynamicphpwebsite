function is_valid_email(email) {
    pattern = new RegExp(/^[a-z]+\d*@[a-z]+.[a-z]+$/);
    return pattern.test(email);
}

function is_valid_text(field) {
    pattern = new RegExp(/^[a-zA-Z ]+$/);
    return pattern.test(field);
}

function is_valid_password(password) {
    return true;
}

function is_valid_postal(postal_code) {
    pattern = new RegExp(/^[0-9]{5}/);
    return pattern.test(postal_code);
}

function submit_login_form() {
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;

    valid_email = is_valid_email(email);
    if (!valid_email) {
        document.getElementById('emailErr').innerText = "Enter a valid email";
    }
    valid_password = is_valid_password(password);
    if (!valid_password) {
        document.getElementById('passwordErr').innerText = "Enter a valid password";
    }

    return valid_email && valid_password;
}

function submit_subscribe_form() {
    valid_email = is_valid_email(document.getElementById('subscribe_email').value);

    if (!valid_email) {
        document.getElementById('subscribe_emailErr').innerText = "Enter a valid email";
    }

    return valid_email;
}

function validate_input(form_name, input_name) {
    x = document.forms[form_name][input_name].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
    pattern = new RegExp(/^[a-zA-Z ]+$/);
    return pattern.test(x);
}

function validate_phone(form_name, input_name) {
    x = document.forms[form_name][input_name].value;
    if (x == "") {//} || x.match(regex) == null) {
        alert("Phone number must be filled out with numbers");
        return false;
    }
    pattern = new RegExp("^[0-9]{10}$");
    return pattern.test(x);
}

function reset_all_contactus_errors() {
    var elements = ['fnameErr', 'lnameErr', 'phoneErr', 'MessageErr'];
    reset_form_errors(elements);
}

function submit_contactus_form() {
    reset_all_contactus_errors();
    valid_fname = validate_input("contactus_form", "fname");
    if (!valid_fname) {
        document.getElementById('fnameErr').innerHTML = "Enter a valid name";
        return false;
    }
    valid_lname = validate_input("contactus_form", "lname");
    if (!valid_lname) {
        document.getElementById('lnameErr').innerHTML = "Enter a valid name";
        return false;
    }
    valid_phone = validate_phone("contactus_form", "phone");
    if (!valid_phone) {
        document.getElementById('phoneErr').innerHTML = "Enter a valid phone number";
        return false;
    }
    valid_message = validate_input("contactus_form", "Message");
    if (!valid_message) {
        document.getElementById('MessageErr').innerHTML = "Enter a valid message";
        return false;
    }

    return valid_fname && valid_lname && valid_phone && valid_message;
}

function reset_form_errors(elements) {

    elements.forEach(function (element) {
        document.getElementById(element).innerHTML = "";
    });

}

function reset_ind_function_errors() {
    var elements = ['ind_fnameErr', 'ind_lnameErr', 'ind_workErr', 'ind_schoolErr', 'ind_emailErr', 'ind_passwordErr'];
    reset_form_errors(elements);
}

function ind_function() {

    reset_ind_function_errors();

    valid_fname = is_valid_text(document.getElementById('ind_fname').value);
    if (!valid_fname) {
        document.getElementById('ind_fnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_lname = is_valid_text(document.getElementById('ind_lname').value);
    if (!valid_lname) {
        document.getElementById('ind_lnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_work = is_valid_text(document.getElementById('ind_work').value);
    if (!valid_work) {
        document.getElementById('ind_workErr').innerHTML = "Enter a valid work";
        return false;
    }

    valid_school = is_valid_text(document.getElementById('ind_school').value);
    if (!valid_school) {
        document.getElementById('ind_schoolErr').innerHTML = "Enter a valid school";
        return false;
    }

    valid_email = is_valid_email(document.getElementById('ind_email').value);
    if (!valid_email) {
        document.getElementById('ind_emailErr').innerHTML = "Enter a valid email";
        return false;
    }

    valid_password = is_valid_password(document.getElementById('ind_password').value);
    if (!valid_password) {
        document.getElementById('ind_passwordErr').innerHTML = "Enter a valid password";
        return false;
    }

    return true;
}

function reset_event_function_errors() {
    var elements = ['event_fnameErr', 'event_lnameErr', 'event_emailErr', 'event_passwordErr'];
    reset_form_errors(elements);
}

function event_function() {
    reset_event_function_errors();

    valid_fname = is_valid_text(document.getElementById('event_fname').value);
    if (!valid_fname) {
        document.getElementById('event_fnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_lname = is_valid_text(document.getElementById('event_lname').value);
    if (!valid_lname) {
        document.getElementById('event_lnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_email = is_valid_email(document.getElementById('event_email').value);
    if (!valid_email) {
        document.getElementById('event_emailErr').innerHTML = "Enter a valid email";
        return false;
    }

    valid_password = is_valid_password(document.getElementById('event_password').value);
    if (!valid_password) {
        document.getElementById('event_passwordErr').innerHTML = "Enter a valid password";
        return false;
    }

    return true;

}

function reset_business_function_errors() {
    var elements = ['busi_lnameErr', 'busi_emailErr', 'busi_passwordErr'];
    reset_form_errors(elements);
}

function busi_function() {

    reset_business_function_errors();

    radio_value = document.querySelector('input[name="businesstype"]:checked').value;
    if (radio_value == "Company" || radio_value == "University") {
        // keep going on
    } else {
        return false;
    }

    valid_lname = is_valid_text(document.getElementById('busi_lname').value);
    if (!valid_lname) {
        document.getElementById('busi_lnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_email = is_valid_email(document.getElementById('busi_email').value);
    if (!valid_email) {
        document.getElementById('busi_emailErr').innerHTML = "Enter a valid email";
        return false;
    }

    valid_password = is_valid_password(document.getElementById('busi_password').value);
    if (!valid_password) {
        document.getElementById('busi_passwordErr').innerHTML = "Enter a valid password";
        return false;
    }

    return true;

}

function reset_usersettings_form_errors() {
    elements = ['fnameErr', 'lnameErr', 'workErr', 'emailErr', 'schoolErr', 'passwordErr'];
    reset_form_errors(elements);
}

function submit_usersettings_form() {
    reset_usersettings_form_errors();

    valid_fname = is_valid_text(document.getElementById('fname').value);
    if (!valid_fname) {
        document.getElementById('fnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_lname = is_valid_text(document.getElementById('lname').value);
    if (!valid_lname) {
        document.getElementById('lnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_work = is_valid_text(document.getElementById('work').value);
    if (!valid_work) {
        document.getElementById('workErr').innerHTML = "Enter a valid work";
        return false;
    }

    valid_school = is_valid_text(document.getElementById('school').value);
    if (!valid_school) {
        document.getElementById('schoolErr').innerHTML = "Enter a valid school";
        return false;
    }

    valid_email = is_valid_email(document.getElementById('email').value);
    if (!valid_email) {
        document.getElementById('emailErr').innerHTML = "Enter a valid email";
        return false;
    }

    valid_password = is_valid_password(document.getElementById('password').value);
    if (!valid_password) {
        document.getElementById('passwordErr').innerHTML = "Enter a valid password";
        return false;
    }

    return true;

}

function reset_shipping_form_errors() {
    elements = ['fnameErr', 'lnameErr', 'addressErr', 'emailErr', 'apartmentErr', 'cityErr', 'postalErr'];
    reset_form_errors(elements);
}

function submit_shipping_form() {
    reset_shipping_form_errors();

    valid_fname = is_valid_text(document.getElementById('fname').value);
    if (!valid_fname) {
        document.getElementById('fnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_lname = is_valid_text(document.getElementById('lname').value);
    if (!valid_lname) {
        document.getElementById('lnameErr').innerHTML = "Enter a valid name";
        return false;
    }

    valid_email = is_valid_email(document.getElementById('email').value);
    if (!valid_email) {
        document.getElementById('emailErr').innerHTML = "Enter a valid email";
        return false;
    }

    valid_address = is_valid_text(document.getElementById('address').value);
    if (!valid_address) {
        document.getElementById('addressErr').innerHTML = "Enter a valid address";
        return false;
    }

    valid_apartment = is_valid_text(document.getElementById('apartment').value);
    if (!valid_apartment) {
        document.getElementById('apartmentErr').innerHTML = "Enter a valid apartment";
        return false;
    }

    valid_city = is_valid_text(document.getElementById('city').value);
    if (!valid_city) {
        document.getElementById('cityErr').innerHTML = "Enter a valid city";
        return false;
    }

    valid_postal = is_valid_postal(document.getElementById('postal').value);
    if (!valid_postal) {
        document.getElementById('postalErr').innerHTML = "Enter a valid postal code";
        return false;
    }

    return true;
}


function clear_cart() {
    window.location.href = 'delete_cart.php';
}
