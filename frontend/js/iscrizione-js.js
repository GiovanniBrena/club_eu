/**
 * Created by Giovanni on 07/07/2016.
 */



$( document ).ready(function() {
});

$("#request-form").submit(function(e){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var email = $('#emailField').val();
    var dateOfBirth = $('#datebirthField').val();
    var nationality = $('#nationalityField').val();
    var address = $('#addressField').val();
    var cap = $('#capField').val();
    var city = $('#cityField').val();
    var phone = $('#phoneField').val();
    //var position = $('#positionField').val();
    $.ajax({
        url: '../cms/templates/socio-request.php',
        type:'POST',
        data:
        {
            firstname: name,
            lastname: lastname,
            email: email,
            date_of_birth: dateOfBirth,
            nationality: nationality,
            address: address,
            cap: cap,
            city: city,
            phone: phone,
            position: 0,
            state: 0
        },
        success: function(msg)
        {
            alert(msg);
        }
    });
    return false;
});

