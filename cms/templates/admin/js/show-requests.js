/**
 * Created by Giovanni on 20/06/16.
 */


$( document ).ready(function() {
    $(".row-action-approve").click(function( event ) {
        event.stopPropagation();
        alert("click on approve");
    });
    $(".row-action-cancel").click(function( event ) {
        event.stopPropagation();
        alert("click on cancel");
    });
    $(".request-row").click(function( event ) {
        event.stopPropagation();
        alert("click on request");
    });
});