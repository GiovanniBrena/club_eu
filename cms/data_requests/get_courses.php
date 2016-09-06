<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 06/09/2016
 * Time: 22:18
 */
require( "../config.php" );

$lang = $_GET['lang'];
$data = Corso::getListByLanguage($lang);
$results['corsi'] = $data['results'];
$results['totalRows'] = $data['totalRows'];

$response='<table class=\"table\"><thead><tr><th>Livello</th><th>Insegnante</th><th>Orario</th><th>Luogo</th></tr></thead><tbody>';



foreach ($results['corsi'] as $corso ) {
    $response = $response . "<tr>
                    <td>" . $corso->level_it . "</td>
                    <td>" . $corso->teacher . "</td>
                    <td>" . $corso->when_it . "</td>
                    <td>" . $corso->location . "</td>
                  </tr>";
}

$response = $response . "</tbody></table>";

echo $response;

