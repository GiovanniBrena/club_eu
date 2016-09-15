/**
 * Created by Giovanni on 20/06/16.
 */


$( document ).ready(function() {
    
    bindRequestRow();

    $(".request-row").click(function( event ) {
        event.stopPropagation();
    });

});



function bindRequestRow() {
    var sociRows = $(".request-row");
    sociRows.bind("click", function () {
        location.replace('admin.php?action=editSocioRequest&socioId='+this.getElementsByTagName("td")[4].innerHTML);
    });

    sociRows = $(".renew-row");
    sociRows.bind("click", function () {
        location.replace('admin.php?action=editSocioRequest&socioId='+this.getElementsByTagName("td")[4].innerHTML);
    });
}
