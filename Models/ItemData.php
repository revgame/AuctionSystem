<?php
require_once('Models/Database.php');
require_once('Models/Item.php');
require_once('Models/Image.php');
class ItemData
{
    //Fields
    protected $_dbConnection, $_dbInstance;

    //Constructor
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    //function for fetching all items in a the database
    public function fetchItems($offset, $recordNo)
    {
        //
        $sqlQuery = "SELECT * FROM LOT LIMIT :off, :recordNo"; //query to fetch items for pagination
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindValue(':off', $offset, PDO::PARAM_INT); //Bind variable to :off with parameter $offset
        $statement->bindValue(':recordNo', $recordNo, PDO::PARAM_INT); //Bind variable to :recordNo with parameter $recordNo
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $item = new Item($row);
            //Array of images set to the image field for an item
            $item->setImages($this->fetchImages($item->getItemID()));
            $dataSet[] = $item;
        }
        return $dataSet;
    }

    //function to fetch a single item
    public function fetchAnItem($id): Item
    {
        $sqlQuery = "SELECT * FROM LOT WHERE item_Id = :id"; //query to fetch a single item with a particular lot id
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':id', $id, PDO::PARAM_STR);  //Bind variable to :id with parameter $id
        $statement->execute(); // execute the PDO statement

        while ($row = $statement->fetch()) {
            //add row to
            $item = new Item($row);
            $item->setImages($this->fetchImages($item->getItemID()));
        }
        return $item; //return the value of the row
    }

    //function to fetch images from a database
    public function fetchImages($id): array
    {
        $sqlQuery = "SELECT * FROM Image WHERE Lot_id = :id"; //fetch image with the lot id
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':id', $id, PDO::PARAM_STR);  //Bind variable to :id with parameter $id
        $statement->execute();
        $imageDataSet = [];
       while ($row = $statement->fetch()){

           $image = new Image($row);
           $imageDataSet[] = $image->getImageData(); //add image to the array

       }
       return $imageDataSet; //return array
    }

    //function to search for an item in a database
    public function searchForItem($searchItem): array
    {
        $sqlQuery = "SELECT * FROM LOT WHERE item_name LIKE CONCAT('%', :search,'%') LIMIT 20"; //query to find the item name a user searches for
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':search', $searchItem);  //Bind variable to :search with parameter $searchItem
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $item = new Item($row); //add item to new item
            $item->setImages($this->fetchImages($item->getItemID())); //set image to the item data
            $dataSet[] = $item;
        }
        return $dataSet; //Return array
    }

    //function to fetch bid items for a particular user
    public function fetchBidItems($user): array
    {
        //Query to get the bid items from a particular user
        $sqlQuery = "SELECT item_Id, item_name, item_description, Auc_id FROM LOT, Bid WHERE LOT.item_Id = Bid.lot_id AND Bid.user_id = :user";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':user', $user, PDO::PARAM_STR); //Bind variable to :user with parameter $user
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $item = new Item($row);
            $item->setImages($this->fetchImages($item->getItemID()));
            $dataSet[] = $item;
        }
        return $dataSet;
    }

    //function to fetch auction items from a particular auction
    public function fetchAuctionItems($auction): array
    {
        //Query to get the auction items from a single auction
        $sqlQuery = "SELECT * FROM LOT, Auction WHERE LOT.auc_Id = Auction.Auction_id AND Auction.Auction_id = :auc";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':auc', $auction, PDO::PARAM_STR); //Bind variable to :auc with parameter $auction
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $item = new Item($row);
            $item->setImages($this->fetchImages($item->getItemID()));
            $dataSet[] = $item; //add array to items
        }
        return $dataSet; //return the whole array
    }

    //function to fetch the auction date for a single lot
    public function fetchAuctionDate($lotId)
    {
        //Query to get the end date specifying the auction id and the item id
        $sqlQuery = "SELECT Auction_endDate FROM Auction, LOT WHERE Auction.Auction_id = LOT.auc_Id AND LOT.item_Id = :item";
        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->bindParam(':item', $lotId, PDO::PARAM_STR); //Bind variable to :item with parameter $lotId
        $statement->execute(); // execute the PDO statement

        return $statement->fetchColumn(); //return column

    }

    //Function for calculating the number of pages to be displayed
    public function recordNumber($records_per_page)
     {

    $query = "SELECT COUNT(item_Id) FROM LOT"; //query to find the number of items froma LOT
     $statement = $this->_dbConnection->prepare($query); // prepare a PDO statement
     $statement->execute();

      $number_of_result = $statement->fetchColumn();

      //returning the division of the number of results with the chosen records per page gives the total number of pages
         return ceil($number_of_result/$records_per_page);
    }


}