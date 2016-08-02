/**
 * Created by giovanni on 29/07/16.
 */

$('#photoimg').live('change', function()
{
    $("#preview").html('');
    $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
    $("#imageform").ajaxForm(
        {
            target: '#preview',
            success: function (res) {
                var iconPath = $("#preview-img").attr('src');
                $("#icon-url").val(iconPath);
            }
        }).submit();
});