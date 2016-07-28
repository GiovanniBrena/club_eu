/**
 * Created by giovanni on 28/07/16.
 */

$.ajax({    //create an ajax request to load_page.php
    type: "GET",
    url: "../cms/data_requests/get_activities.php",
    dataType: "html",   //expect html to be returned                
    success: function(response){
        $("#activities-main-container").html(response);
    }

});