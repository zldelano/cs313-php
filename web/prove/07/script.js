function validateFormCar() {
    var newcar_vin = document.forms['form_car']['newcar_vin'].value;
    if (newcar_vin.length != 17) {
        alert("Vin must be 17 characters long");
        return false;
    }
}