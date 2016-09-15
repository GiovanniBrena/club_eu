function bindNewsletter(){
    var activityRows = $(".activity-row");
    activityRows.bind("click", function () {
        location.replace('admin.php?action=editNewsletter&id='+this.getElementsByTagName("td")[0].innerHTML);
    });
}

$( document ).ready(function() {
    
    bindNewsletter();

});
/**
 * Created by Giovanni on 14/09/16.
 */
