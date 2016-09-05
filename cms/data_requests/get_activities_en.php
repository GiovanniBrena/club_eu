<?php
/**
 * Created by PhpStorm.
 * User: giovanni
 * Date: 28/07/16
 * Time: 18:19
 */

require( "../config.php" );

$data = Attivita::getList();
$results['attivita'] = $data['results'];
$results['totalRows'] = $data['totalRows'];


$months = array( "01" => 'January', "02" => 'Febrary', "03" => 'March', "04" => 'April',
    "05" => 'May',     "06" => 'June', "07" => 'July',  "08" => 'August',
    "09" => 'September', "10" => 'October', "11" => 'November',
    "12" => 'December');


$response="<br/>";
foreach ( $results['attivita'] as $activity ) {
    $date = new DateTime($activity->date_act);
    $day = $date->format('d');
    $month = $months[$date->format('m')];
    $desc_en = $activity->desc_en;
    if(strlen($desc_en)>300) {
        $desc_en=substr($desc_en,0,300)." (...)";
    }


    $response = $response . "<div class=\"row activity-row\">
          <a href=\"activity.html?". $activity->id ."\">
          <div class=\"activity-row-info\">
                <h3>" . $activity->title_en . "</h3>
                <p>" . $desc_en . "</p>
          </div>
          <div class=\"activity-row-date\">
                <h1>" . $day . "</h1>
                <h4>" . $month . "</h4>
          </div>
          <div class=\"activity-row-img\">
                <img src=\"" . '../' . $activity->icon_url . "\"/>
          </div>
          </a> 
        </div>";
}


echo $response;


