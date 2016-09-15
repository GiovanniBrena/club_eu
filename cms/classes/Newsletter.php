<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 14/09/16
 * Time: 13:11
 */

class Newsletter
{

    // Properties

    public $id = null;

    public $title_it = null;

    public $title_en = null;

    public $path_it = null;

    public $path_en = null;

    public $state = null;

    public $date_create = null;


    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['title_it'] ) ) $this->title_it = (string) $data['title_it'];
        if ( isset( $data['title_en'] ) ) $this->title_en = (string) $data['title_en'];
        if ( isset( $data['path_it'] ) ) $this->path_it = (string) $data['path_it'];
        if ( isset( $data['path_en'] ) ) $this->path_en = (string) $data['path_en'];
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
        $sql = "SELECT * FROM newsletter WHERE id=:id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Newsletter( $row );
    }



    public static function getList( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM newsletter
            ORDER BY date_create DESC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $nl = new Newsletter( $row );
            $list[] = $nl;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public static function getLastNewsletter( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM newsletter
            ORDER BY date_create DESC LIMIT 1";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $nl = new Newsletter( $row );
            $list[] = $nl;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public static function getListLimit6( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM newsletter
            ORDER BY date_create DESC LIMIT 6";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $nl = new Newsletter( $row );
            $list[] = $nl;
        }

        // Now get the total number of soci that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }


    /**
     * Inserts the current Corso object into the database, and sets its ID property.
     */

    public function insert() {

        // Insert the Newsletter
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO newsletter ( title_it, title_en, path_it, path_en, state ) 
            VALUES ( :title_it, :title_en, :path_it, :path_en, :state )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":title_it", $this->title_it, PDO::PARAM_STR );
        $st->bindValue( ":title_en", $this->title_en, PDO::PARAM_STR );
        $st->bindValue( ":path_it", $this->path_it, PDO::PARAM_STR );
        $st->bindValue( ":path_en", $this->path_en, PDO::PARAM_STR );
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
        $sql = "UPDATE newsletter SET title_it=:title_it, title_en=:title_en, path_it=:path_it, path_en=:path_en, state=:state WHERE id = :id";

        $st = $conn->prepare ( $sql );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->bindValue( ":title_it", $this->title_it, PDO::PARAM_STR );
        $st->bindValue( ":title_en", $this->title_en, PDO::PARAM_STR );
        $st->bindValue( ":path_it", $this->path_it, PDO::PARAM_STR );
        $st->bindValue( ":path_en", $this->path_en, PDO::PARAM_STR);
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
        $st = $conn->prepare ( "DELETE FROM newsletter WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

}

