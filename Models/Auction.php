<?php


class Auction
{
    //Fields required for the class
    protected $_aucId, $_aucName, $_postUser, $_start, $_end;

    //Constructor for the class
    public function __construct($dbRow)
    {
        $this->_aucId = $dbRow['Auction_id'];
        $this->_aucName = $dbRow['Auction_name'];
        $this->_postUser= $dbRow['Posting_User'];
        $this->_start = $dbRow['Auction_start'];
        $this->_end = $dbRow['Auction_endDate'];
    }

    //Accessor methods for the fields above
    //Gets the ID of the auction
    public function getAuctionID()
    {
        return $this->_aucId;
    }

    //Gets the name of the auction
    public function getAuctionName()
    {
        return $this->_aucName;
    }

    //Gets the posting user of the auction
    public function getPostingUser()
    {
        return $this->_postUser;
    }

    //Gets the start date of the auction
    public function getStartDate()
    {
        return $this->_start;
    }

    //Gets the end date of the auction
    public function getEndDate()
    {
        return $this->_end;
    }
}