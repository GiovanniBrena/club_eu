/**
 * Created by Giovanni on 14/09/16.
 */
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
                $("#path_it").val(iconPath);
            }
        }).submit();
});

$('#photoimg_en').live('change', function()
{
    $("#preview_en").html('');
    $("#preview_en").html('<img src="loader.gif" alt="Uploading...."/>');
    $("#imageform_en").ajaxForm(
        {
            target: '#preview_en',
            success: function (res) {
                var iconPath = $("#preview-img_en").attr('src');
                $("#path_en").val(iconPath);
            }
        }).submit();
});