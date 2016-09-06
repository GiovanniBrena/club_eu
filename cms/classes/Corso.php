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

class Corso
{

    // Properties

    public $id = null;

    public $level_it = null;

    public $level_en = null;

    public $teacher = null;

    public $when_it = null;

    public $when_en = null;

    public $location = null;

    public $lang = null;

    public $info = null;

    public $data0 = null;

    public $data1 = null;

    public $data2 = null;

    public $date_create = null;

    public $state = null;


    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['level_it'] ) ) $this->level_it = (string) $data['level_it'];
        if ( isset( $data['level_en'] ) ) $this->level_en = (string) $data['level_en'];
        if ( isset( $data['teacher'] ) ) $this->teacher = (string) $data['teacher'];
        if ( isset( $data['when_it'] ) ) $this->when_it = (string) $data['when_it'];
        if ( isset( $data['when_en'] ) ) $this->when_en = (string) $data['when_en'];
        if ( isset( $data['location'] ) ) $this->location = (string) $data['location'];
        if ( isset( $data['lang'] ) ) $this->lang = (string) $data['lang'];
        if ( isset( $data['info'] ) ) $this->info = (string) $data['info'];
        if ( isset( $data['data0'] ) ) $this->data0 = (string) $data['data0'];
        if ( isset( $data['data1'] ) ) $this->data1 = (string) $data['data1'];
        if ( isset( $data['data2'] ) ) $this->data2 = $data['data2'];
        if ( isset( $data['date_create'] ) ) $this->date_create = $data['date_create'];
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
        $sql = "SELECT * FROM corso WHERE id=:id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Corso( $row );
    }



    public static function getList( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM corso
            ORDER BY lang";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $corso = new Corso( $row );
            $list[] = $corso;
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
        $sql = "INSERT INTO corso ( level_it, level_en, teacher, when_it, when_en, location, lang, info, data0, data1, data2, state) 
            VALUES (:level_it, :level_en, :teacher, :when_it, :when_en, :location, :lang, :info, :data0, :data1, :data2, :state)";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":level_it", $this->level_it, PDO::PARAM_STR );
        $st->bindValue( ":level_en", $this->level_en, PDO::PARAM_STR );
        $st->bindValue( ":teacher", $this->teacher, PDO::PARAM_STR );
        $st->bindValue( ":when_it", $this->when_it, PDO::PARAM_STR);
        $st->bindValue( ":when_en", $this->when_en, PDO::PARAM_STR);
        $st->bindValue( ":location", $this->location, PDO::PARAM_STR);
        $st->bindValue( ":lang", $this->lang, PDO::PARAM_STR);
        $st->bindValue( ":info", $this->info, PDO::PARAM_STR);
        $st->bindValue( ":data0", $this->data0, PDO::PARAM_STR);
        $st->bindValue( ":data1", $this->data1, PDO::PARAM_STR);
        $st->bindValue( ":data2", $this->data2, PDO::PARAM_STR);
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
        $sql = "UPDATE corso SET level_it=:level_it, level_en=:level_en, teacher=:teacher, when_it=:when_it, when_en=:when_en, location=:location, lang=:lang, info=:info, data0=:data0, data1=:data1, data2=:data2, state=:state WHERE id = :id";

        $st = $conn->prepare ( $sql );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->bindValue( ":level_it", $this->level_it, PDO::PARAM_STR );
        $st->bindValue( ":level_en", $this->level_en, PDO::PARAM_STR );
        $st->bindValue( ":teacher", $this->teacher, PDO::PARAM_STR );
        $st->bindValue( ":when_it", $this->when_it, PDO::PARAM_STR);
        $st->bindValue( ":when_en", $this->when_en, PDO::PARAM_STR);
        $st->bindValue( ":location", $this->location, PDO::PARAM_STR);
        $st->bindValue( ":lang", $this->lang, PDO::PARAM_STR);
        $st->bindValue( ":info", $this->info, PDO::PARAM_STR);
        $st->bindValue( ":data0", $this->data0, PDO::PARAM_STR);
        $st->bindValue( ":data1", $this->data1, PDO::PARAM_STR);
        $st->bindValue( ":data2", $this->data2, PDO::PARAM_STR);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }


    /**
     * Deletes the current Article object from the database.
     */

    public function delete() {

        // Does the Corso object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Corso::delete(): Attempt to delete a Corso object that does not have its ID property set.", E_USER_ERROR );

        // Delete the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM corso WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

}

