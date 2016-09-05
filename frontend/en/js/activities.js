/**
 * Created by giovanni on 28/07/16.
 */

$.ajax({    
    type: "GET",
    url: "../../cms/data_requests/get_activities_en.php",
    dataType: "html",   //expect html to be returned                
    success: function(response){
        $("#activities-main-container").html(response);
    }

});