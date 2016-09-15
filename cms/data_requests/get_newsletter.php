<?php
/**
 * Created by PhpStorm.
 * User: giovanni
 * Date: 28/07/16
 * Time: 18:19
 */

require( "../config.php" );

$data = Newsletter::getLastNewsletter();
$results['last'] = $data['results'];
$results['totalRows'] = $data['totalRows'];

foreach ($results['last'] as $newsletter ) {
    $lastName = $newsletter->title_it;
    $lastPath = $newsletter->path_it;
}

$data = Newsletter::getListLimit6();
$results['list'] = $data['results'];
$results['totalRows'] = $data['totalRows'];


$response='<a href="../cms/'.$lastPath.'" target="_blank" class="btn btn-default" role="button">'.$lastName.'</a>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul id="newsletter-dropdown" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="dropdown-header">Edizioni precedenti</li>';


foreach ($results['list'] as $newsletter ) {
    
    $response = $response . ' <li class="nl-dd-item"><a href="../cms/'.$newsletter->path_it.'" target="_blank">'.$newsletter->title_it.'</a></li>';
}

$response = $response . "</ul>";

echo $response;