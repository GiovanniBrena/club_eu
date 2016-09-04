/**
 * Created by Giovanni on 07/07/2016.
 */



$( document ).ready(function() {

});

$("#request-form").submit(function(e){
    var firstname = $('#firstnameField').val();
    var lastname = $('#lastnameField').val();
    var email = $('#emailField').val();
    var dateOfBirth = $('#datebirthField').val();
    var nationality = $('#nationalityField').val();
    var address = $('#addressField').val();
    var cap = $('#capField').val();
    var city = $('#cityField').val();
    var phone = $('#phoneField').val();
    var position = 0;
    if(document.getElementById('positionExt').checked) {
        position = 1;
    }
    $.ajax({
        url: '../../cms/templates/socio-request.php',
        type:'POST',
        data:
        {
            personal_id: "",
            firstname: firstname,
            lastname: lastname,
            email: email,
            date_of_birth: dateOfBirth,
            nationality: nationality,
            address: address,
            cap: cap,
            city: city,
            phone: phone,
            positionId: position,
            state: 1
        },
        success: function(msg)
        {
            $("#request-modal-msg").html(firstname + " your request has been sent correctly. </br>" +
                "You will receve soon an email message on the address "+email+".</br></br> Staff ClubEU");
            $("#requestModal").modal('show');

            document.getElementById("request-form").reset();
        }
    });
    return false;
});
