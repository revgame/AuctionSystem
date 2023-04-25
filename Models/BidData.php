<?php
require_once('Models/Database.php');
require_once('Models/Bid.php');

class BidData
{
    protected $_dbConnection, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    //Function to get the highest bid placed on a lot
    public function highestBid($lotId)
    {
            $sqlQuery = "SELECT MAX(bid_amount) FROM Bid WHERE lot_id = :lot"; //Query gets the maximum amount for a specific bid
            $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
            $statement->bindParam(':lot', $lotId, PDO::PARAM_STR); //Bind the parameter :lot to the variable $lot
            $statement->execute(); // execute the PDO statement

        return $statement->fetchcolumn();
    }

    //function to make a bid for an item
    public function makeBid($lotId, $userId, $amo)
    {
        //query executed fo find a row containing the specified data in the database
        $sqlQuery1 = "SELECT * FROM Bid WHERE lot_id = :lot AND user_id = :usr";
        $statement1 = $this->_dbConnection->prepare($sqlQuery1);
        $statement1->bindParam(':lot', $lotId, PDO::PARAM_STR);//Bind the parameter :lot to the variable $lotId
        $statement1->bindParam(':usr', $userId, PDO::PARAM_STR);//Bind the parameter :usr to the variable $userId
        $statement1->execute(); // execute the PDO statement

        if ($statement1->rowCount() == 1)
        {
            //query executed to update information if a row is found
            $sqlQuery2 = "UPDATE Bid SET bid_amount = :amo WHERE lot_id = :lot AND user_id = :usr";
            $statement2 = $this->_dbConnection->prepare($sqlQuery2); //prepare a PDO statement
            $statement2->bindParam(':lot', $lotId, PDO::PARAM_STR); //Bind the parameter :lot to the variable $lotId
            $statement2->bindParam(':usr', $userId, PDO::PARAM_STR);//Bind the parameter :userId to the variable $userId
            $statement2->bindParam(':amo', $amo, PDO::PARAM_STR);//Bind the parameter :amo to the variable $amo
            $statement2->execute();
        }
        else {
            //query to insert a bid into the database
            $sqlQuery3 = "INSERT INTO Bid (lot_id, user_id, bid_amount) VALUES (:lot, :usr, :amount)";
            $statement3 = $this->_dbConnection->prepare($sqlQuery3);
            $statement3->bindParam(':lot', $lotId, PDO::PARAM_STR);//Bind the parameter :lot to the variable $lotId
            $statement3->bindParam(':usr', $userId, PDO::PARAM_STR);//Bind the parameter :usr to the variable $userId
            $statement3->bindParam(':amount', $amo, PDO::PARAM_STR);//Bind the parameter :amount to the variable $amo
            $statement3->execute();
        }
    }

    //function to check if a user has a bid
    public function checkBid($userId)
    {
        $sqlQuery = "SELECT * FROM Bid WHERE user_id = :usr";
        $statement = $this->_dbConnection->prepare($sqlQuery); //prepare a PDO statement
        $statement->bindParam(':usr', $userId, PDO::PARAM_STR); //Bind the parameter :usr to the variable $userId
        $statement->execute();

        //If a row is found return true else return false
        if ($statement->rowCount() > 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //function to check the current amount for a user bid
    public function currentAmount($lotId, $userId)
    {
        $sqlQuery = "SELECT bid_Amount FROM Bid WHERE user_id = :usr AND lot_id = :lot"; //Query obtains the bid amount for a specific user and lot
        $statement = $this->_dbConnection->prepare($sqlQuery); //prepare a PDO statement
        $statement->bindParam(':lot', $lotId, PDO::PARAM_STR); //Bind the parameter :lot to the variable $lotId
        $statement->bindParam(':usr', $userId, PDO::PARAM_STR);//Bind the parameter :usr to the variable $userId
        $statement->execute();

        return $statement->fetchColumn();// Returns the column
    }

    //function to check the number of bids a user has
    public function countBid($user)
    {
        $sqlQuery = "SELECT COUNT(lot_id) FROM Bid WHERE  user_id = :usr"; //Query counts the number of lots from a specific user
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':usr', $user, PDO::PARAM_STR); //Bind the parameter :usr to the variable $userId
        $statement->execute();

        return $statement->fetchColumn(); //Returns the data from that column
    }


}