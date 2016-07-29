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

$response="<br/>";
foreach ( $results['attivita'] as $activity ) {
    $response = $response . "<h5> " . $activity->title_it . "</h5></br>";
}


echo $response;


