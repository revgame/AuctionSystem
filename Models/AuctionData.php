<?php
require_once('Models/Database.php');
require_once('Models/Auction.php');
class AuctionData
{
    //Fields containing the database connection
    protected $_dbConnection, $_dbInstance;

    //Constructor for the database connections
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    //function to get all auction data from the auction database
    public function getAuctions()
    {
        //Query to ask the database
        $sqlQuery = "SELECT * FROM Auction";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();

        //Creates an array and enter each rows as a separate item in an array
        $dataSet = [];
        while ($row = $statement->fetch())
        {
            $dataSet[] = new Auction($row);
        }
        return $dataSet;
    }

}
