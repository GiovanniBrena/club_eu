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

$months = array( "01" => 'Gennaio', "02" => 'Febbraio', "03" => 'Marzo', "04" => 'Aprile',
    "05" => 'Maggio',     "06" => 'Giugno', "07" => 'Luglio',  "08" => 'Agosto',
    "09" => 'Settembre', "10" => 'Ottobre', "11" => 'Novembre',
    "12" => 'Dicembre');



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
                        <img src=\"$activity->icon_url\"/>
                    </div>
                    <div class=\"single-activity-header\">
                        <div class=\"single-activity-day\">
                                        <h1>" . $arr['day'] . "</h1>
                                        <h4>$month</h4>
                        </div>
                        <div class=\"single-activity-title\"><h3>" . $activity->title_it . "</h3></div>
                    </div>
                </div>
            </div>
            <div class=\"col-md-6\">
                <div class=\"single-activity-desc-container\">
                    <p id=\"act-desc\">" . $activity->desc_it . "</p>
                    <h4>Prezzo soci: $activity->price_socio €</h4>
                    <h4>Prezzo non soci: $activity->price_ext €</h4>
                    <h4>Posti disponibili: $activity->place_total</h4>
                </div>
                </div>
        </div>
    </div>";


echo $response;
