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
    case 'listSoci':
        listSoci();
        break;
    case 'showRequests':
        showRequests();
        break;
    case 'editSocioRequest':
        editSocioRequest();
        break;
    case 'listActivities':
        listActivities();
        break;
    case 'newActivity':
        newActivity();
        break;
    case 'editActivity':
        editActivity();
        break;
    case 'deleteActivity':
        deleteActivity();
        break;
    case 'listCorsi':
        listCorsi();
        break;
    case 'newCorso':
        newCorso();
        break;
    case 'editCorso':
        editCorso();
        break;
    default:
        showDashboard();
}


function login() {

    $results = array();
    $results['pageTitle'] = "Club Europeo - Admin Login";

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

        if ( Socio::existsEmail((string)$_POST['email'])) {
            header( "Location: admin.php?action=listSoci&state=existingEmail" );
        }
        
        else if ( Socio::existsNameSurnamePhone((string)$_POST['firstname'], (string)$_POST['lastname'] , (string)$_POST['phone'])) {
            header( "Location: admin.php?action=listSoci&state=duplicated" );
        }

        else {
            // User has posted the socio edit form: save the new socio
            $socio = new Socio;
            $socio->storeFormValues($_POST);
            $socio->insert();
            header("Location: admin.php?action=listSoci");
        }

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['socio'] = new Socio;
        require( TEMPLATE_PATH . "/admin/editSocio.php" );
    }

}


function editSocio() {
    
    $results = array();
    $results['pageTitle'] = "Edit Socio";
    $results['formAction'] = "editSocio";

    
    if ( isset( $_POST['saveChanges'] ) ) {
        
        // User has posted the article edit form: save the article changes
        if ( !$socio = Socio::getById( (int)$_POST['id'] ) ) {
            header( "Location: admin.php?error=articleNotFound" );
            return;
        }

        else if ( Socio::existsNameSurnamePhone((string)$_POST['firstname'], (string)$_POST['lastname'] , (string)$_POST['phone'])) {
            console_log("SOCIO DUPLICATO !!");
            return;
        }

        $socio->storeFormValues( $_POST );
        $socio->update();
        header( "Location: admin.php?action=listSoci" );


    } elseif ( isset( $_POST['cancel'] ) ) {

        console_log("CANCEL update socio");

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );

    } elseif ( isset( $_POST['renewSocio'] ) ) {
        if ( !$socio = Socio::getById( (int)$_POST['id'] ) ) {
            header( "Location: admin.php?error=articleNotFound" );
            return;
        }

        $socio->storeFormValues( $_POST );
        $socio->renew();
        header( "Location: admin.php?action=listSoci" );

    } else {

        console_log("EDIT socio");

        // User has not posted the article edit form yet: display the form
        $results['socio'] = Socio::getById( (int)$_GET['socioId'] );
        require( TEMPLATE_PATH . "/admin/editSocio.php" );
    }

}


function deleteSocio() {

    if ( !$socio = Socio::getById( (int)$_GET['socioId'] ) ) {
        header( "Location: admin.php?error=articleNotFound" );
        return;
    }

    $socio->delete();
    header( "Location: admin.php?action=listSoci" );
}


function listSoci() {
    if (isset( $_GET['year'] )) {
        $year=$_GET['year'];    
    }
     else {$year=date('Y', time());}


    $results = array();
    $data = Socio::getListByStateAndYear(0,$year-1, $year);
    $results['soci'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $requests = Socio::getListByState(1);
    $results['requests'] = $requests['results'];
    $results['requestsTotalRows'] = $requests['totalRows'];
    $renews = Socio::getListByState(2);
    $results['renews'] = $renews['results'];
    $results['renewsTotalRows'] = $renews['totalRows'];
    
    $results['pageTitle'] = "Gestione Soci";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
    }

    require( TEMPLATE_PATH . "/admin/listSoci.php" );
}

function showDashboard() {
    $results['pageTitle'] = "Dashboard";
    require( TEMPLATE_PATH . "/admin/dashboard.php" );
}

function showRequests() {
    $results = array();
    $requests = Socio::getListByState(1);
    $results['requests'] = $requests['results'];
    $results['requestsTotalRows'] = $requests['totalRows'];

    $renewRequests = Socio::getListByState(2);
    $results['renewRequests'] = $renewRequests['results'];
    $results['renewRequestsTotalRows'] = $renewRequests['totalRows'];

    $results['pageTitle'] = "Gestione Richieste";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
    }

    require( TEMPLATE_PATH . "/admin/showRequests.php" );
}


function editSocioRequest() {

    $results = array();
    $results['pageTitle'] = "Edit Request";
    $results['formAction'] = "editSocioRequest";



    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the article changes
        if ( !$socio = Socio::getById( (int)$_POST['id'] ) ) {
            header( "Location: admin.php?error=socioNotFound" );
            return;
        }

        $socio->storeFormValues( $_POST );
        $socio->update();

        sendConfirmationEmail($socio);

        header( "Location: admin.php?action=showRequests" );


    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['socio'] = Socio::getById( (int)$_GET['socioId'] );
        require( TEMPLATE_PATH . "/admin/editSocioRequest.php" );
    }

}



