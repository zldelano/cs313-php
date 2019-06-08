function validateFormService() {
    var new_service_vin = document.forms['form_service']['new_service_vin'].value;
    if (new_service_vin.length != 17) {
        alert("Vin must be 17 characters long");
        return false;
    }
}

function validateFormCar() {
    var newcar_vin = document.forms['form_car']['newcar_vin'].value;
    var newcar_year = document.forms['form_car']['newcar_year'].value;
    if (newcar_vin.length != 17) {
        alert("Vin must be 17 characters long");
        return false;
    }
    if (newcar_year.length != 4) {
        alert("Year must be 4 characters long");
        return false;
    }
}

function validateFormCustomer() {
    var newcust_phone_primary = document.forms['form_customer']['newcust_phone_primary'].value;
    var newcust_phone_secondary = document.forms['form_customer']['newcust_phone_secondary'].value;
    if (newcust_phone_primary.length != 10 || newcust_phone_secondary.length != 10) {
        alert("Phone length (primary AND secondary) must be 10 digits long. Format: '1234567890'");
        return false;
    }
}

function validateFormAddress() {
    var newaddr_zip = document.forms['form_address']['newaddr_zip'].value;
    var newaddr_state = document.forms['form_address']['newaddr_state'].value;
    if (newaddr_zip.length != 5) {
        alert("Zip length must be 5 digits long. Ex: 98052");
        return false;
    }
    if (newaddr_state.length != 2) {
        alert("State must only have two characters. Ex: 'WA'");
        return false;
    }
}