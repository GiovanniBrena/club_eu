/**
 * Created by giovanni on 19/06/16.
 */

var sociList=[];

function pushSocio(dbId, socioId, socioFirstname, socioLastname) {
    var socio = {
        dbId: dbId,
        id: socioId,
        firstname: socioFirstname,
        lastname: socioLastname
        
    };
    sociList.push(socio);
}


function bindSocioRow() {
    var sociRows = $(".socio-row");
    sociRows.bind("click", function () {
        location.replace('admin.php?action=editSocio&socioId='+this.getElementsByTagName("td")[3].innerHTML);
    });
}



$( document ).ready(function() {


    var sociRows = $(".socio-row");
    for (var i=0; i<sociRows.length; i++) {
        var id = sociRows[i].getElementsByTagName("td")[0].innerHTML;
        var name = sociRows[i].getElementsByTagName("td")[1].innerHTML;
        var surname = sociRows[i].getElementsByTagName("td")[2].innerHTML;
        var dbId = sociRows[i].getElementsByTagName("td")[3].innerHTML;
        pushSocio(dbId, id, name, surname);
    }


    bindSocioRow();



    $( "#soci-id-field" ).bind("input", function() {

        var str = $("#soci-id-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].id.substring(0, str.length) == str) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td></tr>');
            }
        }
        bindSocioRow();
    });


    $( "#soci-firstname-field" ).bind("input", function() {

        var str = $("#soci-firstname-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].firstname.indexOf(str) > -1) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td></tr>');
            }
        }
        bindSocioRow();
    });

    $( "#soci-lastname-field" ).bind("input", function() {

        var str = $("#soci-lastname-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].lastname.indexOf(str) > -1) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td></tr>');
            }
        }
        bindSocioRow();
    });

    $("#add-socio-btn").hover(
        function() {
            $("#new-socio-icon").attr("src","images/add-orange.png");
        }, function() {
            $("#new-socio-icon").attr("src","images/add.png");
        }
    );


});