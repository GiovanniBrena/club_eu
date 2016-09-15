<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 17/06/2016
 * Time: 11:12
 */

/**
 * Class to handle Attività
 */

class Attivita
{

    // Properties

    public $id = null;

    public $title_it = null;

    public $title_en = null;

    public $desc_it = null;

    public $desc_en = null;

    public $date_act = null;

    public $price_socio = null;

    public $price_ext = null;

    public $deadline = null;

    public $place_total = null;

    public $place_available = null;

    public $date_create = null;

    public $icon_url = null;

    public $attach_url = null;

    public $state = null;


    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['title_it'] ) ) $this->title_it = (string) $data['title_it'];
        if ( isset( $data['title_en'] ) ) $this->title_en = (string) $data['title_en'];
        if ( isset( $data['desc_it'] ) ) $this->desc_it = (string) $data['desc_it'];
        if ( isset( $data['desc_en'] ) ) $this->desc_en = (string) $data['desc_en'];
        if ( isset( $data['date_act'] ) ) $this->date_act = $data['date_act'];
        if ( isset( $data['price_socio'] ) ) $this->price_socio = (string) $data['price_socio'];
        if ( isset( $data['price_ext'] ) ) $this->price_ext = (string) $data['price_ext'];
        if ( isset( $data['deadline'] ) ) $this->deadline = $data['deadline'];
        if ( isset( $data['place_total'] ) ) $this->place_total = (string) $data['place_total'];
        if ( isset( $data['place_available'] ) ) $this->place_available = (string) $data['place_available'];
        if ( isset( $data['date_create'] ) ) $this->date_create = $data['date_create'];
        if ( isset( $data['icon_url'] ) ) $this->icon_url = (string) $data['icon_url'];
        if ( isset( $data['attach_url'] ) ) $this->attach_url = (string) $data['attach_url'];
        if ( isset( $data['state'] ) ) $this->state = (int) $data['state'];
    }


    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */

    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );
        
    }



    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM attivita WHERE id=:id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Attivita( $row );
    }



    public static function getList( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM attivita
            ORDER BY date_act DESC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $attivita = new Attivita( $row );
            $list[] = $attivita;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public static function getListVisible($numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM attivita WHERE state=0 ORDER BY date_act DESC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $attivita = new Attivita( $row );
            $list[] = $attivita;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }


    /*
    public static function getListByState($stateId=0, $numRows=1000000, $order="id DESC") {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE state=:state ORDER BY id ASC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":state", $stateId, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $socio = new Socio( $row );
            $list[] = $socio;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public static function getListByStateAndYear($stateId=0, $yearMin=0, $yearMax, $numRows=1000000, $order="id DESC") {
        $dateMin = new DateTime($yearMin."-10-01 00:00:00");
        $dateMax = new DateTime($yearMax."-10-01 00:00:00");
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE state=:state AND date_create>:date_min AND date_create<:date_max ORDER BY id ASC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":state", $stateId, PDO::PARAM_INT );
        $st->bindValue( ":date_min", $dateMin->format("Y-m-d"), PDO::PARAM_STR );
        $st->bindValue( ":date_max", $dateMax->format("Y-m-d"), PDO::PARAM_STR );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $socio = new Socio( $row );
            $list[] = $socio;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

*/

    /**
     * Inserts the current Attivita object into the database, and sets its ID property.
     */

    public function insert() {

        // Insert the Attività
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO attivita ( title_it, title_en, desc_it, desc_en, date_act, price_socio, price_ext, deadline, place_total, place_available, icon_url, attach_url, state) 
            VALUES (:title_it, :title_en, :desc_it, :desc_en, :date_act, :price_socio, :price_ext, :deadline, :place_total, :place_available, :icon_url, :attach_url, :state)";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":title_it", $this->title_it, PDO::PARAM_INT );
        $st->bindValue( ":title_en", $this->title_en, PDO::PARAM_STR );
        $st->bindValue( ":desc_it", $this->desc_it, PDO::PARAM_STR );
        $st->bindValue( ":desc_en", $this->desc_en, PDO::PARAM_STR);
        $st->bindValue( ":date_act", $this->date_act, PDO::PARAM_STR);
        $st->bindValue( ":price_socio", $this->price_socio, PDO::PARAM_STR);
        $st->bindValue( ":price_ext", $this->price_ext, PDO::PARAM_STR);
        $st->bindValue( ":deadline", $this->deadline, PDO::PARAM_STR);
        $st->bindValue( ":place_total", $this->place_total, PDO::PARAM_STR);
        $st->bindValue( ":place_available", $this->place_total, PDO::PARAM_STR);
        //$st->bindValue( ":date_create", $this->date_create, PDO::PARAM_STR);
        $st->bindValue( ":icon_url", $this->icon_url, PDO::PARAM_STR);
        $st->bindValue( ":attach_url", $this->attach_url, PDO::PARAM_STR);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }


    /**
     * Updates the current Article object in the database.
     */

    public function update() {

        // Does the Article object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

        // Update the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE attivita SET title_it=:title_it, title_en=:title_en, desc_it=:desc_it, desc_en=:desc_en, date_act=:date_act, price_socio=:price_socio, price_ext=:price_ext, deadline=:deadline, place_total=:place_total, place_available=:place_available, icon_url=:icon_url, attach_url=:attach_url, state=:state WHERE id = :id";

        $st = $conn->prepare ( $sql );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->bindValue( ":title_it", $this->title_it, PDO::PARAM_STR );
        $st->bindValue( ":title_en", $this->title_en, PDO::PARAM_STR );
        $st->bindValue( ":desc_it", $this->desc_it, PDO::PARAM_STR );
        $st->bindValue( ":desc_en", $this->desc_en, PDO::PARAM_STR);
        $st->bindValue( ":date_act", $this->date_act, PDO::PARAM_STR);
        $st->bindValue( ":price_socio", $this->price_socio, PDO::PARAM_STR);
        $st->bindValue( ":price_ext", $this->price_ext, PDO::PARAM_STR);
        $st->bindValue( ":deadline", $this->deadline, PDO::PARAM_STR);
        $st->bindValue( ":place_total", $this->place_total, PDO::PARAM_STR);
        $st->bindValue( ":place_available", $this->place_total, PDO::PARAM_STR);
        //$st->bindValue( ":date_create", $this->date_create, PDO::PARAM_STR);
        $st->bindValue( ":icon_url", $this->icon_url, PDO::PARAM_STR);
        $st->bindValue( ":attach_url", $this->attach_url, PDO::PARAM_STR);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }


    /**
     * Deletes the current Article object from the database.
     */

    public function delete() {

        // Does the Article object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Socio::delete(): Attempt to delete a Socio object that does not have its ID property set.", E_USER_ERROR );

        // Delete the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM attivita WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

}

