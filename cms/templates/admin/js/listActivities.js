/**
 * Created by giovanni on 29/07/16.
 */


var activityList=[];

function pushActivity(id, title, date, dateCreate) {
    var activity = {
        id: id,
        title: title,
        date: date,
        datecreate: dateCreate

    };
    activityList.push(activity);
}

function bindActivities(){
    var activityRows = $(".activity-row");
    activityRows.bind("click", function () {
        location.replace('admin.php?action=editActivity&id='+this.getElementsByTagName("td")[0].innerHTML);
    });
}

$( document ).ready(function() {

    var activitiesRows = $(".activity-row");
    for (var i=0; i<activitiesRows.length; i++) {
        var id = activitiesRows[i].getElementsByTagName("td")[0].innerHTML;
        var title = activitiesRows[i].getElementsByTagName("td")[2].innerHTML;
        var date = activitiesRows[i].getElementsByTagName("td")[3].innerHTML;
        var dateCreate = activitiesRows[i].getElementsByTagName("td")[4].innerHTML;
        pushActivity(id, title, date, dateCreate);
    }
    bindActivities();

});
