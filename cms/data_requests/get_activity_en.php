<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 01/08/16
 * Time: 10:33
 */

require( "../config.php" );


$activityId = str_replace("?","",$_SERVER["QUERY_STRING"]);
$activity = Attivita::getById($activityId);

$months = array( "01" => 'January', "02" => 'Febrary', "03" => 'March', "04" => 'April',
    "05" => 'May',     "06" => 'June', "07" => 'July',  "08" => 'August',
    "09" => 'September', "10" => 'October', "11" => 'November',
    "12" => 'December');



$dateAct = new DateTime($activity->date_act);
$dateDeadline = new DateTime($activity->deadline);

$arr = array(
    'title_it' => $activity->title_it,
    'title_en' => $activity->title_en,
    'desc_it' => $activity->desc_it,
    'desc_en' => $activity->desc_en,
    'day' => $dateAct->format('d'),
    'month' => $dateAct->format('m'),
    'price_socio' => $activity->price_socio,
    'price_ext' => $activity->price_ext,
    'place' => $activity->place_available,
    'deadline' => $dateDeadline->format('d-m-Y')
);

$month = $months[$dateAct->format('m')];

$response = "" . "<div class=\"row\">
            <div class=\"col-md-6\">
                <div class=\"single-activity-container\">
                    <div class=\"single-activity-img\">
                        <img src=\"../$activity->icon_url\"/>
                    </div>
                    <div class=\"single-activity-header\">
                        <div class=\"single-activity-day\">
                                        <h1>" . $arr['day'] . "</h1>
                                        <h4>$month</h4>
                        </div>
                        <div class=\"single-activity-title\"><h3>" . $activity->title_en . "</h3></div>
                    </div>
                </div>
            </div>
            <div class=\"col-md-6\">
                <div class=\"single-activity-desc-container\">
                    <p id=\"act-desc\">" . $activity->desc_en . "</p>
                    <h4>Prezzo soci: $activity->price_socio €</h4>
                    <h4>Prezzo non soci: $activity->price_ext €</h4>
                </div>
                </div>
        </div>
    </div>";


echo $response;
