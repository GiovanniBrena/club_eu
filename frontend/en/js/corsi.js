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

    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=italian",
        dataType: "html",   //expect html to be returned                
        success: function(response){
            $("#collapse1").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=english",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse2").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=french",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse3").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=spanish",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse4").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=russian",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse5").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=japanese",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse6").html(response);
        }
    });
    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_courses_en.php?lang=german",
        dataType: "html",   //expect html to be returned
        success: function(response){
            $("#collapse7").html(response);
        }
    });
    
});