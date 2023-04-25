<?php


class Bid
{
    //Fields for the bid class
    protected $_bidId, $_lotId, $_userId, $_amount;

    //Constructor for the bid class to link to the database rows
    public function __construct($dbRow)
    {
        $this->_bidId = $dbRow['bid_id'];
        $this->_lotId = $dbRow['lot_id'];
        $this->_userId = $dbRow['user_id'];
        $this->_amount = $dbRow['bid_amount'];
    }

    //Accessor methods for fields
    //Gets the bid id for a bid
    public function getBidID()
    {
        return $this->_bidId;
    }

    //Gets the lot id for a bid
    public function getLotId()
    {
        return $this->_lotId;
    }

    //Gets the user id for a bid
    public function getUserId()
    {
        return $this->_userId;
    }

    //Gets the amount for a bid
    public function getAmount()
    {
        return $this->_amount;
    }
}