<?php


class Database
{
    /**
     * @var Database
     */
    protected static $_dbInstance = null;

    /**
     * @var PDO
     */
    protected $_dbHandle;

    /**
     * @return Database
     */
    public static function getInstance() {
        $username = 'aee954';
        $password = 'L3n40pyuXx0CKuH';
        $host = 'poseidon.salford.ac.uk';
        $dbName = 'aee954';

        //what does the triple === mean
        if(self::$_dbInstance === null) { //checks if PDO exists
            //creates new instances if not, sending in connection info
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }
        return self::$_dbInstance;
    }

    /**
     * @param $username
     * @param $password
     * @param $host
     * @param $database
     */
    private function __construct($username, $password, $host, $database){
        try{
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database", $username, $password);// creates the database handle with connection info
            //
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getdbConnection() {
        return $this->_dbHandle;
    }

    public function __destruct()
    {
        $this->_dbHandle = null; //destroy the PDO handle when no longer needed
    }
}