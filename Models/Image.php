<?php


class Image
{
    //fields for the image class
protected $_imageId, $_lotId, $_imageData;

//constructor for the image class
    public function __construct($dbRow)
    {
        $this->_imageId = $dbRow['imageId'];
        $this->_lotId = $dbRow['Lot_id'];
        $this->_imageData = $dbRow['images_data'];
    }

    //Accessor methods for fields
    //Gets the image ID
    public function getImageID()
    {
        return $this->_imageId;
    }

    //Gets the lot id
    public function getLotId()
    {
        return $this->_lotId;
    }

    //Gets the name of the image
    public function getImageData()
    {
        return $this->_imageData;
    }

    //This is a mutator method that sets the image to the variable.
    public function setImages($_images)
    {
        $this->_images = $_images;
    }
}