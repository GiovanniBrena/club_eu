/**
 * Created by Giovanni on 29/08/16.
 */
$( document ).ready(function() {

});

$("#contact-form").submit(function(e){
    var firstname = $('#firstnameField').val();
    var lastname = $('#lastnameField').val();
    var email = $('#emailField').val();
    var message = $('#messageField').val();

    $.ajax({
        url: '../cms/templates/contact-request.php',
        type:'POST',
        data:
        {
            firstname: firstname,
            lastname: lastname,
            email: email,
            message: message
        },
        success: function(msg)
        {
            $("#request-modal-msg").html(firstname + " il tuo messaggio è stato inviato con successo. </br>" +
                "Riceverai a breve una mail di conferma all'indirizzo "+email+".</br></br> Staff ClubEU");
            $("#requestModal").modal('show');

            document.getElementById("contact-form").reset();
        }
    });
    return false;
});
