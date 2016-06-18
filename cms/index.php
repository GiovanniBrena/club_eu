<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 17/06/2016
 * Time: 12:16
 */


require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
    case 'archive':
        archive();
        break;
    case 'viewArticle':
        viewArticle();
        break;
    default:
        homepage();
}


function archive() {
}

function viewArticle() {
}

function homepage() {
    require( TEMPLATE_PATH . "/homepage.php" );
}

