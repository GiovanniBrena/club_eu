<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 17/06/2016
 * Time: 12:25
 */

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ( $action ) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'newSocio':
        newSocio();
        break;
    case 'editSocio':
        editSocio();
        break;
    case 'deleteSocio':
        deleteSocio();
        break;
    default:
        showDashboard();
}


function login() {

    $results = array();
    $results['pageTitle'] = "Admin Login | Widget News";

    if ( isset( $_POST['login'] ) ) {

        // User has posted the login form: attempt to log the user in

        if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

            // Login successful: Create a session and redirect to the admin homepage
            $_SESSION['username'] = ADMIN_USERNAME;
            header( "Location: admin.php" );

        } else {

            // Login failed: display an error message to the user
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }

    } else {

        // User has not posted the login form yet: display the form
        require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

}


function logout() {
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}


function newSocio() {

    $results = array();
    $results['pageTitle'] = "New Socio";
    $results['formAction'] = "newSocio";

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the socio edit form: save the new socio
        $socio = new Socio;
        $socio->storeFormValues( $_POST );
        $socio->insert();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['socio'] = new Socio;
        require( TEMPLATE_PATH . "/admin/editArticle.php" );
    }

}


function editSocio() {

    $results = array();
    $results['pageTitle'] = "Edit Socio";
    $results['formAction'] = "editSocio";

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the article changes

        if ( !$socio = Socio::getById( (int)$_POST['socioId'] ) ) {
            header( "Location: admin.php?error=articleNotFound" );
            return;
        }

        $socio->storeFormValues( $_POST );
        $socio->update();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['socio'] = Socio::getById( (int)$_GET['socioId'] );
        require( TEMPLATE_PATH . "/admin/editArticle.php" );
    }

}


function deleteSocio() {

    if ( !$socio = Socio::getById( (int)$_GET['socioId'] ) ) {
        header( "Location: admin.php?error=articleNotFound" );
        return;
    }

    $socio->delete();
    header( "Location: admin.php?status=articleDeleted" );
}


function listArticles() {
    $results = array();
    $data = Socio::getList();
    $results['soci'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Soci";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
    }

    require( TEMPLATE_PATH . "/admin/listArticles.php" );
}

function showDashboard() {
    require( TEMPLATE_PATH . "/admin/dashboard.php" );
}