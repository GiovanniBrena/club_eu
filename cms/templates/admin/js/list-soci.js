/**
 * Created by giovanni on 19/06/16.
 */

var sociList=[];
var activeDropdown = {};

function pushSocio(dbId, socioId, socioFirstname, socioLastname, socioDate) {
    var socio = {
        dbId: dbId,
        id: socioId,
        firstname: socioFirstname,
        lastname: socioLastname,
        datecreate: socioDate
        
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
        var date = sociRows[i].getElementsByTagName("td")[4].innerHTML;
        pushSocio(dbId, id, name, surname, date);
    }


    bindSocioRow();



    $( "#soci-id-field" ).bind("input", function() {

        var str = $("#soci-id-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].id.substring(0, str.length) == str) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td><td>'+sociList[i].datecreate+'</td></tr>');
            }
        }
        bindSocioRow();
    }).click(function (event) {
        event.stopPropagation();
    });


    $( "#soci-firstname-field" ).bind("input", function() {

        var str = $("#soci-firstname-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].firstname.indexOf(str) > -1 || sociList[i].firstname.toLowerCase().indexOf(str) > -1) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td><td>'+sociList[i].datecreate+'</td></tr>');
            }
        }
        bindSocioRow();
    }).click(function (event) {
        event.stopPropagation();
    });

    $( "#soci-lastname-field" ).bind("input", function() {
        var str = $("#soci-lastname-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].lastname.indexOf(str) > -1 || sociList[i].lastname.toLowerCase().indexOf(str) > -1) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td><td>'+sociList[i].datecreate+'</td></tr>');
            }
        }
        bindSocioRow();
    }).click(function (event) {
        event.stopPropagation();
    });

    $( "#soci-date-field" ).bind("input", function() {
        var str = $("#soci-date-field").val();
        $('.socio-row').remove();
        for(var i=0; i<sociList.length; i++){
            if(sociList[i].datecreate.indexOf(str) > -1 || sociList[i].datecreate.toLowerCase().indexOf(str) > -1) {
                $("#soci-table").append('<tr class="socio-row"><td>'+sociList[i].id+'</td><td>'+sociList[i].firstname+'</td><td>'+sociList[i].lastname+'</td><td style="display: none">'+sociList[i].dbId+'</td><td>'+sociList[i].datecreate+'</td></tr>');
            }
        }
        bindSocioRow();
    }).click(function (event) {
        event.stopPropagation();
    });

    $("#add-socio-btn").hover(
        function() {
            $("#new-socio-icon").attr("src","images/add-orange.png");
        }, function() {
            $("#new-socio-icon").attr("src","images/add.png");
        }
    );

    $("#year-dropdown").click(function () {
        if (activeDropdown.id && activeDropdown.id !== event.target.id) {
            activeDropdown.element.classList.remove('active');
        }
        //checking if a list element was clicked, changing the inner button value
        if (event.target.tagName === 'LI') {
            activeDropdown.button.innerHTML = event.target.innerHTML;
            for (var i=0;i<event.target.parentNode.children.length;i++){
                if (event.target.parentNode.children[i].classList.contains('check')) {
                    event.target.parentNode.children[i].classList.remove('check');
                }
            }
            //timeout here so the check is only visible after opening the dropdown again
            window.setTimeout(function(){
                event.target.classList.add('check');
            },500)
        }
        for (var i = 0;i<this.children.length;i++){
            if (this.children[i].classList.contains('dropdown-selection')){
                activeDropdown.id = this.id;
                activeDropdown.element = this.children[i];
                this.children[i].classList.add('active');
            }
            //adding the dropdown-button to our object
            else if (this.children[i].classList.contains('dropdown-button')){
                activeDropdown.button = this.children[i];
            }
    }

        window.onclick = function(event) {
            if (!event.target.classList.contains('dropdown-button')) {
                activeDropdown.element.classList.remove('active');
            }
        };


        $(".year-selector").click(function () {
            var year = this.textContent;
            data = year.split("/");
            location.replace('admin.php?action=listSoci&year='+data[0]);
        });

});

});