/**
 * Created by giovanni on 29/07/16.
 */

$( document ).ready(function() {

    $.ajax({
        type: "GET",
        url: "../../cms/data_requests/get_activity.php?"+location.search,
        dataType: "text",   //expect html to be returned
        success: function(response){
            $("#activity-main-container").html(response);
        }

    });

});
