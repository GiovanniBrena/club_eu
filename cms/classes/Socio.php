<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 17/06/2016
 * Time: 11:12
 */

/**
 * Class to handle Soci
 */

class Socio
{

    // Properties

    /**
     * @var int The socio ID (key) from the database
     */
    public $id = null;

    /**
     * @var int The personal ID from the database
     */
    public $personal_id = null;

    /**
     * @var string first name of socio
     */
    public $firstname = null;

    /**
     * @var string last name of socio
     */
    public $lastname = null;

    /**
     * @var DATE first name of socio
     */
    public $date_of_birth = null;

    /**
     * @var string address
     */
    public $address = null;

    /**
     * @var string address
     */
    public $cap = null;

    /**
     * @var string city
     */
    public $city = null;

    /**
     * @var string phone number
     */
    public $phone = null;

    /**
     * @var string nationality
     */
    public $nationality = null;

    /**
     * @var string email
     */
    public $email = null;

    /**
     * @var int position
     */
    public $position = null;

    /**
     * @var int state
     */
    public $state = null;


    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['personal_id'] ) ) $this->publicationDate = (int) $data['personal_id'];
        if ( isset( $data['firstname'] ) ) $this->content = (string) $data['firstname'];
        if ( isset( $data['lastname'] ) ) $this->content = (string) $data['lastname'];
        if ( isset( $data['date_of_birth'] ) ) $this->content = $data['date_of_birth'];
        if ( isset( $data['address'] ) ) $this->content = (string) $data['address'];
        if ( isset( $data['cap'] ) ) $this->content = (string) $data['cap'];
        if ( isset( $data['city'] ) ) $this->content = (string) $data['city'];
        if ( isset( $data['phone'] ) ) $this->content = (string) $data['phone'];
        if ( isset( $data['nationality'] ) ) $this->content = (string) $data['nationality'];
        if ( isset( $data['email'] ) ) $this->content = (string) $data['email'];
        if ( isset( $data['position'] ) ) $this->content = (int) $data['email'];
        if ( isset( $data['state'] ) ) $this->content = (int) $data['email'];
    }


    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */

    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );

        // Parse and store the publication date
        if ( isset($params['date_of_birth']) ) {
            $date_of_birth = explode ( '-', $params['publicationDate'] );

            if ( count($date_of_birth) == 3 ) {
                list ( $y, $m, $d ) = $date_of_birth;
                $this->date_of_birth = mktime ( 0, 0, 0, $m, $d, $y );
            }
        }
    }


    /**
     * Returns an Article object matching the given article ID
     *
     * @param int The article ID
     * @return Article|false The article object, or false if the record was not found or there was a problem
     */

    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT *, FROM socio WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Socio( $row );
    }


    /**
     * Returns all (or a range of) Article objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @param string Optional column by which to order the articles (default="publicationDate DESC")
     * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
     */

    public static function getList( $numRows=1000000, $order="id DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, FROM socio
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $article = new Socio( $row );
            $list[] = $article;
        }

        // Now get the total number of articles that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }


    /**
     * Inserts the current Article object into the database, and sets its ID property.
     */

    public function insert() {

        // Does the Article object already have an ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Socio::insert(): Attempt to insert a Socio object that already has its ID property set (to $this->id).", E_USER_ERROR );

        // Insert the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO socio ( personal_id, firstname, lastname, date_of_birth, nationality, address, cap, city, phone, email, position, state ) VALUES ( :personal_id, :firstname, :lastname, :date_of_birth, :nationality, :address, :cap, :city, :phone, :email, :position, :state )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":personal_id", $this->personal_id, PDO::PARAM_INT );
        $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
        $st->bindValue( ":date_of_birth", $this->date_of_birth, PDO::PARAM_STR);
        $st->bindValue( ":nationality", $this->nationality, PDO::PARAM_STR);
        $st->bindValue( ":address", $this->address, PDO::PARAM_STR);
        $st->bindValue( ":cap", $this->cap, PDO::PARAM_STR);
        $st->bindValue( ":city", $this->city, PDO::PARAM_STR);
        $st->bindValue( ":phone", $this->phone, PDO::PARAM_STR);
        $st->bindValue( ":email", $this->email, PDO::PARAM_STR);
        $st->bindValue( ":position", $this->position, PDO::PARAM_INT);
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
        $sql = "UPDATE articles SET personal_id=:personal_id, firstname=:firstname, lastname=:lastname, date_of_birth=:date_of_birth, nationality=:nationality, address=:address, cap=:cap, city=:city, phone=:phone, email=:email, position=:position, state=:state WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":personal_id", $this->personal_id, PDO::PARAM_INT );
        $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
        $st->bindValue( ":date_of_birth", $this->date_of_birth, PDO::PARAM_STR);
        $st->bindValue( ":nationality", $this->nationality, PDO::PARAM_STR);
        $st->bindValue( ":address", $this->address, PDO::PARAM_STR);
        $st->bindValue( ":cap", $this->cap, PDO::PARAM_STR);
        $st->bindValue( ":city", $this->city, PDO::PARAM_STR);
        $st->bindValue( ":phone", $this->phone, PDO::PARAM_STR);
        $st->bindValue( ":email", $this->email, PDO::PARAM_STR);
        $st->bindValue( ":position", $this->position, PDO::PARAM_INT);
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
        $st = $conn->prepare ( "DELETE FROM socio WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

}
