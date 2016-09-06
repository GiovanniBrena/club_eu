/**
 * Created by Giovanni on 06/09/16.
 */


$( document ).ready(function() {
    setLanguage($("#language-hidden")[0].innerHTML);
});


function setLanguage(value) {
    var options = $("option");
    for(var i = 0; i<options.length; i++) {
        if(options[i].value == value) {options[i].selected = 'selected';}
    }
}
