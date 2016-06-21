/**
 * Created by Giovanni on 20/06/16.
 */


$( document ).ready(function() {
    
    bindRequestRow();

    var confirmModal = $("#myModal");

    $(".row-action-approve").click(function( event ) {
        event.stopPropagation();
        confirmModal.show();
    });
    $(".row-action-cancel").click(function( event ) {
        event.stopPropagation();
        alert("click on cancel");
    });
    $(".request-row").click(function( event ) {
        event.stopPropagation();
        alert("click on request");
    });

    $("#modal-cancel").click(function( event ) {
        confirmModal.hide();
    });
});



function bindRequestRow() {
    var sociRows = $(".request-row");
    sociRows.bind("click", function () {
        location.replace('admin.php?action=editSocioRequest&socioId='+this.getElementsByTagName("td")[4].innerHTML);
    });
}
