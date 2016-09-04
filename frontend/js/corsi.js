/**
 * Created by Giovanni on 04/09/16.
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
});