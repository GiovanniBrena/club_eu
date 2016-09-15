<?php
/**
 * Created by Giovanni Brena
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
     * @var int positionId
     * 0 -> Interno
     * 1 -> Esterno
     */
    public $positionId = null;

    /**
     * @var int state
     * 0 -> Attivo
     * 1 -> In attesa approvazione
     * 2 -> In attesa rinnovo
     * 3 -> Non attivo
     */
    public $state = null;
    /**
     * @var DATE first name of socio
     */
    public $date_create = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['personal_id'] ) ) $this->personal_id = (int) $data['personal_id'];
        if ( isset( $data['firstname'] ) ) $this->firstname = (string) $data['firstname'];
        if ( isset( $data['lastname'] ) ) $this->lastname = (string) $data['lastname'];
        if ( isset( $data['date_of_birth'] ) ) $this->date_of_birth = $data['date_of_birth'];
        if ( isset( $data['date_create'] ) ) $this->date_create = $data['date_create'];
        if ( isset( $data['address'] ) ) $this->address = (string) $data['address'];
        if ( isset( $data['cap'] ) ) $this->cap = (string) $data['cap'];
        if ( isset( $data['city'] ) ) $this->city = (string) $data['city'];
        if ( isset( $data['phone'] ) ) $this->phone = (string) $data['phone'];
        if ( isset( $data['nationality'] ) ) $this->nationality = (string) $data['nationality'];
        if ( isset( $data['email'] ) ) $this->email = (string) $data['email'];
        if ( isset( $data['positionId'] ) ) $this->positionId = (int) $data['positionId'];
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

        /*
        // Parse and store the publication date
        if ( isset($params['date_of_birth']) ) {
            $date_of_birth = explode ( '-', $params['date_of_birth'] );

            if ( count($date_of_birth) == 3 ) {
                list ( $y, $m, $d ) = $date_of_birth;
                $this->date_of_birth = mktime ( 0, 0, 0, $m, $d, $y );
            }
        }*/
    }


    /**
     * Returns a Socio object matching the given socioID
     *
     * @param int The socio ID
     * @return Socio|false The article object, or false if the record was not found or there was a problem
     */

    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE id=:id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Socio( $row );
    }

    public static function getByPersonalIdAndEmail( $id, $email ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE personal_id=:personal_id && email=:email";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":personal_id", $id, PDO::PARAM_INT );
        $st->bindValue( ":email", $email, PDO::PARAM_STR );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Socio( $row );
    }

    public static function existsEmail($email) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE email=:email";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":email", $email, PDO::PARAM_STR );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return true;
        else return false;
    }

    public static function existsNameSurnamePhone($firstname, $lastname, $phone) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE firstname=:firstname AND lastname=:lastname AND phone=:phone";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":firstname", $firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $lastname, PDO::PARAM_STR );
        $st->bindValue( ":phone", $phone, PDO::PARAM_STR );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return true;
        else return false;
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
        $sql = "SELECT * FROM socio
            ORDER BY id ASC";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
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
        $dateMin = new DateTime($yearMin."-09-01 00:00:00");
        $dateMax = new DateTime($yearMax."-08-31 00:00:00");
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM socio WHERE state=:state AND date_create>:date_min AND date_create<:date_max ORDER BY personal_id ASC";
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



    /**
     * Inserts the current Article object into the database, and sets its ID property.
     */

    public function insert() {

        // Does the Article object already have an ID?
        //if ( !is_null( $this->id ) ) trigger_error ( "Socio::insert(): Attempt to insert a Socio object that already has its ID property set (to $this->id).", E_USER_ERROR );
        

        // Insert the Socio
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO socio ( personal_id, firstname, lastname, date_of_birth, nationality, address, cap, city, phone, email, positionId, state ) VALUES ( :personal_id, :firstname, :lastname, :date_of_birth, :nationality, :address, :cap, :city, :phone, :email, :positionId, :state )";
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
        $st->bindValue( ":positionId", $this->positionId, PDO::PARAM_INT);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }


    /**
     * Updates the current Socio object in the database.
     */

    public function update() {

        // Does the Article object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

        // Update the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE socio SET personal_id=:personal_id, firstname=:firstname, lastname=:lastname, date_of_birth=:date_of_birth, nationality=:nationality, address=:address, cap=:cap, city=:city, phone=:phone, email=:email, positionId=:positionId, state=:state WHERE id = :id";

        $st = $conn->prepare ( $sql );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
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
        $st->bindValue( ":positionId", $this->positionId, PDO::PARAM_INT);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    public function renew() {

        // Does the Article object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

        // Update the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO socio ( personal_id, firstname, lastname, date_of_birth, nationality, address, cap, city, phone, email, positionId, state ) VALUES ( :personal_id, :firstname, :lastname, :date_of_birth, :nationality, :address, :cap, :city, :phone, :email, :positionId, :state )";

        $st = $conn->prepare ( $sql );
        //$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->bindValue( ":personal_id", self::getNextPersonalId(), PDO::PARAM_INT );
        $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
        $st->bindValue( ":date_of_birth", $this->date_of_birth, PDO::PARAM_STR);
        $st->bindValue( ":nationality", $this->nationality, PDO::PARAM_STR);
        $st->bindValue( ":address", $this->address, PDO::PARAM_STR);
        $st->bindValue( ":cap", $this->cap, PDO::PARAM_STR);
        $st->bindValue( ":city", $this->city, PDO::PARAM_STR);
        $st->bindValue( ":phone", $this->phone, PDO::PARAM_STR);
        $st->bindValue( ":email", $this->email, PDO::PARAM_STR);
        $st->bindValue( ":positionId", $this->positionId, PDO::PARAM_INT);
        $st->bindValue( ":state", $this->state, PDO::PARAM_INT);
        //$st->bindValue( ":date_create", date('Y-m-d',time()), PDO::PARAM_STR);
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


    public static function getNextPersonalId(){
        $year = date('Y', time());
        $month = date('m', time());

        if($month<9) {
            $dateMin = new DateTime($year-1 . "-09-01 00:00:00");
            $dateMax = new DateTime($year."-08-31 00:00:00");
        }
        else {
            $dateMin = new DateTime($year."-09-01 00:00:00");
            $dateMax = new DateTime($year+1 . "-08-31 00:00:00");
        }

        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT personal_id FROM socio WHERE date_create>:date_min AND date_create<:date_max
            ORDER BY personal_id DESC LIMIT 1";
        $st = $conn->prepare( $sql );
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
        $result = array ( "data" => $list, "totalRows" => $totalRows[0] );
        return $result['data'][0]->personal_id+1;
    }

}