function console_log( $data ){
    echo '<script>';
    echo 'console.log("'.$data.'")';
    echo '</script>';
}

function alert_log( $data ){
    echo '<script>';
    echo 'alert("Message: '.$data.'");';
    echo '</script>';
}

function debug_view ( $what ) {
    echo '<pre>';
    if ( is_array( $what ) )  {
        print_r ( $what );
    } else {
        var_dump ( $what );
    }
    echo '</pre>';
}



function sendConfirmationEmail($socio) {
    $headers="From: <info@clubeuropeo.it>\n";
    $msg_body = "Buongiorno " . $socio->firstname . " " . $socio->lastname . ",";
    $headers .= $msg_body;
    $oggetto="Iscrizione APPROVATA - Club Europeo Ispra";
    $corpo="Siamo felici di informarti che la tua iscrizione al Club Europeo Ispra è stata approvata ed sei ora un socio effettivo del club. "
        . "Nel caso questa mail ti sia arrivata senza che tu abbia richiesto l'iscrizione puoi comunicarlo rispondendo a questo messaggio." . " Club Europeo Ispra.";

    mail($socio->email, $oggetto, $corpo, $headers);
}




///------------------- ACTIVITIES ----------------///


function listActivities() {
    
    $results = array();
    $data = Attivita::getList();
    $results['attivita'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $results['pageTitle'] = "Gestione Attività";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
    }

    require( TEMPLATE_PATH . "/admin/listActivities.php" );
}


function newActivity() {

    $results = array();
    $results['pageTitle'] = "New Activity";
    $results['formAction'] = "newActivity";
    
    // SAVE FORM
    if ( isset( $_POST['saveChanges'] ) ) {

            // User has posted the socio edit form: save the new socio
            $activity = new Attivita;
            $activity->storeFormValues($_POST);
            $activity->insert();
        
            header("Location: admin.php?action=listActivities");


    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['attivita'] = new Attivita;
        require( TEMPLATE_PATH . "/admin/editActivity.php" );
    }

}


function editActivity() {

    $results = array();
    $results['pageTitle'] = "Edit Attività";
    $results['formAction'] = "editActivity";


    if ( isset( $_POST['saveChanges'] ) ) {
        
        if ( !$activity = Attivita::getById( (int)$_POST['id'] ) ) {
            header( "Location: admin.php?error=articleNotFound" );
            return;
        }

        $activity->storeFormValues( $_POST );
        $activity->update();
        header( "Location: admin.php?action=listActivities" );


    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['attivita'] = Attivita::getById( (int)$_GET['id'] );
        require( TEMPLATE_PATH . "/admin/editActivity.php" );
    }

}


function deleteActivity() {

    if ( !$activity = Attivita::getById( (int)$_GET['activityId'] ) ) {
        header( "Location: admin.php?error=articleNotFound" );
        return;
    }

    $activity->delete();
    header( "Location: admin.php?action=listActivities");
}



///------------------- COURSES ----------------///


function listCorsi() {

    $results = array();
    $data = Corso::getList();
    $results['corsi'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    $results['pageTitle'] = "Gestione Corsi";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
    }

    require( TEMPLATE_PATH . "/admin/listCorsi.php" );
}


function newCorso() {

    $results = array();
    $results['pageTitle'] = "New Corso";
    $results['formAction'] = "newCorso";

    // SAVE FORM
    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the socio edit form: save the new socio
        $corso = new Corso;
        $corso->storeFormValues($_POST);
        $corso->insert();

        header("Location: admin.php?action=listCorsi");


    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['corso'] = new Corso;
        require( TEMPLATE_PATH . "/admin/editCorso.php" );
    }

}


function editCorso() {

    $results = array();
    $results['pageTitle'] = "Edit Corso";
    $results['formAction'] = "editCorso";


    if ( isset( $_POST['saveChanges'] ) ) {

        if ( !$activity = Attivita::getById( (int)$_POST['id'] ) ) {
            header( "Location: admin.php?error=articleNotFound" );
            return;
        }

        $activity->storeFormValues( $_POST );
        $activity->update();
        header( "Location: admin.php?action=listCorsi" );


    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['corso'] = Corso::getById( (int)$_GET['id'] );
        require( TEMPLATE_PATH . "/admin/editCorso.php" );
    }

}


function deleteCorso() {

    if ( !$corso = Corso::getById( (int)$_GET['corsoId'] ) ) {
        header( "Location: admin.php?error=articleNotFound" );
        return;
    }

    $corso->delete();
    header( "Location: admin.php?action=listCorsi");
}
