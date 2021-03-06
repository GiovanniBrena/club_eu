<?php
/**
 * Created by PhpStorm.
 * User: giovanni
 * Date: 28/07/16
 * Time: 18:19
 */

require( "../config.php" );

$data = Attivita::getListVisible();
$results['attivita'] = $data['results'];
$results['totalRows'] = $data['totalRows'];


$months = array( "01" => 'Gennaio', "02" => 'Febbraio', "03" => 'Marzo', "04" => 'Aprile',
    "05" => 'Maggio',     "06" => 'Giugno', "07" => 'Luglio',  "08" => 'Agosto',
    "09" => 'Settembre', "10" => 'Ottobre', "11" => 'Novembre',
    "12" => 'Dicembre');


$response="<br/>";
foreach ( $results['attivita'] as $activity ) {
    $date = new DateTime($activity->date_act);
    $day = $date->format('d');
    $month = $months[$date->format('m')];
    $desc_it = $activity->desc_it;
    if(strlen($desc_it)>300) {
        $desc_it=substr($desc_it,0,300)." (...)";
    }


    $response = $response . "<div class=\"row activity-row\">
          <a href=\"activity.html?". $activity->id ."\">
          <div class=\"activity-row-info\">
                <h3>" . $activity->title_it . "</h3>
                <p>" . $desc_it . "</p>
          </div>
          <div class=\"activity-row-date\">
                <h1>" . $day . "</h1>
                <h4>" . $month . "</h4>
          </div>
          <div class=\"activity-row-img\">
                <img src=\"" . $activity->icon_url . "\"/>
          </div>
          </a> 
        </div>";
}


echo $response;


