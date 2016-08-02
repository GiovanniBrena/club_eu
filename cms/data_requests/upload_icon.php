<?php


    // settiamo alcune variabili coinvolte nello script:
// 1) settiamo la cartella in cui fare l'upload
    $cartella_upload ="../resources/activity_icon/";

// 2) settiamo un array in cui indichiamo il tipo di file che consentiamo l'upload
// in questo esempio solo immagini
    $tipi_consentiti = array("gif","png","jpeg","jpg");

// 3) settiamo la dimensione massima del file (1048576 byte = 1Mb)
    $max_byte = 100000;


// se il form è stato inviato
    if (isset($_POST['saveChanges']) and isset($_FILES["icon"])) {
        // verifichiamo che l'utente abbia selezionato un file
        if (trim($_FILES["icon"]["name"]) == '') {
            echo 'Non hai selezionato nessun file!';
        } // verifichiamo che il file è stato caricato
        else if (!is_uploaded_file($_FILES["icon"]["tmp_name"]) or $_FILES["icon"]["error"] > 0) {
            echo 'Si sono verificati problemi nella procedura di upload!';
        } // verifichiamo che il tipo è fra quelli consentiti
        else if (!in_array(strtolower(end(explode('.', $_FILES["icon"]["name"]))), $tipi_consentiti)) {
            echo 'Il file che si desidera uplodare non è fra i tipi consentiti!';
        } // verifichiamo che la dimensione del file non eccede quella massima
        else if ($_FILES["icon"]["size"] > $max_byte) {
            echo 'Il file che si desidera uplodare eccede la dimensione massima!';
        } // verifichiamo che la cartella di destinazione settata esista
        else if (!is_dir($cartella_upload)) {
            echo 'La cartella in cui si desidera salvare il file non esiste!';
        } // verifichiamo che la cartella di destinazione abbia i permessi di scrittura
        else if (!is_writable($cartella_upload)) {
            echo "La cartella in cui fare l'upload non ha i permessi!";
        } // verifichiamo il successo della procedura di upload nella cartella settata
        else if (!move_uploaded_file($_FILES["icon"]["tmp_name"], $cartella_upload . $_FILES["icon"]["name"])) {
            echo 'Ops qualcosa è andato storto nella procedura di upload!';
        } // altrimenti significa che è andato tutto ok
        else {
            echo 'Upload eseguito correttamente!';
        }
    }


