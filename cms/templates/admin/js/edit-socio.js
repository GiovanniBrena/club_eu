/**
 * Created by Giovanni on 20/06/16.
 */



$( document ).ready(function() {
    setNationality($("#nationality-hidden")[0].innerHTML);
    setDateOfBirth($("#birth_date-hidden")[0].innerHTML)
});


function setNationality(value) {
    var options = $("option");
    for(var i = 0; i<options.length; i++) {
        if(options[i].value == value) {options[i].selected = 'selected';}
    }
}

function setDateOfBirth(value) {
    var datePicker= $('#date_of_birth')[0];
    datePicker.value = value;
}