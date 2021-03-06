/**
 * Created by Giovanni on 07/07/2016.
 */



$( document ).ready(function() {
    $("#btn-request").click(function () {
        $("#renew-form").hide();
        $("#request-form").show();
        $("#btn-request").css("background-color", "white");
        $("#btn-renew").css("background-color", "transparent");
    });
    $("#btn-renew").click(function () {
        $("#request-form").hide();
        $("#renew-form").show();
        $("#btn-renew").css("background-color", "white");
        $("#btn-request").css("background-color", "transparent");
    });
});


$("#renew-form").submit(function(e){
    var email = $('#renewEmailField').val();
    var personalId = $('#renewIdField').val();
    $.ajax({
        url: '../cms/templates/renew-request.php',
        type:'POST',
        data:
        {
            personal_id: personalId,
            email: email
        },
        success: function(msg)
        {
            $("#request-modal-msg").html(msg);
            $("#requestModal").modal('show');

            document.getElementById("renew-form").reset();
        }
    });
    return false;
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
        url: '../cms/templates/socio-request.php',
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
            $("#request-modal-msg").html(firstname + " la tua richiesta è stata inviata con successo. </br>" +
                "Riceverai a breve una mail di conferma all'indirizzo "+email+".</br></br> Staff ClubEU");
            $("#requestModal").modal('show');

            document.getElementById("request-form").reset();
        }
    });
    return false;
});
