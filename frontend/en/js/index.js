/**
 * Created by Giovanni on 01/09/16.
 */

$( document ).ready(function() {
    $(".ddmenu").on("click", function(e){
//        e.preventDefault();

        if($(this).hasClass("open")) {
            $(this).removeClass("open");
            $(this).children("ul").slideUp("fast");
        } else {
            $(this).addClass("open");
            $(this).children("ul").slideDown("fast");
        }
    });

    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_newsletter_en.php",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#last-newsletter").html(response);
        }
    });

});
