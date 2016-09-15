<?php
$path = "../resources/newsletter/";

$valid_formats = array("jpg", "png", "gif", "bmp", "pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];

    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
            if($size<(1024*1024)*10)
            {
                $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name))
                {
                    echo "<iframe class='preview-pdf' id='preview-img' src='resources/newsletter/".$actual_image_name."' style='width:100%;' frameborder='0'></iframe>";
                }
                else
                    echo "failed";
            }
            else
                echo "Image file size max 10 MB";
        }
        else
            echo "Invalid file format..";
    }

    else
        echo "Please select image..!";

    exit;
}
?>