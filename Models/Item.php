<?php

class Item implements JsonSerializable
{
    //fields
    protected $_itemId, $_itemName, $_itemDescription, $_images, $_auctionId;

    //constructor
    public function __construct($dbRow)
    {
        $this->_itemId = $dbRow['item_Id'];
        $this->_itemName = $dbRow['item_name'];
        $this->_itemDescription = $dbRow['item_description'];
        $this->_images = [];
        $this->_auctionId = $dbRow['Auc_id'];
    }

    //Accessor methods for fields
    //Function to initialize the JSON for javascript
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return [
            '_itemId' => $this->_itemId,
            '_itemName' => $this->_itemName,
            '_itemDes' => $this->_itemDescription,
            '_auctionId' => $this->_auctionId,
            '_images' => $this->_images[1],
        ];
    }

    //Gets the item Id
    public function getItemID()
    {
        return $this->_itemId;
    }

    //Gets the item name
    public function getItemName()
    {
        return $this->_itemName;
    }

    //Gets the item description
    public function getItemDescription()
    {
        return $this->_itemDescription;
    }

    //Gets the images
    public function getImages()
    {
        return $this->_images;
    }

    //Gets a single image for the image array
    public function getImage($i){

        return $this->_images[$i];
    }

    //Gets the auction Id
    public function getAuctionId()
    {
        return $this->_auctionId;
    }

    public function setImages($_imagesData)
    {
        $this->_images = $_imagesData;
    }

}